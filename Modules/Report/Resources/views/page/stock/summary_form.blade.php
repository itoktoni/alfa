<x-date :array="['date']" />

<div class="form-group">

    {!! Form::label('name', __('Company'), ['class' => 'col-md-1 col-sm-2 control-label']) !!}
    <div class="col-md-3 col-sm-4 {{ $errors->has('view_company_id') ? 'has-error' : ''}}">
        {{ Form::select('view_company_id', $company, old('view_company_id') ?? request()->get('view_company_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('view_company_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Location'), ['class' => 'col-md-1 col-sm-2 control-label']) !!}
    <div class="col-md-3 col-sm-4 {{ $errors->has('view_location_id') ? 'has-error' : ''}}">
        {{ Form::select('view_location_id', $location, old('view_location_id') ?? request()->get('view_location_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('view_location_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Product'), ['class' => 'col-md-1 col-sm-2 control-label']) !!}
    <div class="col-md-3 col-sm-4 {{ $errors->has('view_product_id') ? 'has-error' : ''}}">
        {{ Form::select('view_product_id', $product, old('view_product_id') ?? request()->get('view_product_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('view_product_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<input type="hidden" name="layout" value="landscape">

@isset($preview)

<hr>
@includeIf(Views::form(request()->get('name'), $template, $folder))

@endif