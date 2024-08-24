@extends('layouts.app')

@section('title', 'The list of tasks')

@section('content')

    <div>
        <a href="{{ route('tasks.create') }}">新增任務</a>
    </div>

    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{ $task->title }}</a>
        </div>
    @empty
        <div>There are no Tasks</div>
    @endforelse

    {{-- 分頁 --}}
    @if ($tasks->count())
        <nav> {{ $tasks->links('pagination::simple-bootstrap-5') }} </nav>
        <div> Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} results </div>
    @endif


@endsection
