@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('admin') }}">Admin</a></li>
        <li class="active">Questions</li>
    </ol>
    
    @include ('admin.questions.partials.tabs', ['page' => 'List', 'total_pending' => $total_pending])
    
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th width="20%"># of Answers</th>
            <th width="20%"># of Follows</th>
            <th width="20%">Date Created</th>
        </tr>
        @foreach($questions as $question)
            <tr>
                <td><a href="{{route('questions.show', $question->id)}}">{{$question->title}}</a></td>
                <td>{{$question->total_answers}}</td>
                <td>{{$question->total_follows}}</td>
                <td>{{$question->date_created}}</td>
            </tr>
        @endforeach
    </table>
    
    {!! $questions->render() !!}
@stop