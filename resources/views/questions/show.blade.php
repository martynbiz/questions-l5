@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">{{$question->title}}</li>
    </ol>
    
    <div class="body">{{$question->content}}</div>
    
    <div>
        <a href="{{route('questions.edit', [$question->id])}}" class="btn btn-default">Edit</a>
    </div>
    
    <hr>
    
    <h2>{{$question->answers->count()}} answers</h2>
    
    <p>Write your own answer</p>
    
    {!! Form::open(['action' => 'AnswersController@store', 'method' => 'POST']) !!}
        <div class="form-group">
            {!! Form::label('content', 'Content:') !!}
            {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
        </div>
        
        {!! Form::hidden('question_id', $question->id) !!}

        <div class="form-group">
            {!! Form::submit('Answer', ['class'=>'btn btn-primary']) !!}
        </div>
    {!! Form::close() !!}
@stop