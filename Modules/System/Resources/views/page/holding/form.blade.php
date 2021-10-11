<div class="form-group">
    {!! Form::label('holding_name', __('Name'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('holding_name') ? 'has-error' : ''}}">
        {!! Form::text('holding_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('holding_name', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('holding_person', __('Contact Person'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('holding_person') ? 'has-error' : ''}}">
        {!! Form::text('holding_person', null, ['class' => 'form-control']) !!}
        {!! $errors->first('holding_person', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('holding_email', __('Email'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('holding_email') ? 'has-error' : ''}}">
        {!! Form::text('holding_email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('holding_email', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('holding_phone', __('Phone'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('holding_phone') ? 'has-error' : ''}}">
        {!! Form::text('holding_phone', null, ['class' => 'form-control']) !!}
        {!! $errors->first('holding_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', __('Address'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('holding_address', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('holding_address', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('holding_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('holding_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>