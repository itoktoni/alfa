@push('style')
<style>
    .show-table table {
        width: 100%;
    }

    .show-table td[data-title="Action"],
    .show-table #action {
        display: none !important;
    }
</style>
@endpush
@if(!empty($summary))
<table id="transaction" class="table table-no-more table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-left" style="width: 3%;">No.</th>
            <th class="text-left col-md-4">Product Name</th>
            <th class="text-right col-md-1">Target</th>
            <th class="text-right col-md-1">Realisasi</th>
            <th class="text-right col-md-1">Stock</th>
            <th class="text-right col-md-1">Opname</th>
        </tr>
    </thead>
    <tbody class="markup">
        
        @foreach($summary as $item)
        <tr>
            <td data-title="No.">
                {{ $loop->iteration }}
            </td>
            <td data-title="Product Name">
                {{ $item->linen_opname_summary_item_product_name }}
            </td>
            <td data-title="Target" class="text-right col-lg-1">
               {{ $item->linen_opname_summary_qty_target }}
            </td>
            <td data-title="Realisasi" class="text-right col-lg-1">
               {{ $item->linen_opname_summary_qty_realisasi }}
            </td>
            <td data-title="Qty" class="text-right col-lg-1">
               {{ $item->linen_opname_summary_qty_stock }}
            </td>
            <td data-title="Opname" class="text-right col-lg-1">
                {{ $item->linen_opname_summary_qty_opname }}
            </td>
        </tr>
        @endforeach
       

    </tbody>

</table>
@endif