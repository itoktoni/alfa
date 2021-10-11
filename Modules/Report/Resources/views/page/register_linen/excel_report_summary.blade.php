<table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr>
            <td width="5">No.</td>
            <td width="50">Nama Linen</td>
            <td width="50">Nama Customer</td>
            <td width="10">Qty</td>
            <td width="10">Berat (Kg)</td>
            <td width="10">Total (Kg)</td>
            <td width="10">Target Stock</td>
            <td width="10">Selisih</td>
        </tr>
    </thead>
    <tbody>
        @foreach($preview as $data)
        @php
        $connection = Modules\System\Dao\Facades\CompanyConnectionItemProductFacades::where('company_id', $data->item_linen_company_id)->where('item_product_id', $data->item_linen_product_id)->first();
        $weight = $connection->company_item_weight ?? 0;
        $kg = $data->qty * $weight;
        $target = $connection->company_item_target ?? 0;
        $selisih = $target > 0 ? $target - $data->qty : 0;
        @endphp
        <tr>
            <td>{{ $loop->iteration }} </td>
            <td>{{ $data->item_linen_product_name ?? '' }} </td>
            <td>{{ $data->item_linen_company_name ?? '' }} </td>
            <td>{{ $data->qty ?? '' }} </td>
            <td>{{ $weight }} </td>
            <td>{{ $kg }} </td>
            <td>{{ $target }} </td>
            <td>{{ $selisih }} </td>
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