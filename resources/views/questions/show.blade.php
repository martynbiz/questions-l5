@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Home</a></li>
        <li class="active">{{$question->title}}</li>
    </ol>
    
    <div class="body">{{$question->content}}</div>
    
    <div>
        <a href="{{route('edit', [$question->id])}}" class="btn btn-default">Edit</a>
    </div>
@stop