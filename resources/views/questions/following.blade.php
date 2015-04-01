@extends('app')

@section('content')
    @include ('questions.partials.hometabs', [
        'newest' => $newest,
        'popular' => $popular,
        'unanswered' => $unanswered,
        'following' => $following,
        'active' => 'Following',
    ])
@stop