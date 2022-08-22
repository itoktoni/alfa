@php

$date_from = Carbon\Carbon::createFromFormat('Y-m-d', request()->get('from'));
$date_to = Carbon\Carbon::createFromFormat('Y-m-d', request()->get('to'));

$periode = Carbon\CarbonPeriod::create(request()->get('from'), request()->get('to'));
$each_product = $preview->unique('linen_grouping_detail_product_id')->pluck('linen_grouping_detail_product_name', 'linen_grouping_detail_product_id');

$detail = [];
if($preview){

$detail = $preview->mapToGroups(function($item){
$format = $item->linen_grouping_detail_reported_date ? $item->linen_grouping_detail_reported_date->format('d-m') : '0';
return [$format => $item];
});
}

$invoice = 0;

@endphp

<div class="export">

    @if(request()->get('action') == 'pdf')
    <div class="logo">
        <img src="{{ Helper::print('logo/logo.png') }}">
    </div>

    <x-print />

    @endif

    <table id="header">
        <tr>
            <td colspan="12" align="center">
                <h2>LAPORAN INVOICE</h2>
            </td>
        </tr>

        @if($title = request()->get('view_company_id'))
        <tr>
            <td colspan="12" align="center">
                <h4>{{ $list_company[$title] ?? '' }}</h4>
            </td>
        </tr>
        @endif

        <tr>
            <td colspan="12" align="center">
                Periode : {{ request()->get('from') }} - {{ request()->get('to') }}
            </td>
        </tr>

    </table>

    <table style="margin-left: -20px;" id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
        <thead>
            <tr>
                <td style="width: 5px;" width="30"><span class="small">No</span></td>
                <td style="width: 50px;" width="200"><span class="small">Nama Linen</span></td>
                @foreach($periode as $date)
                <td>
                    <span class="small">{{ $date->format('j') }}</span>
                </td>
                @endforeach
                <td><span class="small">Qty</span></td>
                <td style="width: 30px;"><span class="small">Berat (Kg)</span></td>
                <td style="width: 30px;"><span class="small">Total (Kg)</span></td>
                <td style="width: 70px;"><span class="small">Harga</span></td>
                <td style="width: 70px;"><span class="small">Total Invoice</span></td>
            </tr>
        </thead>
        <tbody>
            @foreach($each_product as $id => $name)
            @php
            $pro = $product->where('item_product_id', $id)->first();
            $weight = $pro->pivot->company_item_weight ?? 0;
            $qty = $preview->where('linen_grouping_detail_product_id', $id)->count() ?? 0;
            $total_weight = $weight * $qty;
            $price = $pro->pivot->company_item_price ?? 0;
            $total_price = $price * $total_weight;
            $invoice = $invoice + $total_price;
            @endphp
            <tr>
                <td><span class="small">{{ $loop->iteration }}</span> </td>
                <td><span class="small">{{ $name ?? '' }}</span> </td>
                @foreach($periode as $date)
                <td width="50">
                    @php
                    $value = $detail[$date->format('d-m')] ?? false;
                    $total = $value ? $value->where('linen_grouping_detail_product_id', $id)->count() : 0;
                    @endphp
                    <p class="small text-center">{{ $total }}</p>
                </td>
                @endforeach
                <td>
                    <p class="small text-center">{{ $qty }}</p>
                </td>
                <td>
                    <p class="small text-center">{{ $weight }}</p>
                </td>
                <td>
                    <p class="small text-center">{{ $total_weight }}</p>
                </td>
                <td>
                    <p class="small text-center">{{ number_format($price) }}</p>
                </td>
                <td>
                    <p class="small text-center">{{ number_format($total_price) }}</p>
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td colspan="{{ $periode->count() + 6 }}">
                    <p class="small">Grand Total</p>
                </td>
                <td colspan="">
                    <p class="small">{{ number_format($invoice) }}</p>
                </td>
            </tr>
        </tfoot>
    </table>
</div>