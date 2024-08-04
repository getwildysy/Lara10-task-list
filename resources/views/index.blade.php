<div>
    <h1>The list of tasks</h1>
</div>
<div>
    {{-- @if(count($tasks)) --}}
    <div>
       @forelse ($tasks as $task)
       <div>
        <a href="{{route('tasks.show',['id'=>$task->id])}}">{{$task->title}}</a>
       </div>
       @empty
       <div>
          There are no Tasks
       </div>
       @endforelse
    </div>
 
    {{-- @endif --}}
</div>