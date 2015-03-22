@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Questions</li>
    </ol>
    
    @foreach($questions as $question)
        <article>
            <h2><a href="{{ action('QuestionsController@show', [$question->id]) }}">{{$question->title}}</a></h2>
            <div class="body">{{$question->content}}</div>
        </article>
    @endforeach
    
    <a href="{{route('questions.create')}}" class="btn btn-default">Ask a question</a>
@stop