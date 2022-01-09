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
                                <th class="col-lg-2">{{ __('Total') }}</th>
                                <td>{{ $model->mask_total }}</td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">Detail Opname : {{ $model->{$model->getKeyName()} }} </h2>
            </header>
            <div class="panel-body line">
                <div class="show">
                    <table class="table table-no-more table-bordered table-striped mb-none">
                        <thead>
                            <tr>
                                <th class="text-left col-md-2">Product Name</th>
                                <th class="text-left col-md-2">Rumah Sakit</th>
                                <th class="text-left col-md-2">Location</th>
                                <th class="text-left col-md-1">Register</th>
                                <th class="text-left col-md-1">Qty</th>
                                <th class="text-left col-md-1">Cuci</th>
                                <th class="text-left col-md-1">Opname</th>
                                <th class="text-left col-md-1">Kotor</th>
                                <th class="text-left col-md-1">Retur</th>
                                <th class="text-left col-md-1">Rewash</th>
                            </tr>
                        </thead>
                        <tbody class="markup">
                            
                            @if($data)
                            @foreach ($data as $default)
                            @php
                            $opname = $detail->where('linen_opname_detail_product_id', $default->mask_product_id)
                            ->where('linen_opname_detail_company_id', $default->mask_company_id)
                            ->where('linen_opname_detail_location_id', $default->mask_location_id)->count();
                            @endphp
                            <tr>
                                <td data-title="Product Name">
                                    <input type="text" readonly class="form-control"
                                        value="{{ $default->mask_product_name }}"
                                        name="detail[{{ $loop->index }}][temp_product]">
                                </td>
                                <td data-title="Qty" class="text-right col-lg-1">
                                    <input type="text" tabindex="{{ $loop->iteration }}1"
                                        name="detail[{{ $loop->index }}][temp_qty]" class="form-control" readonly
                                        value="{{ $default->mask_company_name }}">
                                </td>
                                <td data-title="Send" class="text-right col-lg-1">
                                    <input type="text" tabindex="{{ $loop->iteration }}2"
                                        name="detail[{{ $loop->index }}][temp_out]" class="form-control" readonly
                                        value="{{ $default->mask_location_name }}">
                                </td>
                                <td data-title="Send" class="text-right col-lg-1">
                                    <input type="text" tabindex="{{ $loop->iteration }}2"
                                        name="detail[{{ $loop->index }}][temp_out]" class="form-control" readonly
                                        value="{{ $default->mask_register }}">
                                </td>
                                <td data-title="Send" class="text-right col-lg-1">
                                    <input type="text" tabindex="{{ $loop->iteration }}2"
                                        name="detail[{{ $loop->index }}][temp_out]" class="form-control" readonly
                                        value="{{ $default->mask_qty }}">
                                </td>
                                <td data-title="Send" class="text-right col-lg-1">
                                    <input type="text" tabindex="{{ $loop->iteration }}2"
                                        name="detail[{{ $loop->index }}][temp_out]" class="form-control" readonly
                                        value="{{ $default->mask_cuci }}">
                                </td>
                                <td data-title="Send" class="text-right col-lg-1">
                                    <input type="text" tabindex="{{ $loop->iteration }}2"
                                        name="detail[{{ $loop->index }}][temp_out]" class="form-control" readonly
                                        value="{{ $default->mask_opname ?? $opname }}">
                                </td>
                                <td data-title="Send" class="text-right col-lg-1">
                                    <input type="text" tabindex="{{ $loop->iteration }}2"
                                        name="detail[{{ $loop->index }}][temp_out]" class="form-control" readonly
                                        value="{{ $default->mask_kotor }}">
                                </td>
                                <td data-title="Send" class="text-right col-lg-1">
                                    <input type="text" tabindex="{{ $loop->iteration }}2"
                                        name="detail[{{ $loop->index }}][temp_out]" class="form-control" readonly
                                        value="{{ $default->mask_retur }}">
                                </td>
                                <td data-title="Send" class="text-right col-lg-1">
                                    <input type="text" tabindex="{{ $loop->iteration }}2"
                                        name="detail[{{ $loop->index }}][temp_out]" class="form-control" readonly
                                        value="{{ $default->mask_rewash }}">
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