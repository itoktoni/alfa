<table>
    <thead>
        <tr>
            <td>No.</td>
            <td>Nama Linen</td>
            <td>Nama Customer</td>
            <td>Qty</td>
            <td>Berat (Kg)</td>
            <td>Total (Kg)</td>
            <td>Target Stock</td>
            <td>Selisih</td>
        </tr>
    </thead>
    <tbody>
        @foreach($export as $data)
        @php
        $connection = Modules\System\Dao\Facades\CompanyConnectionItemProductFacades::where('company_id', $data->company_id)->where('item_product_id', $data->item_linen_product_id)->first();
        $weight = $connection->company_item_weight ?? 0;
        $kg = $data->qty * $weight;
        $target = $connection->company_item_target ?? 0;
        $selisih = $target > 0 ? $target - $data->qty : 0;
        @endphp
        <tr>
            <td>{{ $loop->iteration }} </td>
            <td>{{ $data->item_product_name ?? '' }} </td>
            <td>{{ $data->company_name ?? '' }} </td>
            <td>{{ $data->qty ?? '' }} </td>
            <td>{{ $weight }} </td>
            <td>{{ $kg }} </td>
            <td>{{ $target }} </td>
            <td>{{ $selisih }} </td>
        </tr>
        @endforeach
    </tbody>
</table>