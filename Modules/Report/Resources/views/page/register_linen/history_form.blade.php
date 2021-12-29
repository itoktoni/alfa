<x-date :array="['date']" />

<div class="form-group">

    <label class="col-md-2 col-sm-2 control-label">Dari Tanggal</label>
    <div class="col-md-4">
        <div class="input-group">
            <input type="text" name="from" value="{{ request()->get('from') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

    <label class="col-md-2 col-sm-2 control-label">Ke Tanggal</label>
    <div class="col-md-4">
        <div class="input-group">
            <input type="text" name="to" value="{{ request()->get('to') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Company'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_company_id') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_company_id', $company, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_company_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Location'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_location_id') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_location_id', $location, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_location_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Product'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_product_id') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_product_id', $product, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_product_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Rental'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_rent') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_rent', $rental, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_rent', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Register By'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_created_by') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_created_by', $user, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_created_by', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_status') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_status', $status, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_status', '<p class="help-block">:message</p>') !!}
    </div>

</div>


@isset($preview)

<hr>

<table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr>
            <th class="text-left col-md-2">{{ __('No. Seri RFID') }}</th>
            <th class="text-left col-md-3 col-sm-3">{{ __('Product Name') }}</th>
            <th class="text-left col-md-2">{{ __('Company') }}</th>
            <th class="text-left col-md-1">{{ __('Location') }}</th>
            <th class="text-left col-md-2">{{ __('Log Date') }}</th>
            <th class="text-left col-md-2">{{ __('Log Status') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($preview as $linen)
        <tr>
            <td>{{ $linen->item_linen_rfid }}</td>
            <td>{{ $linen->item_linen_product_name }}</td>
            <td>{{ $linen->item_linen_company_name }}</td>
            <td>{{ $linen->item_linen_location_name }}</td>
            <td>{{ $linen->item_linen_detail_created_at }}</td>
            <td>{{ $linen->item_linen_detail_description }}</td>
        </tr>
        @endforeach
    </tbody>
    <tbody class="markup">
        
    </tbody>
</table>

@endif