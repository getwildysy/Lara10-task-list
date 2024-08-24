@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <p>{{ $task->description }}</p>

    @if ($task->long_description)
        <p>{{ $task->long_description }}</p>
    @endif

    <div>
        <p>目前狀態為{{ $task->completed ? '已完成' : '未完成' }}</p>
    </div>

    <p>任務創造於:{{ $task->created_at }}</p>
    <p>任務更新於:{{ $task->updated_at }}</p>

    <div>
        <a href="{{ route('tasks.edit', ['task' => $task]) }}">編輯</a>
    </div>



    <div>
        <form action="{{ route('tasks.toggle-complete', ['task' => $task]) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit">標記為{{ $task->completed ? '未完成' : '已完成' }}</button>
        </form>
    </div>


    <div>
        <form action="{{ route('tasks.destory', ['task' => $task->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit">刪除</button>
        </form>

    </div>

@endsection
