@extends(Helper::setExtendBackend())
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