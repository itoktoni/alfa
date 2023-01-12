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
            <input type="text" name="to" value="{{ old('to') ?? request()->get('to') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Rumah Sakit'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('linen_outstanding_ori_company_id') ? 'has-error' : ''}}">
        {{ Form::select('company_id', $list_company, old('company_id') ?? request()->get('company_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_ori_company_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Ruangan'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('linen_outstanding_ori_location_id') ? 'has-error' : ''}}">
        {{ Form::select('location_id', $list_location, old('location_id') ?? request()->get('location_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_ori_location_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Nama Linen'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('linen_outstanding_product_id') ? 'has-error' : ''}}">
        {{ Form::select('product_id', $list_product, old('product_id') ?? request()->get('product_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_outstanding_product_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<input type="hidden" name="layout" value="potrait">

@isset($preview)

<hr>
@includeIf(Views::form(request()->get('name'), $template, $folder))

@endif