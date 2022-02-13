<x-date :array="['date']" />

<div class="form-group">

    <label class="col-md-2 col-sm-2 control-label">Dari Tanggal</label>
    <div class="col-md-4">
        <div class="input-group">
            <input type="text" name="from" value="{{ old('from') ?? request()->get('from') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

    <label class="col-md-2 col-sm-2 control-label">Ke Tanggal</label>
    <div class="col-md-4">
        <div class="input-group">
            <input type="text" name="to" value="{{  old('to') ?? request()->get('to') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Company'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_company_id') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_company_id', $company,  old('item_linen_company_id') ?? request()->get('item_linen_company_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_company_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Location'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_location_id') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_location_id', $location,  old('item_linen_location_id') ?? request()->get('item_linen_location_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_location_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Product'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_product_id') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_product_id', $product,  old('item_linen_product_id') ?? request()->get('item_linen_product_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_product_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('No. Seri Rfid'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_rfid') ? 'has-error' : ''}}">
        {{ Form::text('item_linen_rfid',  old('item_linen_rfid') ?? request()->get('item_linen_rfid') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_rfid', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<input type="hidden" name="layout" value="potrait">

@isset($preview)

<hr>
@includeIf(Views::form(request()->get('name'), $template, $folder))

@endif