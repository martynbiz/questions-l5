@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('') }}">Home</a></li>
        <li><a href="{{ url('admin') }}">Admin</a></li>
        <li class="active">Tags</li>
    </ol>
    
    <div class="well">
        <a href="{{url('admin/tags/create')}}" class="btn btn-primary">Create tag</a>&nbsp;&nbsp;
        <a href="#" class="btn btn-default">Import</a>&nbsp;&nbsp;
        <a href="#" class="btn btn-default">Export</a>
    </div>
    
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th># of Questions</th>
        </tr>
        @foreach($tags as $tag)
            <tr>
                <td>{{$tag->name}}</td>
                <td width="20%">...</td>
            </tr>
        @endforeach
    </table>
@stop