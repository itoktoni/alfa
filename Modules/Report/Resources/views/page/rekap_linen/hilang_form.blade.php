<div class="form-group">

    {!! Form::label('name', __('Rumah Sakit'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('linen_outstanding_ori_company_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_outstanding_ori_company_id', $list_company, old('linen_outstanding_ori_company_id') ?? request()->get('linen_outstanding_ori_company_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_ori_company_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Scan Rumah Sakit'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('linen_outstanding_scan_company_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_outstanding_scan_company_id', $list_company, old('linen_outstanding_scan_company_id') ?? request()->get('linen_outstanding_scan_company_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_scan_company_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Location'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('linen_outstanding_ori_location_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_outstanding_ori_location_id', $list_location, old('linen_outstanding_ori_location_id') ?? request()->get('linen_outstanding_ori_location_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_ori_location_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Product'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('linen_outstanding_product_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_outstanding_product_id', $list_product, old('linen_outstanding_product_id') ?? request()->get('linen_outstanding_product_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_product_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('linen_outstanding_status') ? 'has-error' : ''}}">
        {{ Form::select('linen_outstanding_status', $list_status, old('linen_outstanding_status') ?? request()->get('linen_outstanding_status') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_status', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Deskripsi'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('linen_outstanding_description') ? 'has-error' : ''}}">
        {{ Form::select('linen_outstanding_description', $list_description, old('linen_outstanding_description') ?? request()->get('linen_outstanding_description') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_description', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<input type="hidden" name="layout" value="potrait">

@isset($preview)

<hr>
@includeIf(Views::form(request()->get('name'), $template, $folder))

@endif