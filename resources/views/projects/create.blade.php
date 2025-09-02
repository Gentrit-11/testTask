@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>New Project</h2>

        <form action="{{ route('projects.store') }}" method="POST" class="row" style="flex-direction:column;gap:12px">
            @csrf

            <div class="field">
                <label>Name</label>
                <input type="text" name="name" value="{{ old('name') }}">
                @error('name')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>Description</label>
                <textarea name="description">{{ old('description') }}</textarea>
                @error('description')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="row" style="gap:12px;flex-wrap:wrap">
                <div class="field">
                    <label>Start date</label>
                    <input type="date" name="start_date" value="{{ old('start_date') }}">
                    @error('start_date')<div class="error">{{ $message }}</div>@enderror
                </div>
                <div class="field">
                    <label>Deadline</label>
                    <input type="date" name="deadline" value="{{ old('deadline') }}">
                    @error('deadline')<div class="error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <button class="btn">Create</button>
                <a class="btn" href="{{ route('projects.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
