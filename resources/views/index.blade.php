<div>
    Hello In a blade tamplete
</div>
<div>
    <!-- @if (count($tasks)) -->
    @forelse ($tasks as $task)
        <div>
            <a href="{{route('tasks.show',['task'=>$task->id])}}">{{$task->title}}</a>
        </div>
    @empty
        <div>There are no tasks!</div>
    @endforelse

    @if ($task->count())
        <nav>
            {{ $tasks->links() }}
        </nav>
    
    @endif
    <div>
        <h1>nothing</h1>
    </div>
    
    <!-- @endif -->
</div>

<!-- update -->