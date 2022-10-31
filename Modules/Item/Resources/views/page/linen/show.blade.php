@extends(Views::backend())

@section('content')

<div class="row">
    <div class="panel-body">
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Show') }} {{ __($form_name) }} : {{ $model->{$model->getKeyName()} }}
                </h2>
            </header>
            <div class="panel-body line">
                <div class="show">
                    <table class="table table-table table-bordered table-striped table-hover mb-none">
                        <tbody>
                            <tr>
                                <th class="col-lg-2">Nama Product</th>
                                <td>{{ $model->item_linen_product_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">Rumah Sakit</th>
                                <td>{{ $model->has_company->mask_company_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">Location</th>
                                <td>{{ $model->has_location->mask_location_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">Berapa X Cuci</th>
                                <td>{{ $detail->where('item_linen_detail_status', LinenStatus::Bersih)->count() }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            @include($template_action)

        </div>

        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">History Linen : {{ $model->{$model->getKeyName()} }} </h2>
            </header>
            <div class="panel-body line">
                <div class="show">
                    <table class="table table-no-more table-bordered table-striped mb-none">
                        <thead>
                            <tr>
                                <th class="text-left col-md-2">Createt At</th>
                                <th class="text-left ">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($detail)
                            @foreach($detail as $item)
                            <tr>
                                <td data-title="Created At">
                                    {{ $item->mask_created_at }}
                                </td>
                                <td data-title="Status">
                                    {{ $item->mask_description }}
                                </td>
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection