@if(!empty($preview))

<table>
    <tr>
        <td>
            REKAP SERAH TERIMA LINEN BERSIH HARIAN
        </td>
    </tr>

    <tr>
        <td>
            Tanggal Cetak : {{ date('d/m/Y') }}
        </td>
    </tr>
</table>

@if(!empty($preview))
<table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
    <thead>
        <tr>
            <td width="30">No.</td>
            <td width="150">Nama Linen</td>
            <td width="130">Rumah Sakit</td>
            <td width="130">Lokasi Ruangan</td>
            <td width="150">ID RFID Tag</td>
            <td width="100">Tanggal Masuk</td>
            <td width="100">Transaksi Terakhir</td>
        </tr>
    </thead>
    <tbody>
            @foreach($preview as $item)
        <tr>
            <td>{{ $loop->iteration }} </td>
            <td>{{ $item->linen_outstanding_product_name ?? '' }} </td>
            <td>
                {{  $item->linen_outstanding_ori_company_name }}
            </td> 
            <td>
                {{  $item->linen_outstanding_ori_location_name }}
            </td>
            <td>
                {{ $item->linen_outstanding_rfid }}
            </td>
            <td>
                {{ $item->linen_outstanding_created_at }}
            </td>
            <td>
                {{ $status[$item->linen_outstanding_status] ?? '' }}
            </td>
        </tr>
            @endforeach
    </tbody>
</table>
@endif
@else
<table>
    <tr>
        <td>Data Tidak Ditemukan</td>
    </tr>
</table>
@endif

@if(isset($model))
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
@endif