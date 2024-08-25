@extends('layouts.app')

@section('title', $task->title)

@section('content')
    {{-- 下列link樣式寫在app.index的head裡 --}}
    <div class="mb-4">
        <a href="{{ route('tasks.index') }} " class="link">回首頁</a>
    </div>


    <p class="mb-4 text-slate-700">{{ $task->description }}</p>

    @if ($task->long_description)
        <p class="mb-4  text-slate-700">{{ $task->long_description }}</p>
    @endif


    <p class="mb-4  text-slate-700"><span @class([
        'font - medium',
        'text-green-500' => $task->completed,
        'text-red-500' => !$task->completed,
    ])>目前狀態為{{ $task->completed ? '已完成' : '未完成' }}
        </span></p>

    {{-- 下列3個按鈕的btn樣式寫在app.index的head裡 --}}
    <p class="mb-4 text-sm  text-slate-500">任務創造於:{{ $task->created_at->diffForHumans() }};
        更新於:{{ $task->updated_at->diffForHumans() }}</p>

    <div class="flex gap-3 ">
        <a href="{{ route('tasks.edit', ['task' => $task]) }} " class="btn">編輯</a>

        <form action="{{ route('tasks.toggle-complete', ['task' => $task]) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="btn">標記為{{ $task->completed ? '未完成' : '已完成' }}</button>
        </form>

        <form action="{{ route('tasks.destory', ['task' => $task->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn">刪除</button>
        </form>

    </div>

@endsection
