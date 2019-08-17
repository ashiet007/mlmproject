<div class="form-group {{ $errors->has('type') ? 'has-error' : ''}}">
    {!! Form::label('type', 'Type', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('type', null, ('' == 'required') ? ['class' => 'form-control custom-input', 'required' => 'required', 'readonly'] : ['class' => 'form-control custom-input','readonly']) !!}
        {!! $errors->first('type', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('subject') ? 'has-error' : ''}}">
    {!! Form::label('subject', 'Subject', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-10">
        {!! Form::text('subject', null, ('' == 'required') ? ['class' => 'form-control custom-input', 'required' => 'required'] : ['class' => 'form-control custom-input']) !!}
        {!! $errors->first('subject', '<p class="help-block">:message</p>') !!}
    </div>
</div><div class="form-group {{ $errors->has('details') ? 'has-error' : ''}}">
    {!! Form::label('details', 'Details', ['class' => 'col-md-4 control-label']) !!}
    <div class="col-md-10">
        <textarea name="details" class="form-control custom-input" required rows="10" style="height: 120px !important;">{{$news->details}}</textarea>
        {!! $errors->first('details', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <div class="col-md-offset-4 col-md-4">
        {!! Form::submit(isset($submitButtonText) ? $submitButtonText : 'Create', ['class' => 'btn btn-secondary']) !!}
    </div>
</div>
