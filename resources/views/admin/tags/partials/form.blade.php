<div class="form-group">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', $tag->name, ['class'=>'']) !!}
</div>

<div class="form-group">
    {!! Form::submit($btnText, ['class'=>'btn btn-primary']) !!}
</div>