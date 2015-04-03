@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('admin') }}">Admin</a></li>
        <li class="active">Answers</li>
    </ol>
    
    @if (count($answers) > 0)
        @foreach($answers as $answer)
            {!! Form::model($answer, ['action' => ['Admin\AnswersController@update', $answer->id], 'method' => 'PATCH']) !!}
                <div class="well">
                    <div class="row">
                        <div class="col-sm-10">
                            <p class="question">In answer to <a href="#">{{$answer->question->title}}</a></p>
                            
                            <div class="answer">
                                {{$answer->content}}
                            </div>
                            <p class="stats">{{$answer->date_created}}</p>
                        </div>
                        
                        {!! Form::hidden('is_approved', 1) !!}
                        
                        <div class="col-sm-2 text-right">
                            {!! Form::submit('Approve', ['class'=>'btn btn-default']) !!}
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        @endforeach
    @else
        <p>There are no answers pending approval
    @endif
    
    {!! $answers->render() !!}
@stop