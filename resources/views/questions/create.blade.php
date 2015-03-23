@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">Home</a></li>
        <li class="active">Ask a question</li>
    </ol>
    
    {!! Form::open(['action' => 'QuestionsController@store', 'method' => 'POST']) !!}
        @include ('questions.partials.form', ['btnText' => 'Ask a question'])
    {!! Form::close() !!}
    
    @include ('errors.list')
@stop