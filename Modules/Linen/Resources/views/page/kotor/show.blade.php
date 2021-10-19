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
                                <th class="col-lg-2">{{ __('No. Linen Kotor') }}</th>
                                <td>{{ $model->{$model->getKeyName()} ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">{{ __('Company') }}</th>
                                <td>{{ $model->mask_company_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">{{ __('Location') }}</th>
                                <td>{{ $model->mask_location_name ?? '' }}</td>
                            </tr>
                            <tr>
                                <th class="col-lg-2">{{ __('Total') }}</th>
                                <td>{{ $model->mask_total }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

            @include($template_action)

        </div>

        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">Detail Kotor : {{ $model->{$model->getKeyName()} }} </h2>
            </header>
            <div class="panel-body line">
                <div class="show">
                    <table class="table table-no-more table-bordered table-striped mb-none">
                        <thead>
                            <tr>
                                <th class="text-left col-md-2">Product ID</th>
                                <th class="text-left col-md-4">Product Name</th>
                                <th class="text-left col-md-3">Default R.S</th>
                                <th class="text-left col-md-3">Default Location</th>
                                <th class="text-left col-md-1">Qty</th>
                            </tr>
                        </thead>
                        <tbody class="markup">
                            @if($detail)
                            @foreach ($detail as $key => $group)
                            @php
                            $item = $group->first();
                            @endphp
                            <tr>
                                <td data-title="Product">

                                    <input type="text" readonly class="form-control"
                                        value="{{ $item['temp_product'] ?? $item->mask_product_id }}"
                                        name="detail[{{ $loop->index }}][temp_product]">

                                </td>
                                <td data-title="Description">
                                    <input type="text" readonly class="form-control"
                                        value="{{ $item->mask_product_name }}"
                                        name="detail[{{ $loop->index }}][temp_product]">
                                </td>
                                <td data-title="Qty" class="text-right col-lg-1">
                                    <input type="text" tabindex="{{ $loop->iteration }}1"
                                        name="detail[{{ $loop->index }}][temp_qty]" class="form-control" readonly
                                        value="{{ $item->mask_company_ori_name }}">
                                </td>
                                <td data-title="Send" class="text-right col-lg-1">
                                    <input type="text" tabindex="{{ $loop->iteration }}2"
                                        name="detail[{{ $loop->index }}][temp_out]" class="form-control" readonly
                                        value="{{ $item->mask_location_ori_name }}">
                                </td>
                                <td data-title="Send" class="text-right col-lg-1">
                                    <input type="text" tabindex="{{ $loop->iteration }}2"
                                        name="detail[{{ $loop->index }}][temp_out]" class="form-control" readonly
                                        value="{{ $group->count() }}">
                                </td>
                            </tr>

                            @endforeach
                            @endisset
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection