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

<table id="transaction" class="table table-no-more table-bordered table-striped">
    <thead>
        <tr>
            <th class="text-left col-md-2">No. Seri RFID</th>
            <th class="text-left col-md-4">Product Name</th>
            <th class="text-left col-md-3">Default R.S</th>
            <th class="text-left col-md-3">Default Location</th>
            <!-- <th class="text-center col-md-1">Action</th> -->
        </tr>
    </thead>
    <tbody class="markup">
        @if(!empty($detail) || old('detail'))

        @php
        $detail = $detail->where('linen_grouping_deleted_at', null)->mapToGroups(function($item){
           return [$item->linen_grouping_detail_barcode => $item];
        });
        @endphp

        @foreach ($detail as $key => $barcode)
        <tr>
            <td colspan="5">
                <h5>
                    <strong>Barcode : {{ $key }}</strong>
                </h5>
            </td>
            <!-- <td>
                <a class="btn btn-success btn-block" href="{{ route('linen_delivery_delete_detail', ['code' => $key]) }}">Delete</a>
            </td> -->
        </tr>
        @if(!empty($barcode))
        @foreach($barcode as $item)
        <tr>
            <td data-title="RFID">
                <input type="text" readonly class="form-control"
                    value="{{ $item['temp_product'] ?? $item->mask_rfid ?? old('temp_id') }}"
                    name="detail[{{ $loop->index }}][temp_product]">

            </td>
            <td data-title="Description">
            <input type="text" readonly class="form-control"
                    value="{{ $item['temp_product'] ?? $item->mask_product_name ?? old('temp_id') }}"
                    name="detail[{{ $loop->index }}][temp_product]">
            </td>
            <td data-title="Qty" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}1" name="detail[{{ $loop->index }}][temp_qty]"
                    class="form-control" readonly
                    value="{{ $item->mask_company_ori_name ?? '' }}">
            </td>
            <td data-title="Send" class="text-right col-lg-1">
                <input type="text" tabindex="{{ $loop->iteration }}2" name="detail[{{ $loop->index }}][temp_out]"
                    class="form-control" readonly
                    value="{{ $item->mask_location_ori_name ?? '' }}">

            </td>
        </tr>

        @endforeach
        @endif
        @endforeach
        @endisset
    </tbody>

</table>