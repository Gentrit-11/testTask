@extends('layouts.app')

@section('content')
    <div class="row" style="justify-content:space-between;align-items:center">
        <h2>Projects</h2>
        <a href="{{ route('projects.create') }}" class="btn primary">+ New Project</a>
    </div>

    @forelse($projects as $p)
        <div class="card">
            <div class="row" style="justify-content:space-between;align-items:flex-start">
                <div>
                    <a href="{{ route('projects.show',$p) }}"><strong>{{ $p->name }}</strong></a>
                    <div class="muted">Issues: {{ $p->issues_count ?? $p->issues()->count() }}</div>
                    @if($p->description)
                        <p class="muted" style="margin-top:6px">{{ $p->description }}</p>
                    @endif
                </div>

                <div class="row">
                    <a class="btn" href="{{ route('projects.edit',$p) }}">Edit</a>
                    <form action="{{ route('projects.destroy',$p) }}" method="POST" onsubmit="return confirm('Delete?')">
                        @csrf @method('DELETE')
                        <button class="btn">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="card"><span class="muted">No projects yet.</span></div>
    @endforelse

    {{ $projects->onEachSide(1)->links('vendor.pagination.simple-clean') }}
@endsection
