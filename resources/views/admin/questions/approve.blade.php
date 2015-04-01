@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('admin') }}">Admin</a></li>
        <li class="active">Questions</li>
    </ol>
    
    <ul class="nav nav-tabs">
        <li role="presentation"><a href="{{route('admin.questions.index')}}">List</a></li>
        <li role="presentation" class="active"><a href="{{route('admin.questions.approve')}}">Approve</a></li>
    </ul>
    
    @foreach($questions as $question)
        <div class="well">
            <p class="title">{{$question->title}}</p>
            <div class="content">
                {{$question->content}}
            </div>
            <p class="stats">Asked by {{$question->user->name}} | {{$question->date_created}}</p>
            
            <a href="#" class="btn btn-default">Approve</a>
        </div>
    @endforeach
    
    <a href="#" class="btn btn-default">Approve all</a>
@stop