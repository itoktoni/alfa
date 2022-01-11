@extends(Views::backend())

@section('content')

<div class="row">
    <div class="panel-body">
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Report Opname Per ruangan') }}
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
                <h2 class="panel-title">Detail Ruangan </h2>
            </header>
            <div class="panel-body line">
                <div class="show">
                    <table class="table table-no-more table-bordered table-striped mb-none">
                        <thead>
                            <tr>
                                <th style="width: 2%;" class="text-left">No.</th>
                                <th class="text-left col-md-2">No. Rfid</th>
                                <th class="text-left col-md-2">Product Name</th>
                                <th class="text-left col-md-1">Ruangan</th>
                            </tr>
                        </thead>
                        <tbody class="markup">

                            @if($detail)
                            @foreach ($detail as $loc => $location)

                            <tr>
                                <td class="text-right" colspan="4">{{ $loc }}</td>
                            </tr>

                            @foreach($location->sortBy('linen_opname_detail_ori_location_name') as $item)

                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->linen_opname_detail_rfid ?? '' }}</td>
                                <td>{{ $item->linen_opname_detail_product_name ?? '' }}</td>
                                <td>{{ $item->linen_opname_detail_ori_location_name ?? '' }}</td>
                            </tr>

                            @endforeach
                            
                            @endforeach
                            @endif

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