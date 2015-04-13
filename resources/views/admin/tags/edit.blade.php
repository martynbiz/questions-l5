@extends($theme_layout)

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('') }}">Home</a></li>
        <li><a href="{{ url('admin') }}">Admin</a></li>
        <li><a href="{{ url('admin/tags') }}">Tags</a></li>
        <li class="active">Edit</li>
    </ol>
    
    {!! Form::open(['action' => ['Admin\TagsController@update', $tag->id], 'method' => 'PATCH']) !!}
        @include ('admin.tags.partials.form', ['btnText' => 'Update'])
    {!! Form::close() !!}
    
    @include ('errors.list')
@stop