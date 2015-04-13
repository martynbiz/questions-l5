@extends($theme_layout)

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li class="active">{{$question->title}}</li>
    </ol>
    
    <div class="info">Asked by {{$question->user->name}} | {{$question->date_created}}</div>
    
    <div class="body">{{$question->content}}</div>
    
    <div>
        {!! Form::open(array('route' => array('questions.destroy', $question->id), 'method' => 'delete', 'id' => 'questionDelete_' . $question->id)) !!}
            @if (Auth::user() and Auth::user()->canUpdate($question))
                <a href="{{route('questions.edit', [$question->id])}}">Edit</a>
            @endif
            @if (Auth::user() and Auth::user()->canDelete($question))
                <a href="#" onclick="$('#questionDelete_{{$question->id}}').confirmSubmit('Are you sure you want to delete this question?'); return false;">Delete</a>
            @endif
        {!! Form::close() !!}
    </div>
    
    @foreach($question->tags as $tag)
        <a href="{{url('tags/' . $tag->id . '/' . $tag->slug)}}" class="badge">{{$tag->name}}</a>
    @endforeach
    
    <hr>
    
    <h2>{{$question->answers->count()}} answers</h2>
    
    @foreach($question->answers as $answer)
        <div class="answer">
            <div class="info">Answered by {{$answer->user->name}} | {{$answer->date_created}}</div>
            <div>{{{$answer->content}}}</div>
            
            @if (Auth::user() and (Auth::user()->canUpdate($answer) or Auth::user()->canDelete($answer)))
                <div>
                    {!! Form::open(array('route' => array('answers.destroy', $answer->id), 'method' => 'delete', 'id' => 'answerDelete_' . $answer->id)) !!}
                        @if (Auth::user()->canUpdate($answer))
                            <a href="{{route('answers.edit', [$answer->id])}}">Edit</a>
                        @endif |
                        @if (Auth::user()->canDelete($answer))
                            <a href="#" onclick="$('#answerDelete_{{$answer->id}}').confirmSubmit('Are you sure you want to delete this answer?'); return false;">Delete</a>
                        @endif
                    {!! Form::close() !!}
                </div>
            @endif
        </div>
    @endforeach
    
    @if (Auth::user() and !Auth::user()->hasAnswered($question) and !Auth::user()->isOwnerOf($question))
        <p>Write your own answer</p>
        
        {!! Form::open(['action' => 'AnswersController@store', 'method' => 'POST']) !!}
            @include ('answers.partials.form', ['btnText' => 'Answer question'])
        {!! Form::close() !!}
    @endif
@stop