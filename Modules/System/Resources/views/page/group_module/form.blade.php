<div class="form-group">
    {!! Form::label('system_group_module_code', 'Code', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_module_code') ? 'has-error' : ''}}">
        {!! Form::text('system_group_module_code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_group_module_code', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_group_module_name', 'Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_module_name') ? 'has-error' : ''}}">
        {!! Form::text('system_group_module_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_group_module_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('system_group_module_folder', 'Folder', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_module_folder') ? 'has-error' : ''}}">
        {!! Form::text('system_group_module_folder', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_group_module_folder', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_group_module_controller', 'Sort', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_module_sort') ? 'has-error' : ''}}">
        {!! Form::number('system_group_module_sort', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_group_module_sort', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('action_name', 'Visible', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_module_visible') ? 'has-error' : ''}}">
        {{ Form::select('system_group_module_visible', ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control']) }}
        {!! $errors->first('system_group_module_visible', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_group_module_name', ' Enable', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_group_module_enable') ? 'has-error' : ''}}">
        {{ Form::select('system_group_module_enable', ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control']) }}
        {!! $errors->first('system_group_module_visible', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

   <input type="hidden" name="group_module_description">
</div>


