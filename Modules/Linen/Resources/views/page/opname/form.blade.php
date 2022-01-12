<x-date :array="['date']" />

<div class="form-group">

    {!! Form::label('name', __('Tanggal Opname'), ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-3 {{ $errors->has('linen_opname_date') ? 'has-error' : ''}}">

        <div class="input-group">
            {{ Form::text('linen_opname_date', null, ['class'=> 'form-control date']) }}
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

    {!! Form::label('name', __('Rumah Sakit'), ['class' => 'col-md-1 control-label']) !!}
    <div class="col-md-3 {{ $errors->has('linen_opname_company_id') ? 'has-error' : ''}}">
        {{ Form::select('linen_opname_company_id', $company, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_opname_company_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Status'), ['class' => 'col-md-1 control-label']) !!}
    <div class="col-md-2 {{ $errors->has('linen_opname_status') ? 'has-error' : ''}}">
        {{ Form::select('linen_opname_status', $status, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('linen_opname_status', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<hr>

@include($folder.'::page.'.$template.'.table')