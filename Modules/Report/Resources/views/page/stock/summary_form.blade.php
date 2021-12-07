<div class="form-group">

    {!! Form::label('name', __('Company'), ['class' => 'col-md-1 col-sm-2 control-label']) !!}
    <div class="col-md-3 col-sm-4 {{ $errors->has('view_company_id') ? 'has-error' : ''}}">
        {{ Form::select('view_company_id', $company, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('view_company_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Location'), ['class' => 'col-md-1 col-sm-2 control-label']) !!}
    <div class="col-md-3 col-sm-4 {{ $errors->has('view_location_id') ? 'has-error' : ''}}">
        {{ Form::select('view_location_id', $product, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('view_location_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Product'), ['class' => 'col-md-1 col-sm-2 control-label']) !!}
    <div class="col-md-3 col-sm-4 {{ $errors->has('item_linen_product_id') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_product_id', $product, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_product_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>


@isset($preview)

<hr>

@includeIf(Views::form('excel_report_summary', $template, $folder))

@endif