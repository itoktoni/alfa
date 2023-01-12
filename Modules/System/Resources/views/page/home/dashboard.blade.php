@extends(Views::backend())
@component('components.charts', ['array' => 'Chartjs'])
@endcomponent
<x-date :array="['date']" />
@section('content')
<div class="row">
    <div class="panel-body">

        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>
                <h2 class="panel-title text-center">Filter Linen</h2>
            </header>
            <div class="panel-body border">

                <div class="row">
                    <div class="form-group">

                        {!! Form::open(['route' => 'home', 'method' => 'GET', 'files' => true]) !!}

                        <div class="col-md-3 {{ $errors->has('start_date') ? 'has-error' : ''}}">
                            {!! Form::label('tanggal_awal', 'Tgl Awal', ['class' => 'col-md-12 control-label']) !!}
                            {!! Form::text('start_date', request()->get('start_date') ?? date('Y-m-d'), ['class' => 'form-control date', isset($model) ? 'readonly' : '' ])
                            !!}
                            {!! $errors->first('start_date', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="col-md-3 {{ $errors->has('end_date') ? 'has-error' : ''}}">
                            {!! Form::label('end_date', 'Tgl Akhir', ['class' => 'col-md-12 control-label']) !!}
                            {!! Form::text('end_date', request()->get('end_date') ?? date('Y-m-d'), ['class' => 'form-control date']) !!}
                            {!! $errors->first('end_date', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="col-md-4 {{ $errors->has('rs') ? 'has-error' : ''}}">
                            {!! Form::label('action_name', 'RS', ['class' => 'col-md-12 control-label']) !!}
                            {{ Form::select('rs', $rs, request()->get('rs') ?? null, ['class'=> 'form-control']) }}
                            {!! $errors->first('rs', '<p class="help-block">:message</p>') !!}
                        </div>

                        <div class="col-md-2 {{ $errors->has('rs') ? 'has-error' : ''}}">
                            <button style="margin-top:27px" class="btn btn-primary" type="Submit">{{ __('Tampilkan') }}</button>
                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>

            </div>
        </section>

        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>
                <h2 class="panel-title text-center">Pemakaian Linen</h2>
            </header>
            <div class="panel-body border">

                <div class="row">
                    {!! $pemakaian_chart->displayLegend(false)->barWidth(0.7)->container() !!}
                </div>

            </div>
        </section>

        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>
                <h2 class="panel-title text-center">Pemakaian Linen vs Total Stock Linen</h2>
            </header>
            <div class="panel-body border">

                <div class="row">
                    <div class="col-md-12">
                        {!! $stock_chart->container() !!}
                    </div>
                </div>

            </div>
        </section>

        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>
                <h2 class="panel-title text-center">Kotor Vs Bersih</h2>
            </header>
            <div class="panel-body border">

                <div class="row">

                    <div class="col-md-12">
                        {!! $kotor_bersih_chart->container() !!}
                    </div>
                </div>

            </div>
        </section>

        <section class="panel">
            <header class="panel-heading">
                <div class="panel-actions">
                    <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                    <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                </div>
                <h2 class="panel-title text-center">Pemakaian Max VS Min</h2>
            </header>
            <div class="panel-body border">

                <div class="row">

                    <div class="col-md-12">
                        {!! $min_max_chart->container() !!}
                    </div>
                </div>

            </div>
        </section>

    </div>
</div>
@endsection

@push('javascript')
{!! $pemakaian_chart->script() !!}
{!! $stock_chart->script() !!}
{!! $kotor_bersih_chart->script() !!}
{!! $min_max_chart->script() !!}

<style>
    .border{
        border: 0.5px solid lightgray;
    }
</style>
@endpush