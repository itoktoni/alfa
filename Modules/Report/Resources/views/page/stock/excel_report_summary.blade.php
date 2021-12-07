<table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr>
            <td width="150">Nama Rumah Sakit</td>
            <td width="100">Nama Ruangan</td>
            <td width="200">Nama Linen</td>
            <td width="80">Par Stock</td>
            <td width="150">Stock Rumah Sakit</td>
            <td width="150">Stock Obsesiman</td>
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
            <td>{{ $data->view_company_name ?? '' }} </td>
            <td>{{ $data->view_location_name ?? '' }} </td>
            <td>{{ $data->view_product_name ?? '' }} </td>
            <td>{{ $data->view_register ?? '' }} </td>
            <td>{{ $data->view_qty ?? '' }} </td>
            <td>{{ $data->view_cuci ?? '' }} </td>
            <td>{{ $data->view_kotor ?? '' }} </td>
            <td>{{ $data->view_retur ?? '' }} </td>
            <td>{{ $data->view_rewash ?? '' }} </td>
            <td>{{ $data->view_pending ?? '' }} </td>
            <td>{{ $data->view_hilang ?? '' }} </td>
        </tr>
        @endforeach
    </tbody>
</table>

<style>
table {
    border: 1px solid lightgray;
    overflow-x: auto;
    white-space: nowrap;
    margin-bottom: 10px;
}

table tbody {
    width: 100%;
}

table thead {
    font-weight: bold;
    border-bottom: 1px solid lightgray;
}

table tfoot {
    border-top: 1px solid lightgray;
    font-weight: bold;
}

table tr td {
    padding: 10px;

}

table:nth-child(3) tr td:nth-child(1) {
    width: 50px;
}
</style>