@extends($theme_layout)

@section('content')
    @include ('questions.partials.hometabs', [
        'newest' => $newest,
        'popular' => $popular,
        'unanswered' => $unanswered,
        'active' => 'Unanswered',
    ])
@stop