@extends($theme_layout)

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('questions') }}">Questions</a></li>
        <li class="active">Ask a question</li>
    </ol>
    
    {!! Form::open(['url' => 'questions']) !!}
        @include ('questions.partials.form', ['btnText' => 'Ask a question'])
    {!! Form::close() !!}
    
    @include ('errors.list')
@stop