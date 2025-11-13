@extends('layouts.app')

@section('title', '任務列表')

@section('content')
    {{-- 將 "新增任務" 連結改為主要按鈕樣式 --}}
    <nav class="mb-6">
        <div>
            <a href="{{ route('tasks.create') }} " class="btn btn-primary">新增任務</a>
        </div>
    </nav>

    {{-- 為每個任務項目添加卡片樣式 --}}
    @forelse ($tasks as $task)
        <div class="mb-3 p-4 bg-white rounded-lg shadow-sm border border-gray-200 flex justify-between items-center">
            {{-- 任務標題 --}}
            <span class="text-lg">
                <a href="{{ route('tasks.show', ['task' => $task->id]) }}" @class([
                    'font-medium text-gray-900 hover:text-indigo-600',
                    'line-through text-gray-500' => $task->completed,
                ])>
                    {{ $task->title }}
                </a>
            </span>

            {{-- 任務狀態 (簡易圖示) --}}
            <span class="text-lg">
                @if ($task->completed)
                    <span title="已完成">✅</span>
                @else
                    <span title="未完成" class="text-gray-400">...</span>
                @endif
            </span>
        </div>
    @empty
        <div class="text-gray-500 text-center">目前沒有任何任務</div>
    @endforelse

    {{-- 分頁 --}}
    @if ($tasks->count())
        <nav class="mt-8">
            {{ $tasks->links() }}
        </nav>
    @endif
@endsection
