@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">{{$question->title}}</li>
    </ol>
    
    <div class="body">{{$question->content}}</div>
    
    <div>
        {!! Form::open(array('route' => array('questions.destroy', $question->id), 'method' => 'delete', 'id' => 'questionDelete')) !!}
            <a href="{{route('questions.edit', [$question->id])}}">Edit</a> |
            <a href="#" onclick="document.getElementById('questionDelete').submit(); return false;">Delete</a>
        {!! Form::close() !!}
    </div>
    
    <hr>
    
    <h2>{{$question->answers->count()}} answers</h2>
    
    @foreach($question->answers as $answer)
        <div class="answer">
            <div class="info">Answered by {{$answer->user->name}} | {{$answer->created_at_formatted}}</div>
            <div>{{{$answer->content}}}</div>
            
            @if (Auth::user() and (Auth::user()->canUpdate($answer) or Auth::user()->canDelete($answer)))
                <div>
                    {!! Form::open(array('route' => array('answers.destroy', $answer->id), 'method' => 'delete', 'id' => 'answerDelete')) !!}
                        @if (Auth::user()->canUpdate($answer))
                            <a href="{{route('answers.edit', [$answer->id])}}">Edit</a>
                        @endif |
                        @if (Auth::user()->canDelete($answer))
                            <a href="#" onclick="document.getElementById('answerDelete').submit(); return false;">Delete</a>
                        @endif
                    {!! Form::close() !!}
                </div>
            @endif
        </div>
    @endforeach
    
    @if (Auth::user() and !Auth::user()->hasAnswered($question) and !Auth::user()->isOwnerOf($question))
        <p>Write your own answer</p>
        
        {!! Form::open(['action' => 'AnswersController@store', 'method' => 'POST']) !!}
            @include ('answers.partials.form', ['btnText' => 'Answer question'])
        {!! Form::close() !!}
    @endif
@stop