@extends('layouts.app')

@section('content')
    <div class="card">
        <form id="filtersForm" method="GET" action="{{ route('issues.index') }}" class="row" style="gap:12px">
            <input id="searchField" type="text" name="q" placeholder="Search..." value="{{ $filters['q'] ?? '' }}">
            <select name="status">
                <option value="">All status</option>
                @foreach(['open'=>'Open','in_progress'=>'In progress','closed'=>'Closed'] as $k=>$v)
                    <option value="{{ $k }}" @selected(($filters['status'] ?? '')==$k)>{{ $v }}</option>
                @endforeach
            </select>
            <select name="priority">
                <option value="">All priority</option>
                @foreach(['low'=>'Low','medium'=>'Medium','high'=>'High'] as $k=>$v)
                    <option value="{{ $k }}" @selected(($filters['priority'] ?? '')==$k)>{{ $v }}</option>
                @endforeach
            </select>
            <select name="tag">
                <option value="">All tags</option>
                @foreach($tags as $t)
                    <option value="{{ $t->id }}" @selected(($filters['tag'] ?? '')==$t->id)>{{ $t->name }}</option>
                @endforeach
            </select>
            <a class="btn" href="{{ route('issues.index') }}">Reset</a>
            <a class="btn primary" href="{{ route('issues.create') }}">+ New Issue</a>
        </form>
    </div>

    <div id="issuesWrap">
        @include('issues._list')
    </div>
    {{ $issues->onEachSide(1)->links('vendor.pagination.simple-clean') }}

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const form = document.getElementById('filtersForm');
            const wrap = document.getElementById('issuesWrap');
            const search  = document.getElementById('searchField');
            const selects = form.querySelectorAll('select');

            function params() { return new URLSearchParams(new FormData(form)).toString(); }
            function fetchList(url) {
                fetch(url, {headers:{'X-Requested-With':'XMLHttpRequest'}})
                    .then(r=>r.text())
                    .then(html=>{
                        wrap.innerHTML = html;
                        history.replaceState(null, '', url);
                    });
            }
            function updateList() {
                const url = "{{ route('issues.index') }}" + "?" + params();
                fetchList(url);
            }

            selects.forEach(s => s.addEventListener('change', updateList));

            let t;
            if (search) {
                search.addEventListener('input', function(){
                    clearTimeout(t);
                    const v = this.value.trim();
                    if (v.length === 0) { t = setTimeout(updateList, 250); return; }
                    if (v.length < 3) return;
                    t = setTimeout(updateList, 600);
                });
                search.addEventListener('keydown', e => { if (e.key === 'Enter') e.preventDefault(); });
            }

            wrap.addEventListener('click', function(e){
                const a = e.target.closest('.pager a'); // ishte .pagination a
                if (!a) return;
                e.preventDefault();
                fetchList(a.href);
            });


            window.addEventListener('popstate', function(){
                fetchList(location.href);
            });
        });
    </script>
@endpush
