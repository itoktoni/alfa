@extends(Views::backend())

@section('content')

<div class="row">
    <div class="panel-body">

        <div class="panel panel-default">
            <header class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        <h2 class="panel-title">Report Kotor Obsesiman</h2>
                    </div>
                    <div class="col-md-3 text-right">
                        <a class="btn btn-success btn-xs" href="{{ route(Route::currentRouteName(), ['code' => $model->{$model->getKeyName()}]) }}?action=excel">
                            Export Excel
                        </a>
                    </div>
                </div>
            </header>
            <div class="panel-body line">
                <div class="show">
                    @include($folder.'::page.'.$template.'.excel_report_kotor')
                </div>
            </div>

            <div class="navbar-fixed-bottom" id="menu_action">
                <div class="text-right action-wrapper">
                    <a id="linkMenu" href="{{ route($route_show, ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-warning">Hasil Opname</a>
                    <a id="linkMenu" href="{{ route($module.'_location', ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-info">Stock Ruangan</a>
                    <a id="linkMenu" href="{{ route($module.'_kotor', ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-default" style="background-color: darkslategray;color:white">Kotor Obsesiman</a>
                    <a id="linkMenu" href="{{ route($module.'_pending', ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-success">Pending Obsesiman</a>
                    <a id="linkMenu" href="{{ route($module.'_hilang', ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-primary">Hilang Obsesiman</a>
                    <a id="linkMenu" href="{{ route($module.'_rs', ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-danger">Hilang Rs</a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection