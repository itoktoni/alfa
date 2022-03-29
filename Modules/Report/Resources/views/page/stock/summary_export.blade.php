<div class="export">

    @if(request()->get('action') == 'pdf')
    <div class="logo">
        <img src="{{ Helper::print('logo/logo.png') }}">
    </div>

    <x-print/>

    @endif

    <table id="header">
        <tr>
            <td colspan="12" align="center">
                <h2>REKAP SUMMARY STOCK</h2>
            </td>
        </tr>

        @if($title = request()->get('view_company_id'))
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
                <td width="30">No.</td>
                <td width="150">Nama Rumah Sakit</td>
                <td width="100">Nama Ruangan</td>
                <td width="200">Nama Linen</td>
                <td width="80">Register Linen</td>
                <td width="120">Stock Rumah Sakit</td>
                <td width="120">Stock Obsesiman</td>
                <td width="50">Kotor</td>
                <td width="50">Retur</td>
                <td width="50">Rewash</td>
                <td width="50">Pending</td>
                <td width="50">Hilang</td>
            </tr>
        </thead>
        <tbody>
            @foreach($preview as $data)
            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $data->view_company_name ?? '' }} </td>
                <td>{{ $data->view_location_name ?? '' }} </td>
                <td>{{ $data->view_product_name ?? '' }} </td>
                <td align="left">{{ $data->view_register ?? '' }} </td>
                <td align="left">{{ $data->view_qty ?? '' }} </td>
                <td align="left">{{ $data->view_cuci ?? '' }} </td>
                <td align="left">{{ $data->view_kotor ?? '' }} </td>
                <td align="left">{{ $data->view_retur ?? '' }} </td>
                <td align="left">{{ $data->view_rewash ?? '' }} </td>
                <td align="left">{{ $data->view_pending ?? '' }} </td>
                <td align="left">{{ $data->view_hilang ?? '' }} </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>