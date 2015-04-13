@extends($theme_layout)

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url($question->id) }}">{{$question->title}}</a></li>
        <li class="active">Edit</li>
    </ol>
    
    {!! Form::model($question, ['action' => ['QuestionsController@update', $question->id], 'method' => 'PATCH']) !!}
        @include ('questions.partials.form', ['btnText' => 'Update question'])
    {!! Form::close() !!}
    
    @include ('errors.list')
@stop