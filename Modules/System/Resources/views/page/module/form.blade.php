<div class="form-group">
    {!! Form::label('system_module_code', 'Code', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_module_code') ? 'has-error' : ''}}">
        {!! Form::text('system_module_code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_module_code', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_module_name', 'Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_module_name') ? 'has-error' : ''}}">
        {!! Form::text('system_module_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_module_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('system_module_controller', 'Controller', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_module_controller') ? 'has-error' : ''}}">
        {!! Form::text('system_module_controller', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_module_controller', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_module_controller', 'Sort', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_module_sort') ? 'has-error' : ''}}">
        {!! Form::number('system_module_sort', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_module_sort', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('action_name', 'Visible', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_module_visible') ? 'has-error' : ''}}">
        {{ Form::select('system_module_visible', ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control', 'data-plugin-selectTwo','data-plugin-options' => '{"placeholder": "Select a State", "allowClear": true,"tags":true }']) }}
        {!! $errors->first('system_module_visible', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_module_name', ' Enable', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_module_enable') ? 'has-error' : ''}}">
        {{ Form::select('system_module_enable', ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control']) }}
        {!! $errors->first('system_module_visible', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">

  {!! Form::label('system_module_folder', 'Folder', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_module_folder') ? 'has-error' : ''}}">
        {!! Form::text('system_module_folder', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_module_folder', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('system_module_show', ' Show', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_module_show') ? 'has-error' : ''}}">
        {{ Form::select('system_module_show', ['0' => 'No', '1' => 'Yes'], null, ['class'=> 'form-control']) }}
        {!! $errors->first('system_module_show', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
     {!! Form::label('name', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('system_module_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>
</div>
