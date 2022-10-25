<x-date :array="['date']" />

<div class="form-group">

    <label class="col-md-1 col-sm-1 control-label">Dari Tanggal</label>
    <div class="col-md-3">
        <div class="input-group">
            <input type="text" name="from" value="{{ old('from') ?? request()->get('from') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

    <label class="col-md-1 col-sm-1 control-label">Ke Tanggal</label>
    <div class="col-md-3">
        <div class="input-group">
            <input type="text" name="to" value="{{ old('to') ?? request()->get('to') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>


    {!! Form::label('name', __('Rumah Sakit'), ['class' => 'col-md-1 col-sm-1 control-label']) !!}
    <div class="col-md-3 col-sm-3 {{ $errors->has('view_company_id') ? 'has-error' : ''}}">
        {{ Form::select('view_company_id', $list_company, request()->get('view_company_id') ?? null, ['class'=> 'form-control ']) }}
        {!! $errors->first('view_company_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<input type="hidden" name="layout" value="landscape">

@isset($preview)

<hr>
@includeIf(Views::form(request()->get('name'), $template, $folder))

@endif