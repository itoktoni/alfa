
<div class="form-group">

    {!! Form::label('name', __('No. Retur'), ['class' => 'col-md-1 control-label']) !!}
    <div class="col-md-3 {{ $errors->has('linen_retur_key') ? 'has-error' : ''}}">
        {!! Form::text('linen_retur_key', null, ['class' => 'form-control', 'readonly']) !!}
        {!! $errors->first('linen_retur_key', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Rumah Sakit'), ['class' => 'col-md-1 control-label']) !!}
    <div class="col-md-3 {{ $errors->has('linen_retur_company_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_retur_company_id', $company, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_retur_company_id', '<p class="help-block">:message</p>') !!}
    </div> 

    {!! Form::label('name', __('Total Barcode'), ['class' => 'col-md-1 control-label']) !!}
    <div class="col-md-3 {{ $errors->has('linen_retur_total') ? 'has-error' : ''}}">
        {!! Form::text('linen_retur_total', null, ['class' => 'form-control', 'readonly']) !!}
        {!! $errors->first('linen_retur_total', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<hr>

@include($folder.'::page.'.$template.'.table')