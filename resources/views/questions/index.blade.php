@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Questions</li>
    </ol>
    
    @include ('questions.partials.list', ['questions' => $questions])
    
    <a href="{{url('ask')}}" class="btn btn-default">Ask a question</a>
@stop