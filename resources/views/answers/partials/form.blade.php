<div class="form-group">
    {!! Form::label('content', 'Content:') !!}
    {!! Form::textarea('content', null, ['class'=>'form-control']) !!}
</div>

{!! Form::hidden('answer_id', $answer->id) !!}

<div class="form-group">
    {!! Form::submit($btnText, ['class'=>'btn btn-primary']) !!}
</div>