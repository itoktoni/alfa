
<div class="form-group">

    {!! Form::label('name', __('No. Delivery'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('linen_delivery_key') ? 'has-error' : ''}}">
        {!! Form::text('linen_delivery_key', null, ['class' => 'form-control', 'readonly']) !!}
        {!! $errors->first('linen_delivery_key', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Total Barcode'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('linen_delivery_total') ? 'has-error' : ''}}">
        {!! Form::text('linen_delivery_total', null, ['class' => 'form-control', 'readonly']) !!}
        {!! $errors->first('linen_delivery_total', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Rumah Sakit'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('linen_delivery_company_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_delivery_company_id', $company, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_delivery_company_id', '<p class="help-block">:message</p>') !!}
    </div> 
    
     {!! Form::label('name', __('Driver'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('linen_delivery_driver_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_delivery_driver_id', $user, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_delivery_driver_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<hr>

@include($folder.'::page.'.$template.'.table')