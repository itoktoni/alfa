@extends(Views::backend())
@component('components.charts', ['array' => 'Chartjs'])
@endcomponent
@section('content')
<div class="row">
    <div class="panel-body">

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