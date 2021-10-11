<div class="form-group">
    {!! Form::label('company_name', __('Name'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_name') ? 'has-error' : ''}}">
        {!! Form::text('company_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_name', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('company_person', __('Contact Person'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_person') ? 'has-error' : ''}}">
        {!! Form::text('company_person', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_person', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('company_email', __('Email'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_email') ? 'has-error' : ''}}">
        {!! Form::text('company_email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_email', '<p class="help-block">:message</p>') !!}
    </div>
    {!! Form::label('company_phone', __('Phone'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_phone') ? 'has-error' : ''}}">
        {!! Form::text('company_phone', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('company_holding_id', __('Holding'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_holding_id') ? 'has-error' : ''}}">
        {{ Form::select('company_holding_id', $holding, null, ['class'=> 'form-control']) }}
        {!! $errors->first('company_holding_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Logo'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-3" {{ $errors->has('company_logo') ? 'has-error' : ''}}">
        <input type="hidden" value="{{ $model->company_logo ?? null }}" name="company_logo">
        <input type="file" name="file"
            class="{{ $errors->has('company_logo') ? 'has-error' : ''}} btn btn-default btn-sm btn-block">
        {!! $errors->first('company_logo', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-1">
        <img class="img-responsive img-fluid"
            src="{{ isset($model) ? Helper::files('company/'.$model->company_logo) : '' }}" alt="">
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', __('Address'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('company_address', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('company_address', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4">
        {!! Form::textarea('company_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('company_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>
@if ($action_function == 'edit')
<hr>
<div class="form-group">
    <label class="col-md-2 control-label">{{ __('Location') }}</label>
    <div class="col-md-10 {{ $errors->has('locations') ? 'has-error' : ''}}">
        <select class="form-control input-sm mb-md" multiple name="locations[]">
            @foreach($location as $key => $value)
            <option {{ in_array($key, $connection_location) ? 'selected' : '' }} value="{{ $key }}">
                {{ $value }}</option>
            @endforeach
        </select>
        {!! $errors->first('locations', '<p class="help-block">:message</p>') !!}
    </div>

</div>
@endif