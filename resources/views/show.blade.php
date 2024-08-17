@extends('layouts.app')

@section('title',$task->title)

@section('content')
<p>{{$task->description}}</p>

@if($task->long_description)
<p>{{$task->long_description}}</p>
@endif

<p>任務創造於:{{$task->created_at}}</p>
<p>任務更新於:{{$task->updated_at}}</p>

@endsection