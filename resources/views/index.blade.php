@extends('layouts.app')

@section('title', '任務列表')

@section('content')
    {{-- 下列link樣式寫在app.index的head裡 --}}
    <nav class="mb-4">
        <div>
            <a href="{{ route('tasks.create') }} " class="link">新增任務</a>
        </div>
    </nav>

    {{-- 使用@Class傳遞一個陣列，動態的為任務完成狀態添加刪除線 --}}
    @forelse ($tasks as $task)
        <div>
            <a href="{{ route('tasks.show', ['task' => $task->id]) }}" @class(['line-through font-bold' => $task->completed])>{{ $task->title }}</a>
        </div>
    @empty
        <div>沒有任務</div>
    @endforelse

    {{-- 分頁 --}}
    <nav class="mt-4">
        @if ($tasks->count())
            {{ $tasks->links() }}
    </nav>
    {{-- <div> Showing {{ $tasks->firstItem() }} to {{ $tasks->lastItem() }} of {{ $tasks->total() }} results </div> --}}
    @endif


@endsection
