@php

$date_from = Carbon\Carbon::createFromFormat('Y-m-d', request()->get('from'));
$date_to = Carbon\Carbon::createFromFormat('Y-m-d', request()->get('to'));
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
            $total_bersih_bawah = $total_pcs_bawah = $total_kotor_bawah = 0;
            @endphp

            @foreach($product as $item)

            @php
            $pivot_berat = $item->pivot->company_item_weight ?? 0;
            @endphp

            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $item->item_product_name ?? '' }} </td>
                @foreach($location as $loc)
                <td>
                    @php
                    $group_bersih = $preview
                    ->where('linen_grouping_detail_product_id', $item->item_product_id)
                    ->where('linen_grouping_detail_ori_location_id', $loc->location_id)
                    ->where('linen_grouping_detail_description', LinenStatus::LinenKotor)
                    ->count();
                    $total_bersih_bawah = $total_bersih_bawah + $group_bersih;
                    @endphp
                    {{ $group_bersih }}
                </td>
                @endforeach
                <td>
                    @php
                    $group_bersih_kanan = $preview
                    ->where('linen_grouping_detail_product_id', $item->item_product_id)
                    ->where('linen_grouping_detail_description', LinenStatus::LinenKotor)
                    ->count();
                    $total_bersih_bawah = $total_bersih_bawah + $group_bersih;
                    @endphp
                    {{ $group_bersih_kanan }}
                </td>
                <td>
                    @php
                    $pcs_bersih = $group_bersih_kanan * $pivot_berat;
                    $total_pcs_bawah = $total_pcs_bawah + $pcs_bersih;
                    @endphp
                    {{ $pcs_bersih }}
                </td>
                <td>
                    @php
                    $group_kotor = $kotor
                    ->where('linen_kotor_detail_product_id', $item->item_product_id)
                    ->where('linen_kotor_detail_description', LinenStatus::LinenKotor)
                    ->count();
                    $total_kotor_bawah = $total_kotor_bawah + $group_kotor;
                    @endphp
                    {{ $group_kotor }}
                </td>
                <td>
                    {{ $group_bersih_kanan - $group_kotor ?? 0 }}
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
                    @php
                    $total_bawah = $preview
                        ->where('linen_grouping_detail_ori_location_id' , $loc->location_id)
                        ->where('linen_grouping_detail_description', LinenStatus::LinenKotor)
                        ->count();
                    @endphp
                    {{ $total_bawah }}
                </td>
                @endforeach
                <td data="total bersih">
                    {{ $total_bersih_bawah }}
                </td>
                <td data="kg bersih">
                    {{ $total_pcs_bawah }}
                </td>
                <td  data="total kotor">{{ $total_kotor_bawah ?? 0 }}</td>
                <td  data="selisih">{{ $total_bersih_bawah - $total_kotor_bawah ?? 0 }}</td>
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