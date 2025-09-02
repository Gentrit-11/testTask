@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Edit Issue</h2>

        <form action="{{ route('issues.update',$issue) }}" method="POST" class="row" style="flex-direction:column;gap:12px">
            @csrf @method('PUT')

            <div class="field">
                <label>Project</label>
                <select name="project_id">
                    @foreach($projects as $p)
                        <option value="{{ $p->id }}" @selected(old('project_id',$issue->project_id)==$p->id)>{{ $p->name }}</option>
                    @endforeach
                </select>
                @error('project_id')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>Title</label>
                <input type="text" name="title" value="{{ old('title',$issue->title) }}">
                @error('title')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="field">
                <label>Description</label>
                <textarea name="description">{{ old('description',$issue->description) }}</textarea>
                @error('description')<div class="error">{{ $message }}</div>@enderror
            </div>

            <div class="row" style="gap:12px;flex-wrap:wrap">
                <div class="field">
                    <label>Status</label>
                    <select name="status">
                        @foreach(['open'=>'Open','in_progress'=>'In progress','closed'=>'Closed'] as $k=>$v)
                            <option value="{{ $k }}" @selected(old('status',$issue->status)==$k)>{{ $v }}</option>
                        @endforeach
                    </select>
                    @error('status')<div class="error">{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label>Priority</label>
                    <select name="priority">
                        @foreach(['low'=>'Low','medium'=>'Medium','high'=>'High'] as $k=>$v)
                            <option value="{{ $k }}" @selected(old('priority',$issue->priority)==$k)>{{ $v }}</option>
                        @endforeach
                    </select>
                    @error('priority')<div class="error">{{ $message }}</div>@enderror
                </div>

                <div class="field">
                    <label>Due date</label>
                    <input type="date" name="due_date" value="{{ old('due_date',$issue->due_date) }}">
                    @error('due_date')<div class="error">{{ $message }}</div>@enderror
                </div>
            </div>

            <div class="row">
                <button class="btn">Save</button>
                <a class="btn" href="{{ route('issues.show',$issue) }}">Back</a>
            </div>
        </form>
    </div>
@endsection
