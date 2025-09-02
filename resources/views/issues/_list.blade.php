@foreach($issues as $i)
    <div class="card">
        <div class="row" style="justify-content:space-between">
            <div>
                <a href="{{ route('issues.show',$i) }}"><strong>{{ $i->title }}</strong></a>
                <div class="muted">
                    Project: {{ $i->project->name ?? '—' }}
                    · Status: {{ $i->status }}
                    · Priority: {{ $i->priority }}
                    @if($i->due_date) · Due: {{ $i->due_date }} @endif
                </div>
            </div>
            <div class="row">
                <a class="btn" href="{{ route('issues.edit',$i) }}">Edit</a>
                <form action="{{ route('issues.destroy',$i) }}" method="POST" onsubmit="return confirm('Delete?')">
                    @csrf @method('DELETE')
                    <button class="btn">Delete</button>
                </form>
            </div>
        </div>
    </div>
@endforeach
