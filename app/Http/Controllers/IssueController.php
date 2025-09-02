<?php

    namespace App\Http\Controllers;

    use App\Models\Issue;
    use App\Models\Project;
    use App\Models\Tag;
    use App\Http\Requests\IssueStoreRequest;
    use App\Http\Requests\IssueUpdateRequest;
    use Illuminate\Http\Request;

    class IssueController extends Controller
    {
        public function index(\Illuminate\Http\Request $req)
        {
            $issues = \App\Models\Issue::with(['project','tags'])
                ->when($req->filled('status'),   fn($q) => $q->where('status',   $req->status))
                ->when($req->filled('priority'), fn($q) => $q->where('priority', $req->priority))
                ->when($req->filled('tag'),      fn($q) => $q->whereHas('tags', fn($t) => $t->where('tags.id', $req->tag)))
                ->when($req->filled('q'), function ($q) use ($req) {
                    $v = $req->q;
                    $q->where(fn($qq)=>$qq->where('title','like',"%{$v}%")->orWhere('description','like',"%{$v}%"));
                })
                ->latest()
                ->paginate(10)
                ->withQueryString();

            if ($req->ajax()) {
                return view('issues._list', compact('issues'))->render();
            }

            $filters = $req->only(['status','priority','tag','q']);
            $tags = \App\Models\Tag::orderBy('name')->get(['id','name']);
            return view('issues.index', compact('issues','filters','tags'));
        }


        public function create()
        {
            $projects = Project::orderBy('name')->get(['id','name']);
            return view('issues.create', compact('projects'));
        }

        public function store(IssueStoreRequest $request)
        {
            $issue = Issue::create($request->validated());
            return redirect()->route('issues.show',$issue)->with('success','Issue created.');
        }

        public function show(Issue $issue)
        {
            $issue->load(['project','tags']);
            $allTags = Tag::orderBy('name')->get(['id','name','color']);
            return view('issues.show', compact('issue','allTags'));
        }

        public function edit(Issue $issue)
        {
            $projects = Project::orderBy('name')->get(['id','name']);
            return view('issues.edit', compact('issue','projects'));
        }

        public function update(IssueUpdateRequest $request, Issue $issue)
        {
            $issue->update($request->validated());
            return redirect()->route('issues.show',$issue)->with('success','Issue updated.');
        }

        public function destroy(Issue $issue)
        {
            $issue->delete();
            return redirect()->route('issues.index')->with('success','Issue deleted.');
        }
    }
