<x-date :array="['date']" />

<div class="form-group">

    {!! Form::label('name', __('Original Company'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('linen_outstanding_ori_company_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_outstanding_ori_company_id', $company, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_ori_company_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Scan Company'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('linen_outstanding_scan_company_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_outstanding_scan_company_id', $company, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_scan_company_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Location'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('linen_outstanding_ori_location_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_outstanding_ori_location_id', $location, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_ori_location_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Product'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('linen_outstanding_product_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_outstanding_product_id', $product, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_product_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('report_linen_status') ? 'has-error' : ''}}">
        {{ Form::select('report_linen_status', $status, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('report_linen_status', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('linen_outstanding_description') ? 'has-error' : ''}}">
        {{ Form::select('linen_outstanding_description', $description, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_description', '<p class="help-block">:message</p>') !!}
    </div>

</div>

@isset($preview)

<hr>

@includeIf(Views::form('excel_linen_pending_harian', $template, $folder))

@endif