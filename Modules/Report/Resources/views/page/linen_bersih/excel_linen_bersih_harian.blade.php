@php
    $linen_delivery = $detail;
    $linen_kotor = $kotor->has_detail ?? [];
    $total_location = count($location)+6;
@endphp
@if(!empty($detail))
    @php
    $group_location = $linen_delivery->groupBy('linen_grouping_detail_ori_location_id');
    @endphp

    <table>
        <tr>
            <td>
                REKAP SERAH TERIMA LINEN BERSIH HARIAN
            </td>
        </tr>
        <tr>
            <td>
                {{ $master->linen_delivery_company_name ?? '' }}
            </td>
        </tr>
        <tr>
            <td>
                Tanggal Cetak : {{ date('d/m/Y') }}
            </td>
        </tr>
    </table>

    <table>
        <tr>
            <td>Tanggal Linen Bersih : {{ $date_from->format('d/m/Y') ?? '' }} - {{ $date_to->format('d/m/Y') ?? '' }}</td>
        </tr>
        <tr>
            <td>Tanggal Linen Kotor : {{ $date_from->addDays(-1)->format('d/m/Y') ?? '' }} - {{ $date_to->addDays(-1)->format('d/m/Y') ?? '' }}</td>
        </tr>
    </table>

    @if(!empty($master))

    <table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
        <thead>
            <tr>
                <td width="30">No.</td>
                <td width="150">Nama Linen</td>
                @foreach($location as $loc)
                <td width="130">{{ $loc->location_name }}</td>
                @endforeach
                <td width="100">Total Bersih (Pcs)</td>
                <td width="100">(Kg) Bersih</td>
                <td width="100">Total Kotor (Pcs)</td>
            </tr>
        </thead>
        <tbody>
            @if($linen_kotor)
            @php 
            $total_kotor_pcs_right = $total_kotor_pcs_bottom = $total_delivery_pcs_right = $total_delivery_pcs_bottom = $kg_delivery_right = $kg_delivery_bottom = $total_bersih_pcs_right = $total_bersih_pcs_bottom = 0;
            @endphp

            @foreach($product as $item)

            @php
            
            $total_delivery_pcs = $linen_delivery->where('linen_grouping_detail_product_id', $item->item_product_id)->count();
            $total_kotor_pcs_right = $linen_kotor->where('linen_kotor_detail_product_id', $item->item_product_id)->count();
            $total_delivery_pcs_right = $total_delivery_pcs;

            $pivot_berat = $item->pivot->company_item_weight ?? 0;
            $kg_delivery_right = $total_delivery_pcs_right * $pivot_berat;

            $total_delivery_pcs_bottom = $total_delivery_pcs_bottom + $total_delivery_pcs_right;
            $total_kotor_pcs_bottom = $total_kotor_pcs_bottom + $total_kotor_pcs_right;

            $kg_delivery_bottom = $kg_delivery_bottom + $kg_delivery_right;

            @endphp
            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $item->item_product_name ?? '' }} </td>
                @foreach($location as $loc)
                <td>
                    @php
                    $detail_product = $linen_delivery->where('linen_grouping_detail_product_id', $item->item_product_id)->where('linen_grouping_detail_ori_location_id', $loc->location_id);
                    $total_sub_product = count($detail_product) > 0 ? count($detail_product) : 0;
                    @endphp
                    {{ $total_sub_product }}
                </td>
                @endforeach
                
                <td>
                    {{  $total_delivery_pcs_right }}
                </td>
                <td>
                    {{ $kg_delivery_right }}
                </td> 
                <td>
                    {{ $total_kotor_pcs_right }}
                </td>
            </tr>
            @endforeach
            @endif
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
            </tr>
        </tfoot>
    </table>

    @endif
    @else
    <table>
        <tr>
            <td>Data Tidak Ditemukan</td>
        </tr>
    </table>
    @endif

    @if(isset($model))
    <style>
        table{
            border: 1px solid lightgray;
            overflow-x: auto;
            white-space: nowrap;
            margin-bottom: 10px;
        }

        table tbody{
            width: 100%;
        }

        table thead{
            font-weight: bold;
            border-bottom: 1px solid lightgray;
        }

        table tfoot{
            border-top: 1px solid lightgray;
            font-weight: bold;
        }

        table tr td{
            padding: 10px;

        }

        table:nth-child(3) tr td:nth-child(1){
            width: 50px;
        }
    </style>
@else
    <table>
        <tr>
            <td>DIBUAT</td>
            <td></td>
            <td></td>
            <td>DISETUJUI</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
        <tr>
            <td>{{ auth()->user()->name ?? '' }}</td>
            <td><br></td>
            <td><br></td>
            <td>SUSTER / PETUGAS RS</td>
        </tr>
    </table>
@endif