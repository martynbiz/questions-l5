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
    {!! Form::text('tags', null, ['class'=>'form-control']) !!}
</div>

<div class="form-group">
    {!! Form::submit($btnText, ['class'=>'btn btn-primary form-control']) !!}
</div>