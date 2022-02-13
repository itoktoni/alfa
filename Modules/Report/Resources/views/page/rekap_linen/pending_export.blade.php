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
                <h2>REKAP LINEN PENDING</h2>
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
                <td width="100">Tanggal Masuk</td>
                <td width="100">Status</td>
            </tr>
        </thead>
        <tbody>
            @if($preview)
            @foreach($preview as $data)
            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $data->linen_outstanding_product_name ?? '' }} </td>
                <td>
                    {{ $data->linen_outstanding_ori_company_name }}
                </td>
                <td>
                    {{ $data->linen_outstanding_ori_location_name }}
                </td>
                <td>
                    {{ $data->linen_outstanding_rfid }}
                </td>
                <td>
                    {{ $data->linen_outstanding_created_at }}
                </td>
                <td>
                    {{ $list_status[$data->linen_outstanding_status] ?? '-' }}
                </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>