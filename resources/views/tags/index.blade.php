@extends('layouts.app')

@section('content')
    <div class="card">
        <h2>Tags</h2>

        <form action="{{ route('tags.store') }}" method="POST" class="row" style="gap:8px;flex-wrap:wrap">
            @csrf
            <input type="text" name="name" placeholder="Name" value="{{ old('name') }}">
            <input type="text" name="color" placeholder="Color (optional)" value="{{ old('color') }}">
            <button class="btn primary">Add</button>
        </form>

        @error('name') <div class="error">{{ $message }}</div> @enderror
        @error('color') <div class="error">{{ $message }}</div> @enderror
    </div>

    @foreach($tags as $t)
        <div class="card row" style="justify-content:space-between">
            <div><strong>{{ $t->name }}</strong> <span class="muted">{{ $t->color }}</span></div>
            <form action="{{ route('tags.destroy',$t) }}" method="POST" onsubmit="return confirm('Delete?')">
                @csrf @method('DELETE')
                <button class="btn">Delete</button>
            </form>
        </div>
    @endforeach
    {{ $tags->onEachSide(1)->links('vendor.pagination.simple-clean') }}

@endsection
