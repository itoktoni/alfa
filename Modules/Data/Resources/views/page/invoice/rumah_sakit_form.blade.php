<x-date :array="['date']" />

<div class="form-group">

    <!-- <label class="col-md-1 col-sm-1 control-label">Dari Tanggal</label>
    <div class="col-md-3">
        <div class="input-group">
            <input type="text" name="from" value="{{ old('from') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div>

    <label class="col-md-1 col-sm-1 control-label">Ke Tanggal</label>
    <div class="col-md-3">
        <div class="input-group">
            <input type="text" name="to" value="{{ old('to') ?? date('Y-m-d') }}" class="date">
            <span class="input-group-addon">
                <i class="fa fa-calendar"></i>
            </span>
        </div>
    </div> -->

    {!! Form::label('name', __('No. Delivery'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('key') ? 'has-error' : ''}}">
        {{ Form::select('key', $delivery, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('key', '<p class="help-block">:message</p>') !!}
    </div>

</div>

@isset($preview)

<hr>

@includeIf(Views::form('excel_report_invoice', $template, $folder))

@endif