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
                <h2 class="panel-title">Profile Management</h2>
            </header>
            <div class="panel-body line">

                {{-- {!! $chart->container() !!} --}}

                {{-- <script src="{{ $chart->cdn() }}"></script> --}}

                <!-- Or use the cdn directly -->

                <!-- <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script> -->

                <!-- Or use the local library as asset the package already provides a publication with this file *see below -->

                {{-- <!-- <script src="{{ asset('vendor/larapex-charts/apexchart.js') }}"></script> --> --}}

                {{-- {{ $chart->script() }} --}}
                @component('components.chart')
                @slot('container')
                {!! $chart->container() !!}
                @endslot
                @slot('script')
                {!! $chart->script() !!}
                @endslot
                @endcomponent

            </div>
        </section>
    </div>
</div>
@endsection