@extends('layouts.app')
@section('content')
    <div class="card">
        <h2>{{ $project->name }}</h2>
        @if($project->description)<p class="muted">{{ $project->description }}</p>@endif
        <div class="muted">
            Start: {{ optional($project->start_date)->toDateString() ?? '—' }} ·
            Deadline: {{ optional($project->deadline)->toDateString() ?? '—' }}
        </div>
    </div>

    <div class="card">
        <h3>Issues</h3>
        @forelse($project->issues as $i)
            <div class="row" style="justify-content:space-between;border-top:1px solid #e5e7eb;padding-top:8px;margin-top:8px">
                <div>
                    <strong>{{ $i->title }}</strong>
                    <div class="muted">Status: {{ $i->status }} · Priority: {{ $i->priority }}</div>
                </div>
            </div>
        @empty
            <div class="muted">No issues yet.</div>
        @endforelse
    </div>
@endsection
