@php

$date_from = Carbon\Carbon::createFromFormat('Y-m-d', request()->get('from'));
$date_to = Carbon\Carbon::createFromFormat('Y-m-d', request()->get('to'));

$linen_delivery = $preview;
$linen_kotor = $kotor->where('linen_kotor_detail_description', LinenStatus::LinenKotor) ?? [];
$total_location = count($location)+6;

$group_location = $linen_delivery->where('linen_grouping_detail_description', LinenStatus::LinenKotor)->groupBy('linen_grouping_detail_ori_location_id');

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
                <h2>REKAP SERAH TERIMA LINEN BERSIH HARIAN</h2>
            </td>
        </tr>

        @if($title = request()->get('view_company_id'))
        <tr>
            <td colspan="12" align="center">
                <h3>{{ $list_company[$title] ?? '' }}</h3>
            </td>
        </tr>
        @endif

        <tr>
            <td colspan="12" align="left">
                <h5 style="text-align: left;">Tanggal Linen Bersih : {{ $date_from->format('d/m/Y') ?? '' }} - {{ $date_to->format('d/m/Y') ?? '' }}</h5>
            </td>
        </tr>
        <tr>
            <td colspan="12" align="left">
                <h5 style="text-align: left;">Tanggal Linen Kotor : {{ $date_from->addDays(-1)->format('d/m/Y') ?? '' }} - {{ $date_to->addDays(-1)->format('d/m/Y') ?? '' }}</h5>
            </td>
        </tr>

    </table>

    <table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
        <thead>
            <tr>
                <td style="width: 10px;" width="30">No.</td>
                <td width="150">Nama Linen</td>
                @foreach($location as $loc)
                <td width="130">{{ $loc->location_name }}</td>
                @endforeach
                <td width="100">Total Bersih (Pcs)</td>
                <td width="100">(Kg) Bersih</td>
                <td width="100">Total Kotor (Pcs)</td>
                <td width="80">Selisih</td>
            </tr>
        </thead>
        <tbody>
            @php
            $total_kotor_pcs_right = $total_kotor_pcs_bottom = $total_delivery_pcs_right = $total_delivery_pcs_bottom = $kg_delivery_right = $kg_delivery_bottom = $total_bersih_pcs_right = $total_bersih_pcs_bottom = $total_selisih = 0;
            @endphp

            @foreach($product as $item)

            @php
            $total_delivery_pcs = $linen_delivery ? $linen_delivery->where('linen_grouping_detail_product_id', $item->item_product_id)->where('linen_grouping_detail_description', LinenStatus::LinenKotor)->count() : 0;
            $total_kotor_pcs_right = $linen_kotor ? $linen_kotor->where('linen_kotor_detail_product_id', $item->item_product_id)->count() : 0;
            $total_delivery_pcs_right = $total_delivery_pcs ?? 0;

            $pivot_berat = $item->pivot->company_item_weight ?? 0;
            $kg_delivery_right = $total_delivery_pcs_right * $pivot_berat;

            $total_delivery_pcs_bottom = $total_delivery_pcs_bottom + $total_delivery_pcs_right;
            $total_kotor_pcs_bottom = $total_kotor_pcs_bottom + $total_kotor_pcs_right;

            $kg_delivery_bottom = $kg_delivery_bottom + $kg_delivery_right;

            $selisih = $total_kotor_pcs_right - $total_delivery_pcs_right;

            $total_selisih = $total_selisih + $selisih;

            @endphp
            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $item->item_product_name ?? '' }} </td>
                @foreach($location as $loc)
                <td>
                    @php
                    $detail_product = $linen_delivery->where('linen_grouping_detail_product_id', $item->item_product_id)->where('linen_grouping_detail_ori_location_id', $loc->location_id)->where('linen_grouping_detail_description', LinenStatus::LinenKotor);
                    $total_sub_product = count($detail_product) > 0 ? count($detail_product) : 0;
                    @endphp
                    {{ $total_sub_product }}
                </td>
                @endforeach

                <td>
                    {{ $total_delivery_pcs_right }}
                </td>
                <td>
                    {{ $kg_delivery_right }}
                </td>
                <td>
                    {{ $total_kotor_pcs_right }}
                </td>
                <td>
                    {{ $selisih }}
                </td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td>TOTAL SERAH TERIMA</td>
                @foreach($location as $loc)
                <td>
                    @if(isset($group_location[$loc->location_id]))
                    {{ count($group_location[$loc->location_id]) }}
                    @else
                    0
                    @endif
                </td>
                @endforeach
                <td>{{ $total_delivery_pcs_bottom ?? '' }}</td>
                <td>{{ $kg_delivery_bottom ?? 0 }}</td>
                <td>{{ $total_kotor_pcs_bottom ?? 0 }}</td>
                <td>{{ $total_selisih ?? 0 }}</td>
            </tr>
        </tfoot>
    </table>

    @if(request()->get('action') == 'pdf')
    <table class="footer">
        <thead>
            <tr>
                <td>DIBUAT</td>
                <td>DISETUJUI</td>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <td>{{ auth()->user()->name ?? '' }}</td>
                <td>SUSTER/PETUGAS RS</td>
            </tr>
        </tfoot>
    </table>

    @endif

</div>