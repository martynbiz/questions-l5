<div class="form-group">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::label('tags', 'Tags:') !!}
    {!! Form::select('tags', $tags->lists('name', 'id'), $question->tags->lists('id'), ['multiple'=>'multiple', 'name'=>'tags[]']) !!}
</div>

<div class="form-group">
    {!! Form::submit($btnText, ['class'=>'btn btn-primary form-control']) !!}
</div>