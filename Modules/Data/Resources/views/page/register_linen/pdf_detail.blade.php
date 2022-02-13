<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Report Registrasi linen</title>

</head>

<body>

    <div class="header">
        <div class="logo">
            <img src="{{ Helper::print('logo/logo.png') }}">
        </div>

        <div class="header-title">
            <h1> Laporan Registrasi Linen</h1>
            <p>Rumah Sakit : {{ $data->first()->item_linen_company_name ?? '' }}</p>
            <p>Tanggal : {{ request()->get('from') ?? '' }} - {{ request()->get('to') ?? '' }} </p>

        </div>

        <div class="container">
            <table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
                <thead>
                    <tr>
                        <th class="text-left">{{ __('No.') }}</th>
                        <th class="text-left">{{ __('Code RFID') }}</th>
                        <th class="text-left">{{ __('Rumah Sakit') }}</th>
                        <th class="text-left">{{ __('Ruangan') }}</th>
                        <th class="text-left">{{ __('Nama Linen') }}</th>
                        <th class="text-left">{{ __('Register Oleh') }}</th>
                        <th class="text-left">{{ __('Tanggal Register') }}</th>
                        <th class="text-left">{{ __('Tanggal Update') }}</th>
                        <th class="text-left">{{ __('Rental') }}</th>
                        <th class="text-left">{{ __('Status') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @if($data)
                    @foreach($data as $linen)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $linen->item_linen_rfid }}</td>
                        <td>{{ $linen->item_linen_company_name }}</td>
                        <td>{{ $linen->item_linen_location_name }}</td>
                        <td>{{ $linen->item_linen_product_name }}</td>
                        <td>{{ $linen->item_linen_created_name }}</td>
                        <td>{{ $linen->item_linen_created_at }}</td>
                        <td>{{ $linen->item_linen_updated_at }}</td>
                        <td>{{ LinenStatus::getDescription($linen->item_linen_rent) ?? '' }}</td>
                        <td>{{ LinenStatus::getDescription($linen->item_linen_status) ?? '' }}</td>
                    </tr>
                    @endforeach
                    @endif
                </tbody>
                <tbody class="markup">

                </tbody>
            </table>
        </div>
    </div>
</body>

<style>
    .header .logo {
        width: 250px;
        margin-top: 0px;
    }

    .header-title h1 {
        text-align: center;
    }

    .header-title p {
        text-align: center;
    }

    #datatable{
        width: 100%;
    }

    .text-left{
        text-align: left;
    }

    body {
        margin: 10px;
    }

    table#border {
        border: 0.5px solid grey;
    }

    .print-only {
        display: none !important
    }

    * {
        background: transparent !important;
        color: black !important;
        -webkit-box-shadow: none !important;
        box-shadow: none !important;
        text-shadow: none !important;
        -webkit-filter: none !important;
        filter: none !important;
        -ms-filter: none !important
    }

    *,
    *:before,
    *:after {
        -webkit-box-sizing: border-box;
        -moz-box-sizing: border-box;
        box-sizing: border-box
    }

    a,
    a:visited {
        text-decoration: underline
    }

    a[href]:after {
        content: "("attr(href) ")"
    }

    abbr[title]:after {
        content: "("attr(title) ")"
    }

    .ira:after,
    a[href^="javascript:"]:after,
    a[href^="#"]:after {
        content: ""
    }

    pre,
    blockquote {
        border: 1px solid #999;
        page-break-inside: avoid
    }

    thead {
        display: table-header-group
    }

    tr,
    img {
        page-break-inside: avoid
    }

    img {
        max-width: 100% !important;
        vertical-align: middle;
        max-height: 100% !important
    }

    table {
        border-collapse: collapse
    }

    th,
    td {
        border: solid 1px #333;
        padding: 0.25em 8px;
        vertical-align: top
    }

    dl {
        margin: 0
    }

    dd {
        margin: 0
    }

    @page {
        margin: 1.25cm 0.5cm
    }

    p,
    h2,
    h3 {
        orphans: 3;
        widows: 3
    }

    h2,
    h3 {
        page-break-after: avoid
    }

    .hide-on-print {
        display: none !important
    }

    .print-only {
        display: block !important
    }

    .hide-for-print {
        display: none !important
    }

    .show-for-print {
        display: inherit !important
    }

    .break-page-after {
        page-break-after: always;
        page-break-inside: avoid
    }

    html {
        overflow-x: visible
    }

    body {
        font-size: 12px;
        line-height: 1.5;
        font-family: "sans-serif",
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        font-weight: normal
    }

    h1 a,
    h2 a,
    h3 a,
    h4 a,
    h5 a,
    h6 a {
        font-weight: inherit
    }

    h2 {
        font-size: 2em;
        line-height: 1.5;
        margin-bottom: 0.75em
    }

    h3 {
        font-size: 1.5em;
        line-height: 1;
        margin-top: 2em;
        margin-bottom: 1em
    }

    h4 {
        font-size: 1.25em;
        line-height: 2.4
    }

    h5 {
        font-weight: bold;
        margin-top: 2.25em;
        margin-bottom: 0.75em
    }

    h6 {
        text-transform: uppercase;
        margin-top: 2.25em;
        margin-bottom: 0.75em
    }
</style>

</html>