<div class="form-group">
    {!! Form::label('location_name', __('Name'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('location_name') ? 'has-error' : ''}}">
        {!! Form::text('location_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('location_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('location_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('location_description', '<p class="help-block">:message</p>') !!}
    </div>

</div>