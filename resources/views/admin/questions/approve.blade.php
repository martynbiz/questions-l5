@extends($theme_layout)

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('admin') }}">Admin</a></li>
        <li class="active">Questions</li>
    </ol>
    
    @include ('admin.questions.partials.tabs', ['page' => 'Approve', 'total_pending' => $total_pending])
    
    @foreach($questions as $question)
        {!! Form::model($question, ['action' => ['Admin\QuestionsController@update', $question->id], 'method' => 'PATCH']) !!}
            <div class="well">
                <div class="row">
                    <div class="col-sm-10">
                        <p class="title">{{$question->title}}</p>
                        <div class="content">
                            {{$question->content}}
                        </div>
                        <p class="stats">Asked by {{$question->user->name}} | {{$question->date_created}}</p>
                    </div>
                    
                    {!! Form::hidden('is_approved', 1) !!}
                    
                    <div class="col-sm-2 text-right">
                        {!! Form::submit('Approve', ['class'=>'btn btn-default']) !!}
                    </div>
                </div>
            </div>
        {!! Form::close() !!}
    @endforeach
    
    {!! $questions->render() !!}
@stop