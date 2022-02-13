<div class="export">

    @if(request()->get('action') == 'pdf')
    <div class="logo">
        <img src="{{ Helper::print('logo/logo.png') }}">
    </div>

    <x-print />

    @endif

    <table id="header">
        <tr>
            <td colspan="12" align="center">
                <h2>LAPORAN PAR-STOCK RUMAH SAKIT</h2>
            </td>
        </tr>

        @if($title = request()->get('item_linen_company_id'))
        <tr>
            <td colspan="12" align="center">
                <h4>{{ $company[$title] ?? '' }}</h4>
            </td>
        </tr>
        @endif

        <tr>
            <td colspan="12" align="center">
                Periode : {{ request()->get('from') }} - {{ request()->get('to') }}
            </td>
        </tr>

    </table>

    <table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
        <thead>
            <tr>
                <td style="width: 20px;" width="30">No.</td>
                <td width="200">Nama Linen</td>
                <td width="150">Nama Rumah Sakit</td>
                <td style="width: 30px;" width="50">Qty</td>
                <td width="50">Berat (Kg)</td>
                <td width="50">Total (Kg)</td>
                <td width="50">Par-Stock</td>
                <td width="50">Kurang Lebih</td>
            </tr>
        </thead>
        <tbody>
            @if($preview)
            @php
            $data_preview = $preview->mapToGroups(function($item){
                return [$item->item_linen_product_id => $item];
            });
            @endphp
            @foreach($data_preview as $data)
            @php
            $single = $data->first();
            $qty = $data->count();
            $kg = $qty * $single->mask_weight;
            @endphp
            <tr>
                <td>{{ $loop->iteration }} </td>
                <td>{{ $single->mask_product_name ?? '' }} </td>
                <td>{{ $single->mask_company_name ?? '' }} </td>
                <td>{{ $qty ?? '' }} </td>
                <td>{{ $single->mask_weight }} </td>
                <td>{{ $kg ?? 0 }} </td>
                <td>{{ $single->mask_target }} </td>
                <td>{{ $single->mask_target - $qty }} </td>
            </tr>
            @endforeach
            @endif
        </tbody>
    </table>
</div>