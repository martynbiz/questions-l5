@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('') }}">Home</a></li>
        <li class="active">Admin</li>
    </ol>
    
    <ul>
        <li><a href="{{ url('account/profile') }}">Profile</a></li>
        <li><a href="{{ url('account/questions') }}">Questions</a></li>
        <li><a href="{{ url('account/answers') }}">Answers</a></li>
    </ul>
@stop