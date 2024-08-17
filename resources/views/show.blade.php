@extends('layouts.app')

@section('title',$task->title)

@section('content')
<p>{{$task->description}}</p>

@if($task->long_description)
<p>{{$task->long_description}}</p>
@endif

<p>任務創造於:{{$task->created_at}}</p>
<p>任務更新於:{{$task->updated_at}}</p>

<div>
<form action="{{route('tasks.destory',['task'=>$task->id])}}" method="POST">
    @csrf
    @method('DELETE')
    <button type="submit">刪除</button>
</form>

</div>

@endsection