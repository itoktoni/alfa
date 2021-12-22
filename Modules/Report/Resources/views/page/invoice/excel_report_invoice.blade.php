@if(!empty($master))
<table>
    <tr>
        <td colspan="7">
            LAPORAN INVOICE
        </td>
    </tr>
    <tr>
        <td colspan="7">
            {{ $master->linen_delivery_company_name ?? '' }}
        </td>
    </tr>
</table>
<table>
    <tr>
        <td colspan="7">No. Invoice : {{ str_replace('DO', 'INV', $master->linen_delivery_key) }}</td>
    </tr>
    <tr>
        <td colspan="7">Tgl Transaksi : {{ date('d/m/Y') }}</td>
    </tr>
</table>
<table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr>
            <td>No.</td>
            <td>Nama Linen</td>
            <td>Qty</td>
            <td>Berat (Kg)</td>
            <td>Total (Kg)</td>
            <td>Harga</td>
            <td>Total Invoice</td>
        </tr>
    </thead>
    <tbody>
        @php
        $grandtotal = 0;
        @endphp
        @foreach($detail as $key => $data)
        @php
        $connection = Modules\System\Dao\Facades\CompanyConnectionItemProductFacades::where('company_id', $master->linen_delivery_company_id)->where('item_product_id', $key)->first();
        $weight = $connection->company_item_weight ?? 0;
        $unit = $connection->company_item_unit_id ?? 0;
        if($unit == 'GR'){
            $weight = $weight / 1000;
        }
        $kg = $data->count() * $weight;
        $price = $connection->company_item_price ?? 0;
        $total = $kg * $price;
        $grandtotal = $grandtotal + $total;
        $item = $data->first();
        @endphp
        <tr>
            <td>{{ $loop->iteration }} </td>
            <td>{{ $item->linen_grouping_detail_product_name ?? '' }} </td>
            <td>{{ $data->count() ?? '' }} </td>
            <td>{{ $weight }} </td>
            <td>{{ $kg }} </td>
            <td>{{ number_format($price) }} </td>
            <td>{{ number_format($total) }} </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td class="text-right" colspan="6">Grand Total</td>
            <td>{{ number_format($grandtotal) }}</td>
        </tr>
    </tfoot>
</table>

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
@endif