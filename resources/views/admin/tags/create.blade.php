@extends($theme_layout)

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('') }}">Home</a></li>
        <li><a href="{{ url('admin') }}">Admin</a></li>
        <li><a href="{{ url('admin/tags') }}">Tags</a></li>
        <li class="active">Create tag</li>
    </ol>
    
    {!! Form::open(['action' => 'Admin\TagsController@store', 'method' => 'POST']) !!}
        @include ('admin.tags.partials.form', ['btnText' => 'Create a tag'])
    {!! Form::close() !!}
    
    @include ('errors.list')
@stop