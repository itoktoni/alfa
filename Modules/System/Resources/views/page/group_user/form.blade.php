<div class="form-group">
    {!! Form::label('system_group_user_code', 'Code', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_user_code') ? 'has-error' : ''}}">
        {!! Form::text('system_group_user_code', null, ['class' => 'form-control', isset($model) ? 'readonly' : '' ])
        !!}
        {!! $errors->first('system_group_user_code', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_group_user_name', 'Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_user_name') ? 'has-error' : ''}}">
        {!! Form::text('system_group_user_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_group_user_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', 'Template Dashboard', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_user_dashboard') ? 'has-error' : ''}}">
        {!! Form::text('system_group_user_dashboard', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_group_user_dashboard', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('action_name', 'Visible', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_user_visible') ? 'has-error' : ''}}">
        {{ Form::select('system_group_user_visible', ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control']) }}
        {!! $errors->first('system_group_user_visible', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('name', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('system_group_user_description', null, ['class' => 'form-control', 'rows' =>
        '3']) !!}
    </div>
</div>