<div class="form-group">
    {!! Form::label('system_action_code', 'Code', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_action_code') ? 'has-error' : ''}}">
        {!! Form::text('system_action_code', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_action_code', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_action_name', 'Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_action_name') ? 'has-error' : ''}}">
        {!! Form::text('system_action_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_action_name', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('system_action_link', 'Link', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_action_link') ? 'has-error' : ''}}">
        {!! Form::text('system_action_link', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_action_link', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_action_function', 'Function', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_action_function') ? 'has-error' : ''}}">
        {!! Form::text('system_action_function', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_action_function_function', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('system_action_controller', 'Controller', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_action_controller') ? 'has-error' : ''}}">
        {!! Form::text('system_action_controller', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_action_controller', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_action_controller', 'Sort', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_action_sort') ? 'has-error' : ''}}">
        {!! Form::number('system_action_sort', null, ['class' => 'form-control']) !!}
        {!! $errors->first('system_action_sort', '<p class="help-block">:message</p>') !!}
    </div>
</div>


<div class="form-group">
    {!! Form::label('action_name', 'Visible', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_action_visible') ? 'has-error' : ''}}">
        {{ Form::select('system_action_visible', ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control']) }}
        {!! $errors->first('system_action_visible', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_action_name', ' Enable', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_action_enable') ? 'has-error' : ''}}">
        {{ Form::select('system_action_enable', ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control']) }}
        {!! $errors->first('system_action_visible', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('system_action_api', ' Activate Api', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_action_api') ? 'has-error' : ''}}">
        {{ Form::select('system_action_api', ['1' => 'Yes', '0' => 'No'], null, ['class'=> 'form-control']) }}
        {!! $errors->first('system_action_api', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('system_action_method', 'Method', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('system_action_method') ? 'has-error' : ''}}">
        {{ Form::select('system_action_method', ['POST' => 'POST', 'GET' => 'GET', 'PUT' => 'PUT', 'PATCH' => 'PATCH', 'DELETE' => 'DELETE'], null, ['class'=> 'form-control']) }}
        {!! $errors->first('system_action_method', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">
    {!! Form::label('name', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('system_action_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>
</div>