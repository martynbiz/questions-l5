@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('admin') }}">Admin</a></li>
        <li class="active">Answers</li>
    </ol>
    
    @foreach($answers as $answer)
        <div class="well">
            <p class="question">In answer to <a href="#">{{$answer->question->title}}</a></p>
            <div class="answer">
                {{$answer->content}}
            </div>
            <p class="stats">{{$answer->total_votes}} | {{$answer->date_created}}</p>
            
            <a href="#" class="btn btn-default">Approve</a>
        </div>
    @endforeach
    
    <a href="#" class="btn btn-default">Approve all</a>
    
    {!! $answers->render() !!}
@stop