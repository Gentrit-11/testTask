<?php

    namespace App\Http\Controllers;

    use App\Models\Project;
    use App\Http\Requests\ProjectStoreRequest;
    use App\Http\Requests\ProjectUpdateRequest;

    class ProjectController extends Controller
    {
        public function index()
        {
            $projects = Project::withCount('issues')->latest()->paginate(10);
            return view('projects.index', compact('projects'));
        }

        public function create()
        {
            return view('projects.create');
        }

        public function store(ProjectStoreRequest $request)
        {
            Project::create($request->validated());
            return redirect()->route('projects.index')->with('success','Project created.');
        }

        public function show(Project $project)
        {
            $project->load(['issues' => fn($q)=>$q->latest()]);
            return view('projects.show', compact('project'));
        }

        public function edit(Project $project)
        {
            return view('projects.edit', compact('project'));
        }

        public function update(ProjectUpdateRequest $request, Project $project)
        {
            $project->update($request->validated());
            return redirect()->route('projects.show',$project)->with('success','Project updated.');
        }

        public function destroy(Project $project)
        {
            $project->delete();
            return redirect()->route('projects.index')->with('success','Project deleted.');
        }
    }
