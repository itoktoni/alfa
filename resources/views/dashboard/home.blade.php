@extends('backend.'.config('website.backend').'.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('public/assets/vendor/morris/morris.css') }}">
@endsection

@section('js')
<script src="{{ asset('public/assets/vendor/snap-svg/snap.svg.js') }}"></script>
<script src="{{ asset('public/assets/vendor/morris/morris.js') }}"></script>
<script src="{{ asset('public/assets/vendor/liquid-meter/liquid.meter.js') }}"></script>
<script src="{{ asset('public/assets/vendor/flot/jquery.flot.js') }}"></script>
<script src="{{ asset('public/assets/vendor/flot-tooltip/jquery.flot.tooltip.js') }}"></script>
<!--<script src="{{ asset('public/assets/vendor/flot/jquery.flot.pie.js') }}"></script>-->
<script src="{{ asset('public/assets/vendor/flot/jquery.flot.categories.js') }}"></script>
<script src="{{ asset('public/assets/vendor/flot/jquery.flot.resize.js') }}"></script>

@endsection

@section('javascript')
<script>
$('#meter').liquidMeter({
    shape: 'circle',
    color: '#0088CC',
    background: '#F9F9F9',
    fontSize: '24px',
    fontWeight: '600',
    stroke: '#F2F2F2',
    textColor: '#333',
    liquidOpacity: 0.9,
    liquidPalette: ['#333'],
    speed: 3000,
    animate: !$.browser.mobile
});

$('#meterSales').liquidMeter({
    shape: 'circle',
    color: '#0088CC',
    background: '#F9F9F9',
    fontSize: '24px',
    fontWeight: '600',
    stroke: '#F2F2F2',
    textColor: '#333',
    liquidOpacity: 0.9,
    liquidPalette: ['#333'],
    speed: 3000,
    animate: !$.browser.mobile
});

/*
 Liquid Meter Dark
 */
$('#meterDark').liquidMeter({
    shape: 'circle',
    color: '#0088CC',
    background: '#272A31',
    stroke: '#33363F',
    fontSize: '24px',
    fontWeight: '600',
    textColor: '#FFFFFF',
    liquidOpacity: 0.9,
    liquidPalette: ['#0088CC'],
    speed: 3000,
    animate: !$.browser.mobile
});

(function() {
    var plot = $.plot('#flotBars', [flotBarsData], {
        colors: ['#8CC9E8'],
        series: {
            bars: {
                show: true,
                barWidth: 0.8,
                align: 'center'
            }
        },
        xaxis: {
            mode: 'categories',
            tickLength: 0
        },
        grid: {
            hoverable: true,
            clickable: true,
            borderColor: 'rgba(0,0,0,0.1)',
            borderWidth: 1,
            labelMargin: 15,
            backgroundColor: 'transparent'
        },
        tooltip: true,
        tooltipOpts: {
            content: '%y',
            shifts: {
                x: -10,
                y: 20
            },
            defaultTheme: false
        }
    });
})();

</script>
@endsection

@section('content')
<div class="row">

    <section class="panel">
        <header class="panel-heading">
            <div class="pull-right">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>
            <h2 class="panel-title text-uppercase">Dashboard</h2>
        </header>

        <div class="panel-body">

            <div class="row">
                <div class="col-md-6 col-lg-12 col-xl-6">
                    <section class="panel">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-9 text-left">
                                    <div class="chart chart-md" id="flotBars"></div>
                                    <script type="text/javascript">

                                        var flotBarsData = [
                                            ["Jan", 28],
                                            ["Feb", 42],
                                            ["Mar", 25],
                                            ["Apr", 23],
                                            ["May", 37],
                                            ["Jun", 33],
                                            ["Jul", 18],
                                            ["Aug", 14],
                                            ["Sep", 18],
                                            ["Oct", 15],
                                            ["Nov", 4],
                                            ["Dec", 7]
                                        ];

                                    </script>
                                </div>

                                <div class="col-lg-3 text-center">
                                    <div class="panel-body">
                                    <h2 class="panel-title mt-md">Sales Goal</h2>
                                        <div class="row">
                                            <meter min="0" max="100" value="35" id="meter"></meter>
                                        </div>
                                        <hr>
                                        <div class="progress progress-striped light active m-md">
                                            <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
                                                Target Team {{ Auth::user()->target }} Kg and 60%
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </section>

    <section class="panel">


        <div class="panel-body">
            <div class="col-md-6 col-lg-12 col-xl-6">
                <div class="row">
                    <div class="col-md-12 col-lg-3 col-xl-3">
                        <section class="panel panel-featured-left panel-featured-primary">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-primary">
                                            <i class="fa fa-shopping-cart"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Total SO</h4>
                                            <div class="info">
                                                <strong class="amount">38</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase">(statement)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3">
                        <section class="panel panel-featured-left panel-featured-success">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-success">
                                            <i class="fa fa-usd"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Total Value</h4>
                                            <div class="info">
                                                <strong class="amount">300</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase">(withdraw)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3">
                        <section class="panel panel-featured-left panel-featured-quartenary">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-quartenary">
                                            <i class="fa fa-user"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Customer</h4>
                                            <div class="info">
                                                <strong class="amount">3765</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase">(report)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    <div class="col-md-12 col-lg-3 col-xl-3">
                        <section class="panel panel-featured-left panel-featured-danger">
                            <div class="panel-body">
                                <div class="widget-summary">
                                    <div class="widget-summary-col widget-summary-col-icon">
                                        <div class="summary-icon bg-danger">
                                            <i class="fa fa-undo"></i>
                                        </div>
                                    </div>
                                    <div class="widget-summary-col">
                                        <div class="summary">
                                            <h4 class="title">Items /Pcs</h4>
                                            <div class="info">
                                                <strong class="amount">165</strong>
                                            </div>
                                        </div>
                                        <div class="summary-footer">
                                            <a class="text-muted text-uppercase">(withdraw)</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection

