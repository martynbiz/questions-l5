@extends($theme_layout)

@section('content')
    <ol class="breadcrumb">
        <li><a href="{{ url('') }}">Home</a></li>
        <li><a href="{{ url('admin') }}">Admin</a></li>
        <li class="active">Tags</li>
    </ol>
    
    <table class="table table-striped">
        <tr>
            <th>Name</th>
            <th># of Questions</th>
            <th></th>
        </tr>
        @foreach($tags as $tag)
            <tr>
                <td>{{$tag->name}}</td>
                <td width="20%">{{$tag->total_questions}}</td>
                <td width="20%">
                    {!! Form::open(array('route' => array('admin.tags.destroy', $tag->id), 'method' => 'delete', 'id' => 'tagDelete_' . $tag->id)) !!}
                        @if (Auth::user()->canUpdate($tag))
                            <a href="{{route('admin.tags.edit', [$tag->id])}}">Edit</a>
                        @endif |
                        @if (Auth::user()->canDelete($tag))
                            <a onclick="$('#tagDelete_{{$tag->id}}').confirmSubmit('Are you sure you want to delete this tag?'); return false;" href="{{route('admin.tags.destroy', [$tag->id])}}">Delete</a>
                        @endif
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </table>
    
    {!! $tags->render() !!}
    
    <div>
        <a href="{{route('admin.tags.create')}}" class="btn btn-primary">Create tag</a>
    </div>
@stop