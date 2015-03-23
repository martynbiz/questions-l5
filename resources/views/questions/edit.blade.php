@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Home</a></li>
        <li><a href="{{ route('show', [$question->id]) }}">{{$question->title}}</a></li>
        <li class="active">Edit</li>
    </ol>
    
    {!! Form::model($question, ['action' => ['QuestionsController@update', $question->id], 'method' => 'PATCH']) !!}
        @include ('questions.partials.form', ['btnText' => 'Update question'])
    {!! Form::close() !!}
    
    @include ('errors.list')
@stop