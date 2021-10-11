
<div class="form-group">

    {!! Form::label('name', __('No. Linen Kotor'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('linen_kotor_key') ? 'has-error' : ''}}">
        {!! Form::text('linen_kotor_key', null, ['class' => 'form-control', 'readonly']) !!}
        {!! $errors->first('linen_kotor_key', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Total Barcode'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('linen_kotor_total') ? 'has-error' : ''}}">
        {!! Form::text('linen_kotor_total', null, ['class' => 'form-control', 'readonly']) !!}
        {!! $errors->first('linen_kotor_total', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Rumah Sakit'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('linen_kotor_company_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_kotor_company_id', $company, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_kotor_company_id', '<p class="help-block">:message</p>') !!}
    </div> 

</div>

<hr>

@include($folder.'::page.'.$template.'.table')