<table id="header">
    <tr>
        <td>
            REKAP HASIL OPNAME
        </td>
    </tr>

    <tr>
        <td>
            {{ __('No. Opname') }} : {{ $model->{$model->getKeyName()} ?? '' }}
        </td>
    </tr>

    <tr>
        <td>
            {{ __('Nama Rs.') }} : {{ $model->mask_company_name ?? '' }}
        </td>
    </tr>

    <tr>
        <td>
            {{ __('Tanggal Opname') }} : {{ $model->mask_created_at ?? '' }}
        </td>
    </tr>

    <tr>
        <td>
            Tanggal Cetak : {{ date('d / M / Y') }}
        </td>
    </tr>
</table>

<table class="table table-no-more table-bordered table-striped mb-none">
    <thead>
        <tr>
            <th style="width: 2%;" class="col-md-1 text-left">No.</th>
            <th class="text-left col-md-2">Product Name</th>
            <th class="text-left col-md-1" style="width: 6%;">Stock Awal</th>
            <th class="text-left col-md-1" style="width: 8%;">Hasil Opname</th>
            <th class="text-left col-md-1">Pending Obsesiman</th>
            <th class="text-left col-md-1">Hilang Obsesiman</th>
            <th class="text-left col-md-1">Hilang Rs.</th>
        </tr>
    </thead>
    <tbody class="markup">

        @if($register)
        @php
        $total_stock = $total_opname = $total_pending = $total_hilang = $total_obsesiman = $total_rs = $total_hasil_opname = 0;
        @endphp
        @foreach ($register->sortBy('view_product_name') as $item)
        @php
        $total_stock = $total_stock + $item->view_register;
        $qty_opname = isset($opname[$item->view_product_id]) ? $opname[$item->view_product_id]->count() : 0;
        $total_opname = $total_opname + $qty_opname;
        $qty_pending = $qty_hilang = 0;
        if($outstanding){
            $qty_pending = $outstanding->where('linen_outstanding_product_id', $item->view_product_id)->count() ?? 0;
            $qty_hilang = $hilang->where('linen_outstanding_product_id', $item->view_product_id)->count() ?? 0;
        }
        $total_pending = $total_pending + $qty_pending;
        $total_obsesiman = $total_obsesiman + $qty_hilang;
        $qty_hilang_rs = $item->view_register - ($qty_opname + $qty_pending + $qty_hilang);
        $total_rs = $total_rs + $qty_hilang_rs;
        @endphp
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->view_product_name ?? '' }}</td>
            <td>{{ $item->view_register ?? '' }}</td>
            <td>{{ $qty_opname ?? '' }}</td>
            <td>{{ $qty_pending ?? '' }}</td>
            <td>{{ $qty_hilang ?? '' }}</td>
            <td>{{ abs($qty_hilang_rs) ?? '' }}</td>
        </tr>
        @endforeach
        @endisset
        <tr>
            <td colspan="2">TOTAL</td>
            <td>{{ $total_stock ?? '' }}</td>
            <td>{{ $total_opname ?? '' }}</td>
            <td>{{ $total_pending ?? '' }}</td>
            <td>{{ $total_obsesiman ?? '' }}</td>
            <td>{{ $total_rs ?? '' }}</td>
        </tr>
    </tbody>
</table>



<style>
    .export {
        width: 100%;
    }

    #header {
        margin-bottom: 20px;
        font-weight: bold;
        width: 30%;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    #datatable {
        width: 100%;
        position: relative;
    }

    #header tbody td {
        padding: 5px;
        border: 1px solid lightgray;
    }

    #header thead tr th {
        border: 1px solid gray;
        padding: 10px 5px;
        font-weight: bold;
    }

    .total {
        font-weight: bold;
        color: #fff;
        background-color: grey;
    }
</style>