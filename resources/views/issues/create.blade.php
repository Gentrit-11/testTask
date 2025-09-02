@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>New Issue</h2>

        <form action="{{ route('issues.store') }}" method="POST" class="row" style="flex-direction:column;gap:12px">
            @csrf

            <div class="field">
                <label>Project</label>
                <select name="project_id">
                    <option value="">Select project</option>
                    @foreach($projects as $p)
                        <option value="{{ $p->id }}" @selected(old('project_id')==$p->id)>{{ $p->name }}</option>
                    @endforeach
                </select>
                @error('project_id')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title') }}">
                @error('title')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>Description</label>
                <textarea name="description">{{ old('description') }}</textarea>
                @error('description')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="row" style="gap:12px;flex-wrap:wrap">
                <div class="field">
                    <label>Status</label>
                    <select name="status">
                        @foreach(['open'=>'Open','in_progress'=>'In progress','closed'=>'Closed'] as $k=>$v)
                            <option value="{{ $k }}" @selected(old('status')==$k)>{{ $v }}</option>
                        @endforeach
                    </select>
                    @error('status')<div class="error">{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label>Priority</label>
                    <select name="priority">
                        @foreach(['low'=>'Low','medium'=>'Medium','high'=>'High'] as $k=>$v)
                            <option value="{{ $k }}" @selected(old('priority')==$k)>{{ $v }}</option>
                        @endforeach
                    </select>
                    @error('priority')<div class="error">{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label>Due date</label>
                    <input type="date" name="due_date" value="{{ old('due_date') }}">
                    @error('due_date')<div class="error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <button class="btn">Create</button>
                <a class="btn" href="{{ route('issues.index') }}">Cancel</a>
            </div>
        </form>
    </div>
@endsection
