@php
$list_status = TransactionStatus::getOptions();
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
                <h2>LINEN BERSIH</h2>
            </td>
        </tr>

        @if($title = request()->get('view_company_id'))
        <tr>
            <td colspan="12" align="center">
                <h4>{{ $company[$title] ?? '' }}</h4>
            </td>
        </tr>
        @endif

    </table>

    <table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
        <thead>
            <tr>
                <td style="width: 20px;" width="30">No.</td>
                <td width="150">Nama Linen</td>
                <td width="130">Rumah Sakit</td>
                <td width="130">Lokasi Ruangan</td>
                <td width="150">No. Seri RFID</td>
                <td width="100">Tanggal Transaksi</td>
            </tr>
        </thead>
        <tbody>
            @if($preview)
            @foreach($preview as $data)
            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $data->linen_grouping_detail_product_name ?? '' }} </td>
                <td>
                    {{ $data->linen_grouping_detail_ori_company_name }}
                </td>
                <td>
                    {{ $data->linen_grouping_detail_ori_location_name }}
                </td>
                <td>
                    {{ $data->linen_grouping_detail_rfid }}
                </td>
                <td>
                    {{ $data->linen_grouping_detail_created_at }}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>