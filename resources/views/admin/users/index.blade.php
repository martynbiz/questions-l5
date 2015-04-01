@extends('app')

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('/') }}">Home</a></li>
        <li><a href="{{ url('admin') }}">Admin</a></li>
        <li class="active">User</li>
    </ol>
    
    <table class="table table-striped">
        <tr>
            <th>Username</th>
            <th>Name</th>
            <th>Email</th>
            <th width="20%"></th>
        </tr>
        @foreach($users as $user)
            <tr>
                <td>{{$user->username}}</td>
                <td>{{$user->name}}</td>
                <td>{{$user->email}}</td>
                <td>
                    {!! Form::open(array('route' => array('admin.users.destroy', $user->id), 'method' => 'delete', 'id' => 'userDelete_' . $user->id)) !!}
                        <a href="{{route('admin.users.show', [$user->id])}}">Show</a> |
                        <a onclick="$('#userDelete_{{$user->id}}').confirmSubmit('Are you sure you want to delete this user?'); return false;" href="{{route('admin.users.destroy', [$user->id])}}">Delete</a>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    
    {!! $users->render() !!}
@stop