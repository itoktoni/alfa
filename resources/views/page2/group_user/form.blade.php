
<div class="form-group">
    {!! Form::label($template.'_code', 'Code', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($template.'_code') ? 'has-error' : ''}}">
        {!! Form::text($template.'_code', null, ['class' => 'form-control', isset($model) ? 'readonly' : '' ]) !!}
        {!! $errors->first($template.'_code', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label($template.'_name', 'Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($template.'_name') ? 'has-error' : ''}}">
        {!! Form::text($template.'_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first($template.'_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', 'Template Dashboard', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($template.'_dashboard') ? 'has-error' : ''}}">
        {!! Form::text($template.'_dashboard', null, ['class' => 'form-control']) !!}
        {!! $errors->first($template.'_dashboard', '<p class="help-block">:message</p>') !!}
    </div>
    
    {!! Form::label('action_name', 'Visible', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($template.'_visible') ? 'has-error' : ''}}">
        {{ Form::select($template.'_visible', ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control']) }}
        {!! $errors->first($template.'_visible', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    
    {!! Form::label('name', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea($template.'_description', null, ['id' => 'summernote', 'class' => 'form-control', 'rows' =>
        '3']) !!}
    </div>
</div>