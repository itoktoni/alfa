@php

$date_from = Carbon\Carbon::createFromFormat('Y-m-d', request()->get('from'));
$date_to = Carbon\Carbon::createFromFormat('Y-m-d', request()->get('to'));
@endphp

<div class="export">

    @if(request()->get('action') == 'pdf')
    <div class="logo">
        <img src="{{ Helper::asset('files/logo/logo.png') }}">
    </div>

    <x-print />

    @endif

    <table id="header">
        <tr>
            <td colspan="12" align="center">
                <h2>REKAP SERAH TERIMA LINEN KOTOR HARIAN</h2>
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
                <h5 style="text-align: left;">Tanggal Linen Bersih : {{ $date_from->addDays(+1)->format('d/m/Y') ?? '' }} - {{ $date_to->addDays(+1)->format('d/m/Y') ?? '' }}</h5>
            </td>
        </tr>
        <tr>
            <td colspan="12" align="left">
                <h5 style="text-align: left;">Tanggal Linen Kotor : {{ Carbon\Carbon::createFromFormat('Y-m-d', request()->get('from'))->format('d/m/Y') ?? '' }} - {{ Carbon\Carbon::createFromFormat('Y-m-d', request()->get('to'))->format('d/m/Y') ?? '' }}</h5>
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
                <td width="100">Total Kotor (Pcs)</td>
                <td width="100">(Kg) Bersih</td>
                <td width="100">Total Bersih (Pcs)</td>
                <td width="80">Selisih</td>
            </tr>
        </thead>
        <tbody>
            @php
            $total_bersih_bawah = $total_kg_bawah = $total_kotor_bawah = 0;
            @endphp

            @foreach($product->sortBy('item_product_name') as $item)

            @php
            $pivot_berat = $item->pivot->company_item_weight ?? 0;
            @endphp

            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $item->item_product_name ?? '' }} </td>
                @foreach($location as $loc)
                <td>
                    @php
                    $kotor_location = $preview
                    ->where('linen_kotor_detail_product_id', $item->item_product_id)
                    ->where('linen_kotor_detail_ori_location_id', $loc->location_id)
                    ->where('linen_kotor_detail_description', LinenStatus::LinenKotor)
                    ->count();
                    @endphp
                    {{ Helper::echoNumber($kotor_location) }}
                </td>
                @endforeach
                <td>
                    @php
                    $total_kotor_kanan = $preview
                    ->where('linen_kotor_detail_product_id', $item->item_product_id)
                    ->where('linen_kotor_detail_description', LinenStatus::LinenKotor)
                    ->count();
                    $total_kotor_bawah = $total_kotor_bawah + $total_kotor_kanan;
                    @endphp
                    {{ Helper::echoNumber($total_kotor_kanan) }}
                </td>
                <td>
                    @php
                    $kg_bersih = $total_kotor_kanan * $pivot_berat;
                    $total_kg_bawah = $total_kg_bawah + $kg_bersih;
                    @endphp
                    {{ Helper::echoNumber($kg_bersih) }}
                </td>
                <td>
                    @php
                    $total_bersih_kanan = 0;
                    if($kotor){

                        $total_bersih_kanan = $kotor
                        ->where('linen_grouping_detail_product_id', $item->item_product_id)
                        ->where('linen_grouping_detail_description', LinenStatus::LinenKotor)
                        ->count();
                    }
                    $total_bersih_bawah = $total_bersih_bawah + $total_bersih_kanan;
                    @endphp
                    {{ Helper::echoNumber($total_bersih_kanan) }}
                </td>
                <td>
                    @php
                    $pengurangan = $total_kotor_kanan - $total_bersih_kanan ?? 0;
                    @endphp
                    {{ $pengurangan }}
                </td>
            </tr>
            @endforeach

            <tr>
                <td>{{ $product->count() + 1}}</td>
                <td>TOTAL SERAH TERIMA</td>

                @foreach($location as $loc)
                <td>
                    @php
                    $total_bawah = $preview
                        ->where('linen_kotor_detail_ori_location_id' , $loc->location_id)
                        ->where('linen_kotor_detail_description', LinenStatus::LinenKotor)
                        ->count();
                    @endphp
                    {{ Helper::echoNumber($total_bawah) }}
                </td>
                @endforeach
                <td>
                    {{ Helper::echoNumber($total_kotor_bawah) }}
                </td>
                <td>
                    {{ Helper::echoNumber($total_kg_bawah) }}
                </td>
                <td>{{ Helper::echoNumber($total_bersih_bawah) }}</td>
                <td>{{ $total_bersih_bawah - $total_kotor_bawah ?? '' }}</td>
            </tr>

        </tbody>
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