@extends(Views::backend())

@section('content')

<div class="row">
    <div class="panel-body">
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Report Hasil Stock Opname') }}
                </h2>
            </header>
            <div class="panel-body line">
                <div class="show">
                    <table class="table table-table table-bordered table-striped table-hover mb-none">
                        <tbody>

                            <tr>
                                <th class="col-lg-2">{{ __('No. Opname') }}</th>
                                <td>{{ $model->{$model->getKeyName()} ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">{{ __('Nama Rs.') }}</th>
                                <td>{{ $model->mask_company_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">{{ __('Tanggal') }}</th>
                                <td>{{ $model->mask_created_at ?? '' }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">Detail Opname </h2>
            </header>
            <div class="panel-body line">
                <div class="show">
                    <table class="table table-no-more table-bordered table-striped mb-none">
                        <thead>
                            <tr>
                                <th style="width: 2%;" class="text-left">No.</th>
                                <th class="text-left col-md-2">Product Name</th>
                                <th class="text-left col-md-1">Stock Awal</th>
                                <th class="text-left col-md-1">Hasil Opname</th>
                                <th class="text-left col-md-1">Pending Obsesiman</th>
                                <th class="text-left col-md-1">Hilang Obsesiman</th>
                                <th class="text-left col-md-1">Hilang Rs.</th>
                            </tr>
                        </thead>
                        <tbody class="markup">

                            @if($register)
                            @foreach ($register as $item)
                            @php
                            $qty_opname = isset($opname[$item->view_product_id]) ? $opname[$item->view_product_id]->count() : 0;
                            $qty_pending = $qty_hilang = 0;
                            if($lock){
                            $qty_pending = $lock->where('linen_outstanding_status','!=', LinenStatus::Hilang)->where('linen_outstanding_product_id', $item->view_product_id)->count() ?? 0;
                            $qty_hilang = $lock->where('linen_outstanding_status', LinenStatus::Hilang)->where('linen_outstanding_product_id', $item->view_product_id)->count() ?? 0;
                            }
                            $qty_hilang_rs = $qty_opname - ($item->view_register - ($qty_pending + $qty_hilang));
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->view_product_name ?? '' }}</td>
                                <td>{{ $item->view_register ?? '' }}</td>
                                <td>{{ $qty_opname ?? '' }}</td>
                                <td>{{ $qty_pending ?? '' }}</td>
                                <td>{{ $qty_hilang ?? '' }}</td>
                                <td>{{ abs($qty_hilang_rs) ?? '' }}</td>
                            </tr>
                            @endforeach
                            @endisset

                        </tbody>
                    </table>
                </div>
            </div>

            <div class="navbar-fixed-bottom" id="menu_action">
                <div class="text-right action-wrapper">
                    <a id="linkMenu" href="{{ route($route_show, ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-warning">Hasil Opname</a>
                    <a id="linkMenu" href="{{ route($module.'_location', ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-info">Stock Ruangan</a>
                    <a id="linkMenu" href="{{ route($module.'_pending', ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-success">Pending Obsesiman</a>
                    <a id="linkMenu" href="{{ route($module.'_hilang', ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-primary">Hilang Obsesiman</a>
                    <a id="linkMenu" href="{{ route($module.'_rs', ['code' => $model->{$model->getKeyName()}]) }}" class="btn btn-danger">Hilang Rs</a>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection