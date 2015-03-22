@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('questions') }}">Questions</a></li>
        <li class="active">{{$question->title}}</li>
    </ol>
    
    <div class="body">{{$question->content}}</div>
    
    <div>
        <a href="{{route('questions.edit', [$question->id])}}" class="btn btn-default">Edit</a>
    </div>
@stop