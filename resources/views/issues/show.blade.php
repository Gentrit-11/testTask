@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>{{ $issue->title }}</h2>
        <div class="muted">
            Project: {{ $issue->project->name }} · Status: {{ $issue->status }} · Priority: {{ $issue->priority }}
            @if($issue->due_date) · Due: {{ $issue->due_date }} @endif
        </div>
        @if($issue->description)<p class="muted">{{ $issue->description }}</p>@endif
    </div>

    <div class="card">
        <div class="row" style="justify-content:space-between">
            <h3>Tags</h3>
            <button class="btn" onclick="openTags()">Manage Tags</button>
        </div>
        <div id="tagList" class="row" style="gap:6px;margin-top:8px">
            @forelse($issue->tags as $t)
                <span class="btn" style="padding:2px 8px">{{ $t->name }}</span>
            @empty
                <span class="muted">No tags yet.</span>
            @endforelse
        </div>
    </div>

    <div class="card">
        <h3>Comments</h3>

        <form id="commentForm" class="card" style="background:#f9fafb">
            <div class="row" style="gap:8px;flex-wrap:wrap">
                <input name="author_name" placeholder="Your name">
                <input name="body" placeholder="Write a comment...">
                <button class="btn primary" type="submit">Add</button>
            </div>
            <div id="commentErrors" class="error"></div>
        </form>

        <div id="commentsWrap" style="margin-top:10px"></div>
        <div class="row" style="margin-top:8px">
            <button class="btn" id="loadMoreBtn" style="display:none">Load more</button>
        </div>
    </div>

    <div id="tagsModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.25);">
        <div class="card" style="max-width:480px;margin:10vh auto;background:#fff">
            <div class="row" style="justify-content:space-between">
                <h3>Manage Tags</h3>
                <button class="btn" onclick="closeTags()">×</button>
            </div>
            @foreach($allTags as $t)
                <div class="row" style="justify-content:space-between;border-top:1px solid #e5e7eb;padding-top:8px;margin-top:8px">
                    <div><strong>{{ $t->name }}</strong> <span class="muted">{{ $t->color }}</span></div>
                    <div class="row">
                        <button class="btn" onclick="attachTag({{ $issue->id }}, {{ $t->id }});return false;">Attach</button>
                        <button class="btn" onclick="detachTag({{ $issue->id }}, {{ $t->id }});return false;">Detach</button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const CSRF = document.querySelector('meta[name=csrf-token]')?.content || '';
            let nextCommentsUrl = "{{ route('issues.comments.index',$issue) }}";

            const tagModal = document.getElementById('tagsModal');
            const tagListEl = document.getElementById('tagList');
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            const commentForm = document.getElementById('commentForm');
            const commentsWrap = document.getElementById('commentsWrap');

            window.openTags  = () => { if(tagModal) tagModal.style.display='block'; };
            window.closeTags = () => { if(tagModal) tagModal.style.display='none'; };

            async function refreshTagList(tags){
                if(!tagListEl) return;
                tagListEl.innerHTML = '';
                if(!tags || !tags.length){ tagListEl.innerHTML = '<span class="muted">No tags yet.</span>'; return; }
                tags.forEach(t => {
                    const chip = document.createElement('span');
                    chip.className = 'btn';
                    chip.style.padding = '2px 8px';
                    chip.textContent = t.name;
                    tagListEl.appendChild(chip);
                });
            }

            window.attachTag = async (issueId, tagId) => {
                const res = await fetch(`{{ url('/issues') }}/${issueId}/tags/${tagId}`, {
                    method:'POST', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}
                });
                const data = await res.json();
                if(data?.ok) refreshTagList(data.tags);
            };

            window.detachTag = async (issueId, tagId) => {
                const res = await fetch(`{{ url('/issues') }}/${issueId}/tags/${tagId}`, {
                    method:'DELETE', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}
                });
                const data = await res.json();
                if(data?.ok) refreshTagList(data.tags);
            };

            function buildCommentCard(c){
                const div = document.createElement('div');
                div.className = 'card';
                const name = document.createElement('strong'); name.textContent = c.author_name;
                const time = document.createElement('span'); time.className='muted'; time.style.fontSize='12px'; time.textContent = c.created_at;
                const p = document.createElement('p'); p.textContent = c.body;
                div.append(name, document.createTextNode(' '), time, p);
                return div;
            }

            async function renderComments(url, append=false){
                if(!commentsWrap) return;
                const res = await fetch(url, {headers:{'Accept':'application/json'}});
                if(!res.ok) return;
                const payload = await res.json();

                const nodes = payload.data.map(buildCommentCard);
                if(append){ nodes.forEach(n => commentsWrap.appendChild(n)); }
                else { commentsWrap.innerHTML = ''; nodes.forEach(n => commentsWrap.appendChild(n)); }

                nextCommentsUrl = payload.meta.next_page_url;
                if(loadMoreBtn) loadMoreBtn.style.display = nextCommentsUrl ? 'inline-block' : 'none';
            }

            if(loadMoreBtn){
                loadMoreBtn.addEventListener('click', async (e)=>{
                    e.preventDefault();
                    if(nextCommentsUrl){ await renderComments(nextCommentsUrl, true); }
                });
            }

            if(commentForm){
                commentForm.addEventListener('submit', async (e)=>{
                    e.preventDefault();
                    const btn = commentForm.querySelector('button[type=submit]');
                    if(btn) btn.disabled = true;
                    const fd = new FormData(commentForm);
                    const errs = document.getElementById('commentErrors'); if (errs) errs.textContent='';

                    const res = await fetch(`{{ route('issues.comments.store',$issue) }}`, {
                        method:'POST', headers:{'X-CSRF-TOKEN':CSRF,'Accept':'application/json'}, body: fd
                    });

                    if(res.status === 201){
                        const {comment} = await res.json();
                        if(commentsWrap){
                            const card = buildCommentCard(comment);
                            commentsWrap.prepend(card);
                        }
                        commentForm.reset();
                    } else if(res.status === 422){
                        const {errors} = await res.json();
                        if (errs) errs.innerHTML = Object.values(errors).flat().join('<br>');
                    }
                    if(btn) btn.disabled = false;
                });
            }

            if(nextCommentsUrl) renderComments(nextCommentsUrl);
        });
    </script>
@endpush
