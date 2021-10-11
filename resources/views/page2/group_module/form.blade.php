<div class="form-group">
    {!! Form::label($template.'_code', 'Code', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($template.'_code') ? 'has-error' : ''}}">
        {!! Form::text($template.'_code', null, ['class' => 'form-control']) !!}
        {!! $errors->first($template.'_code', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label($template.'_name', 'Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($template.'_name') ? 'has-error' : ''}}">
        {!! Form::text($template.'_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first($template.'_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label($template.'_folder', 'Folder', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($template.'_folder') ? 'has-error' : ''}}">
        {!! Form::text($template.'_folder', null, ['class' => 'form-control']) !!}
        {!! $errors->first($template.'_folder', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label($template.'_controller', 'Sort', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($template.'_sort') ? 'has-error' : ''}}">
        {!! Form::number($template.'_sort', null, ['class' => 'form-control']) !!}
        {!! $errors->first($template.'_sort', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('action_name', 'Visible', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($template.'_visible') ? 'has-error' : ''}}">
        {{ Form::select($template.'_visible', ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control']) }}
        {!! $errors->first($template.'_visible', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label($template.'_name', ' Enable', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has($template.'_enable') ? 'has-error' : ''}}">
        {{ Form::select($template.'_enable', ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control']) }}
        {!! $errors->first($template.'_visible', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

   <input type="hidden" name="group_module_description">
</div>


