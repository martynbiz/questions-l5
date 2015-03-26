@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">Tags</li>
    </ol>
    
    @foreach($tags as $tag)
        <a href="{{url('tags/' . $tag->id . '/' . $tag->slug)}}" class="badge">{{$tag->name}}</a>
    @endforeach
@stop