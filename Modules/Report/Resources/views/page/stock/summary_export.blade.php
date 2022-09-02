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

    </table>

    <table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
        <thead>
            <tr>
                <td width="20">No.</td>
                <td>Nama Rumah Sakit</td>
                <td>Nama Ruangan</td>
                <td>Nama Linen</td>
                <td width="80">Register Linen</td>
                <td width="80">Stock Rumah Sakit</td>
                <td width="80">Stock Obsesiman</td>
                <td width="50">Kotor</td>
                <td width="50">Retur</td>
                <td width="50">Rewash</td>
                <td width="50">Pending</td>
                <td width="50">Hilang</td>
            </tr>
        </thead>
        <tbody>
            @php
            $total_register = $total_qty = $total_cuci = $total_kotor = $total_retur = $total_rewash = $total_pending = $total_hilang = 0;
            @endphp
            @foreach($preview as $data)
            @php
            $total_register = $total_register + $data->view_register;
            $total_qty = $total_qty + $data->view_qty;
            $total_cuci = $total_cuci + $data->view_cuci;
            $total_kotor = $total_kotor + $data->view_kotor;
            $total_retur = $total_retur + $data->view_retur;
            $total_rewash = $total_rewash + $data->view_rewash;
            $total_pending = $total_pending + $data->view_pending;
            $total_hilang = $total_hilang + $data->view_hilang;
            @endphp
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
            <tr>
                <td colspan="4">Total</td>
                <td align="left">{{ $total_register ?? '' }} </td>
                <td align="left">{{ $total_qty ?? '' }} </td>
                <td align="left">{{ $total_cuci ?? '' }} </td>
                <td align="left">{{ $total_kotor ?? '' }} </td>
                <td align="left">{{ $total_retur ?? '' }} </td>
                <td align="left">{{ $total_rewash ?? '' }} </td>
                <td align="left">{{ $total_pending ?? '' }} </td>
                <td align="left">{{ $total_hilang ?? '' }} </td>
            </tr>
        </tbody>
    </table>
</div>