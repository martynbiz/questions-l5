@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Questions</li>
    </ol>
    
    @foreach($questions as $question)
        <div class="question">
            <h2><a href="{{ url($question->id) }}">{{$question->title}}</a></h2>
            <div class="info">Asked by {{$question->user->name}} | {{$question->created_at_formatted}}</div>
            <div class="buttons">
                <a href="#" class="btn btn-default btn-xs">Follow | {{$question->follows->count()}}</a>
                <a href="#" class="btn btn-default btn-xs">Answers | {{$question->answers->count()}}</a>
            </div>
        </div>
    @endforeach
    
    <a href="{{url('ask')}}" class="btn btn-default">Ask a question</a>
@stop