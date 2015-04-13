@extends($theme_layout)

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('') }}">Home</a></li>
        <li><a href="{{ url('admin') }}">Admin</a></li>
        <li><a href="{{ url('admin/users') }}">Users</a></li>
        <li class="active">{{$user->name}}</li>
    </ol>
    
    <table class="table table-striped">
        <tr>
            <th>Username</th>
            <td>{{$user->username}}</td>
        </tr>
        <tr>
            <th>Name</th>
            <td>{{$user->name}}</td>
        </tr>
        <tr>
            <th>Email</th>
            <td>{{$user->email}}</td>
        </tr>
        <tr>
            <th>Created at</th>
            <td>{{$user->date_created}}</td>
        </tr>
    </table>
@stop