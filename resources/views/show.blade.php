@extends('layouts.app')

@section('title', $task->title)

@section('content')
    <div class="mb-4">
        {{-- 加上返回箭頭 --}}
        <a href="{{ route('tasks.index') }} " class="link">&larr; 回首頁</a>
    </div>

    {{-- 描述 (字體加大) --}}
    <p class="mb-4 text-lg text-slate-700">{{ $task->description }}</p>

    {{-- 詳細描述 (保留換行) --}}
    @if ($task->long_description)
        <p class="mb-4 text-base text-slate-700 whitespace-pre-wrap">{{ $task->long_description }}</p>
    @endif

    {{-- 狀態 --}}
    <p class="mb-4 text-lg">
        <span @class([
            'font-medium',
            'text-green-500' => $task->completed,
            'text-red-500' => !$task->completed,
        ])>
            目前狀態為：{{ $task->completed ? '已完成' : '未完成' }}
        </span>
    </p>

    {{-- 時間戳 (加大下方間距) --}}
    <p class="mb-6 text-sm text-slate-500">
        任務創造於: {{ $task->created_at->diffForHumans() }};
        更新於: {{ $task->updated_at->diffForHumans() }}
    </p>

    {{-- 操作按鈕 (套用不同顏色) --}}
    <div class="flex flex-wrap gap-3">
        <a href="{{ route('tasks.edit', ['task' => $task]) }} " class="btn btn-warning">編輯</a>

        <form action="{{ route('tasks.toggle-complete', ['task' => $task]) }}" method="POST">
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-secondary">
                標記為{{ $task->completed ? '未完成' : '已完成' }}
            </button>
        </form>

        <form action="{{ route('tasks.destory', ['task' => $task->id]) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">刪除</button>
        </form>
    </div>
@endsection
