@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('tags') }}">Tags</a></li>
        <li class="active">{{$tag->name}}</li>
    </ol>
    
    @include ('questions.partials.list', ['questions' => $tag->questions])
@stop