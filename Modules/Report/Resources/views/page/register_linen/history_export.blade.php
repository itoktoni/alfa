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
                <h2>HISTORY LINEN</h2>
            </td>
        </tr>

        @if($title = request()->get('item_linen_company_id'))
        <tr>
            <td colspan="12" align="center">
                <h4>{{ $company[$title] ?? '' }}</h4>
            </td>
        </tr>
        @endif

        <tr>
            <td colspan="12" align="center">
                Periode : {{ request()->get('from') }} - {{ request()->get('to') }}
            </td>
        </tr>

    </table>

    <table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
        <thead>
            <tr>
                <td style="width: 20px;" width="30">No.</td>
                <td width="120">No. Seri Rfid</td>
                <td width="200">Nama Rumah Sakit</td>
                <td width="50">Nama Ruangan</td>
                <td width="200">Nama Linen</td>
                <td width="50">Register Oleh</td>
                <td width="50">Tanggal Register</td>
                <td width="50">Log Date</td>
                <td width="100">Status Terakhir</td>
            </tr>
        </thead>
        <tbody>
            @if($preview)
            @foreach($preview as $data)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $data->item_linen_rfid }}</td>
                <td>{{ $data->item_linen_company_name }}</td>
                <td>{{ $data->item_linen_location_name }}</td>
                <td>{{ $data->item_linen_product_name }}</td>
                <td>{{ $data->has_linen->has_user->name ?? '' }}</td>
                <td>{{ $data->item_linen_created_at }}</td>
                <td>{{ $data->item_linen_detail_created_at }}</td>
                <td>{{ $data->item_linen_detail_description }}</td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>