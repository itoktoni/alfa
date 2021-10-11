<x-date :array="['date']" />

<div class="form-group">

    <label class="col-md-1 col-sm-1 control-label">Dari Tanggal</label>
    <div class="col-md-3">
        <div class="input-group">
            <input type="text" name="from" value="{{ request()->get('from') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

    <label class="col-md-1 col-sm-1 control-label">Ke Tanggal</label>
    <div class="col-md-3">
        <div class="input-group">
            <input type="text" name="to" value="{{ request()->get('to') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

    {!! Form::label('name', __('Company'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('company_id') ? 'has-error' : ''}}">
        {{ Form::select('company_id', $company, old('company_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

@isset($preview)

<hr>

@includeIf(Views::form('excel_linen_kotor_harian', $template, $folder))

@endif