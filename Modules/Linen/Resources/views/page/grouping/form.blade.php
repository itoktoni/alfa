
<div class="form-group">

    {!! Form::label('name', __('No. Pengiriman'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('linen_grouping_delivery') ? 'has-error' : ''}}">
        {!! Form::text('linen_grouping_delivery', null, ['class' => 'form-control', 'readonly']) !!}
        {!! $errors->first('linen_grouping_delivery', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('No. Barcode'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('linen_grouping_barcode') ? 'has-error' : ''}}">
        {!! Form::text('linen_grouping_barcode', null, ['class' => 'form-control', 'readonly']) !!}
        {!! $errors->first('linen_grouping_barcode', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Rumah Sakit'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('linen_grouping_company_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_grouping_company_id', $company, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_grouping_company_id', '<p class="help-block">:message</p>') !!}
    </div> 
    
     {!! Form::label('name', __('Location'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('linen_grouping_location_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_grouping_location_id', $location, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_grouping_location_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<hr>

@include($folder.'::page.'.$template.'.table')