<table id="header">
    <tr>
        <td>
            REKAP HILANG di Rumah Sakit
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
            <th style="width: 2%;" class="text-left">No.</th>
            <th class="text-left col-md-2">No. Rfid</th>
            <th class="text-left col-md-2">Product Name</th>
            <th class="text-left col-md-1">Tgl Register Awal</th>
            <th class="text-left col-md-1">Ruangan</th>
        </tr>
    </thead>
    <tbody class="markup">

        @if($register)
        @foreach ($register->sortBy('mask_product_name') as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->mask_rfid ?? '' }}</td>
            <td>{{ $item->mask_product_name ?? '' }}</td>
            <td>{{ $item->item_linen_created_at ?? '' }}</td>
            <td>{{ $item->mask_location_name ?? '' }}</td>
        </tr>
        @endforeach
        @endif

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