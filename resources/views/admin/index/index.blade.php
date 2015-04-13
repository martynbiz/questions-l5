@extends($theme_layout)

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('') }}">Home</a></li>
        <li class="active">Admin</li>
    </ol>
    
    <ul>
        <li><a href="{{ url('/admin/users') }}">Users</a></li>
        <li><a href="{{ url('/admin/questions') }}">Questions</a></li>
        <li><a href="{{ url('/admin/answers') }}">Answers</a></li>
        <li><a href="{{ url('/admin/tags') }}">Tag</a></li>
    </ul>
@stop