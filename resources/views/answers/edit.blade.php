@extends($theme_layout)

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url($answer->id) }}">{{$answer->title}}</a></li>
        <li class="active">Edit</li>
    </ol>
    
    {!! Form::model($answer, ['action' => ['AnswersController@update', $answer->id], 'method' => 'PATCH']) !!}
        @include ('answers.partials.form', ['btnText' => 'Update question'])
    {!! Form::close() !!}
    
    @include ('errors.list')
@stop