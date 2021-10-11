@php
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Documentation for Developer</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <style type="text/css">
    body {
        padding: 20px;
    }

    .table-striped tbody tr:nth-of-type(odd) {
        background-color: rgba(0, 0, 0, .015);
    }

    .table td,
    .table th {
        border-top: none;
        font-size: 14px;
        vertical-align: middle !important;
    }

    .table thead th {
        border-bottom: 1px solid #ff5722;
    }

    .text-warning {
        color: #ff5722 !important;
    }

    .tag {
        padding: 0.30em 0.8em;
    }
    </style>
</head>

<body>

    <h1 class="display-4">Documentation API with ({{ count($routes) }}) Endpoint </h1>

    <div class="mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Login with method <button class="btn btn-primary btn-sm">POST</button> :
                            <code>{{ route('api_login') }}</code>
                        </h4>
                        <p>kamu bisa menggunakan applikasi seperti <a href="https://insomnia.rest/">Insomnia</a> or <a
                                href="https://www.postman.com/">Postman</a> dan ikuti petujuk di documentasi ini</p>

                        <iframe width="100%" height="500px"
                            style="box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); border-radius:15px;"
                            allowtransparency="true" allowfullscreen="true" scrolling="no"
                            title="Embedded DrawSQL IFrame" frameborder="0"
                            src="https://drawsql.app/benline/diagrams/lts/embed"></iframe>

                    </div>
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-4">

                                <h4>For login parameter :</h4>
                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">Parameter</th>
                                            <th scope="col">Descripton</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <code>username</code>
                                            </td>
                                            <td>
                                                masukan username yang telah diberikan
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <code>password</code>
                                            </td>
                                            <td>
                                                masukan password yang telah diberikan
                                            </td>
                                        </tr>
                                    </tbody>
                                    <thead>
                                        <tr>
                                            <th colspan="2">* jika gagal login ada informasi
                                                <code>{ status : false }</code>
                                            </th>
                                        </tr>
                                        <tr>
                                            <th colspan="2">
                                                * Login tidak membutuhkan header Authorization Bearer
                                            </th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>

                            <col-md-8>
                                <h2 class="text-danger">CATATAN PENTING UNTUK MENGAKSES API !!!</h2>
                                <h6>* untuk mengakses api membutuhkan <code>token</code> yang diambil dari data login :
                                    <code>{ "api_token": "xxxxxxxxxxxxxxxxxxxxxx" }</code>
                                </h6>
                                <table class="table table-bordered mt-3">
                                    <thead>
                                        <tr>
                                            <th scope="col">Header</th>
                                            <th scope="col">Value</th>
                                            <th scope="col">Descripton</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <code>Accept</code>
                                            </td>
                                            <td>
                                                <code>application/json</code>
                                            </td>
                                            <td>
                                                Harus dimasukan ketika mengirim
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <code>Content-Type</code>
                                            </td>
                                            <td>
                                                <code>application/json</code>
                                            </td>
                                            <td>
                                                Harus dimasukan ketika mengirim
                                            </td>
                                        </tr>
                                        <thead>
                                            <tr>
                                                <th scope="col"><code>Authorization</code></th>
                                                <th scope="col"><code>Bearer xxxxxxxxxx</code></th>
                                                <th scope="col">Masukan xxxxxxxxxx (token) yang telah didapat dari login
                                                </th>
                                            </tr>
                                        </thead>
                                    </tbody>
                                </table>
                            </col-md-8>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-sm table-bordered">
        <tbody>
            <?php $methodColours = ['GET' => 'success', 'HEAD' => 'default', 'POST' => 'primary', 'PUT' => 'warning', 'PATCH' => 'info', 'DELETE' => 'danger'];?>
            @foreach ($mapping as $key => $group)
            <tr>
                <td colspan="4" style="background-color: grey;color:white">
                    <h2>
                        {{ Str::of($key)->kebab()->replace('-',' ')->title() }}
                    </h2>
                </td>
            </tr>
            <tr>
                <th style="width: 10%">Methods</th>
                <th style="width: 25%;">End Point</th>
                <th style="width: 50%;">Request Parameter</th>
                <th style="width: 10%;" class="text-center">Show</th>
            </tr>
            @foreach($group as $api)
            @php
            $code = in_array($api->system_action_function, ['update', 'get']) ? '/{code}' : '';
            $data = $routes->get($api->system_action_code.'_api');
            $model = $data ? $data->getController()::$model : [];
            $json = $model ? $model->first() : [];
            $list = $model ? $model->limit(2) : [];
            $link = $api->system_action_function == 'save' ? $api->system_action_module.'/create' :
            $api->system_action_link;
            @endphp
            <tr>
                <td>
                    <span class="btn btn-sm btn-block btn-{{ Arr::get($methodColours, $api->system_action_method) }}">
                        {{ $api->system_action_method }}
                    </span>
                </td>

                <td>
                    <h4>API {{ strtoupper($api->system_action_function) }}</h4>
                    {{ url('/api/').'/'.$link }}<span class="text-danger"><strong>{{ $code }}</strong></span>
                </td>

                <td>

                    @switch($api->system_action_function)

                    @case('save')
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Mandatory</th>
                                <th scope="col">Validation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model->rules as $key => $rules)

                            <tr>
                                <td>
                                    <code>{{ $key }}</code>
                                </td>
                                <td>
                                    {{ Str::of($rules)->replace('|', ' & ')->replace(':', ' : ') }}
                                </td>
                            </tr>

                            @endforeach
                        </tbody>

                    </table>

                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col" colspan="3">Available fields</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(collect($model->getFillable())->chunk(3) as $fields)
                            <tr>
                                @foreach($fields as $field)
                                <td>
                                    <code>{{ $field }}</code>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @break

                    @case('update')
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Mandatory</th>
                                <th scope="col">Validation</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <code>code</code>
                                </td>
                                <td>
                                    masukan parameter <code>{ "code" : "example" }</code> untuk di jadikan primary key
                                </td>
                            </tr>
                            @foreach($model->rules as $key => $rules)
                            @if($key != $model->getKeyName())
                            <tr>
                                <td>
                                    <code>{{ $key }}</code>
                                </td>
                                <td>
                                    {{ Str::of($rules)->replace('|', ' & ')->replace(':', ' : ') }}
                                </td>
                            </tr>
                            @endif

                            @endforeach
                        </tbody>

                    </table>

                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col" colspan="3">Available fields</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(collect($model->getFillable())->chunk(3) as $fields)
                            <tr>
                                @foreach($fields as $field)
                                <td>
                                    <code>{{ $field }}</code>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @break

                    @case('data')
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Parameter</th>
                                <th scope="col">Optional Pencarian Data</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>
                                    <code>search</code>
                                </td>
                                <td>
                                    default akan mencari
                                    berdasarkan field <code>{{ $model->searching ?? '' }}</code> dengan operator
                                    <code>like</code>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <code>code</code>
                                </td>
                                <td>
                                    untuk pencarian berdasarkan field tertentu
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <code>aggregate</code>
                                </td>
                                <td>
                                    operator : <code> '=', '!=', 'like', 'not like', '<', '>' , </code>
                                    contoh : <br>
                                    <code>select * from {{ $model ? $model->getTable() : '' }} where {{ $model ? $model->searching : '' }} [=] 'data'</code>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <code>page=(int)</code>
                                </td>
                                <td>
                                    jika data ingin dibuat pagination maka url end point arahkan ke : <br>
                                    <code>{{ url('/api/').'/'.$api->system_action_link }}?page=1</code>
                                    <br> jika ingin ke halaman selanjutnya (next) tinggal mengganti 1 menjadi
                                    (iteration) <br>
                                    secara default page akan di batasi hanya
                                    <code>{{ config('website.pagination') }}</code> baris
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <code>limit</code>
                                </td>
                                <td>
                                    untuk memperbesar limit kita dapat menset <code>{ limit : 100 }</code>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    @break

                    @case('delete')
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Parameter</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>
                                    <code>code (int or string)</code>
                                </td>
                                <td>
                                    untuk delete data kita bisa mengirim parameter <code>{ "code" : "example"  }</code>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <code>code (array)</code>
                                </td>
                                <td>
                                    untuk multiple delete kita bisa memasukan array code
                                    <code>
                                    {
                                        "code" : ["1", "2", "3"]
                                    }
                                    </code>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    @break

                    @case('get')
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Parameter</th>
                                <th scope="col">Description</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>
                                    <code>code</code>
                                </td>
                                <td>
                                    masukan code untuk mendapatkan single data
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <code>relation</code>
                                </td>
                                <td>
                                    jika ingin mendapatkan data join bisa menambahkan <code>/get/1?relation=table</code>
                                    di parameter
                                </td>
                            </tr>

                        </tbody>
                    </table>
                    @break

                    @case('patch')
                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Mandatory</th>
                                <th scope="col">Validation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model->rules as $key => $rules)

                            <tr>
                                <td>
                                    <code>{{ $key }}</code>
                                </td>
                                <td>
                                    {{ Str::of($rules)->replace('|', ' & ')->replace(':', ' : ') }}
                                </td>
                            </tr>

                            @endforeach

                            <tr>
                                <td colspan="2">
                                    jika data ada di database , maka data akan dikirimkan kembali oleh api, </br>
                                    jika tidak ada di database maka data akan otomatis di simpan di database
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    masukan data type <code>{ "type" : "update" }</code> jika ingin automatic update
                                    ketika data dikirim
                                </td>

                            </tr>

                            <tr>
                                <td colspan="2">
                                    masukan data session <code>{ "item_linen_session" : "xxxx" }</code> jika ingin
                                    membuat sesi 1x scan
                                </td>
                            </tr>

                        </tbody>

                    </table>

                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col" colspan="3">Available fields</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(collect($model->getFillable())->chunk(3) as $fields)
                            <tr>
                                @foreach($fields as $field)
                                <td>
                                    <code>{{ $field }}</code>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @break

                    
                    @case('batch')


                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                               <th colspan="2">
                                    <h4>Create Data</h4>
                               </th> 
                            </tr>
                            <tr>
                                <th scope="col">Mandatory</th>
                                <th scope="col">Validation</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($model->rules as $key => $rules)

                            <tr>
                                <td>
                                    <code>{{ $key }}</code>
                                </td>
                                <td>
                                    {{ Str::of($rules)->replace('|', ' & ')->replace(':', ' : ') }}
                                </td>
                            </tr>

                            @endforeach

                            <tr>
                                <td>
                                    <code>data</code>
                                </td>
                                <td>
                                    required, example : <code>{ "data" : ["FRID-000-1" , "FRID-000-2", "FRID-000-3"] }</code>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    masukan data session <code>{ "linen_outstanding_session" : "xxxx" }</code> jika ingin
                                    membuat sesi 1x scan
                                </td>
                            </tr>

                        </tbody>

                        <thead>
                            <tr>
                               <th colspan="2">
                                    <h4>Update Data</h4>
                               </th> 
                            </tr>
                            <tr>
                                <th scope="col">Mandatory</th>
                                <th scope="col">Validation</th>
                            </tr>
                        </thead>

                        <tbody>
                            
                            <tr>
                                <td>
                                    <code>linen_outstanding_status</code>
                                </td>
                                <td>
                                    required & in : 1,2,3
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <code>data</code>
                                </td>
                                <td>
                                    required, example : <code>{ "data" : ["FRID-000-1" , "FRID-000-2", "FRID-000-3"] }</code>
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    masukan data type <code>{ "type" : "update" }</code> jika data ingin di update
                                    ketika data dikirim
                                </td>

                            </tr>

                            <tr>
                                <td colspan="2">
                                    masukan data session <code>{ "linen_outstanding_session" : "xxxx" }</code> jika ingin
                                    membuat sesi 1x scan
                                </td>
                            </tr>

                        </tbody>

                    </table>

                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col" colspan="3">Available fields</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(collect($model->getFillable())->chunk(3) as $fields)
                            <tr>
                                @foreach($fields as $field)
                                <td>
                                    <code>{{ $field }}</code>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @break

                    @case('master')


                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col">Mandatory</th>
                                <th scope="col">Validation</th>
                            </tr>
                        </thead>
                        <tbody>

                            <tr>
                                <td>
                                    <code>linen_master_outstanding_total</code>
                                </td>
                                <td>
                                    required
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <code>linen_master_outstanding_session</code>
                                </td>
                                <td>
                                    required and unique
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    masukan data session <code>{ "linen_master_outstanding_session" : "xxxx" }</code> <br> jika ingin
                                    membuat sesi 1x scan, dan di ikuti dengan masukan data session di detail outstanding pada saat save di api : <code>(https://optimus.local/api/linen_outstanding/create) </code>
                                </td>
                            </tr>

                        </tbody>

                    </table>

                    <table class="table table-bordered mt-3">
                        <thead>
                            <tr>
                                <th scope="col" colspan="3">Available fields</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(collect(Modules\Linen\Dao\Facades\MasterOutstandingFacades::getFillable())->chunk(3) as $fields)
                            <tr>
                                @foreach($fields as $field)
                                <td>
                                    <code>{{ $field }}</code>
                                </td>
                                @endforeach
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @break


                    @default
                    please contact admin for documentation
                    @endswitch

                </td>

                <td>
                    <button data-toggle="collapse" data-target="#collapse{{ $api->system_action_code }}"
                        class="btn btn-secondary btn-block btn-sm">
                        RESPONSE
                    </button>
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <div class="collapse" id="collapse{{ $api->system_action_code }}">
                        @switch($api->system_action_function)

                        @case('patch')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Response <code>[ Berhasil ]</code>
                                            </h4>
                                        </div>
                                        <div class="card-body">

                                            <pre><code>{{ json_encode(Notes::create($json), JSON_PRETTY_PRINT) }}</code></pre>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @break

                        @case('save')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Response <code>[ Berhasil ]</code>
                                            </h4>
                                        </div>
                                        <div class="card-body">

                                            <pre><code>{{ json_encode(Notes::create($json), JSON_PRETTY_PRINT) }}</code></pre>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @break

                        @case('master')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Response <code>[ Berhasil ]</code>
                                            </h4>
                                        </div>
                                        <div class="card-body">
                                            @php
                                            $getMaster = Modules\Linen\Dao\Facades\MasterOutstandingFacades::first();
                                            @endphp
                                            <pre><code>{{ json_encode(Notes::create($getMaster), JSON_PRETTY_PRINT) }}</code></pre>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @break

                        @case('update')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Response <code>[ Berhasil ]</code>
                                            </h4>
                                        </div>
                                        <div class="card-body">

                                            <pre><code>{{ json_encode(Notes::update($json), JSON_PRETTY_PRINT) }}</code></pre>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @break


                        @case('get')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Response <code>[ Berhasil ]</code>
                                            </h4>
                                        </div>
                                        <div class="card-body">

                                            <pre><code>{{ json_encode(Notes::single($json), JSON_PRETTY_PRINT) }}</code></pre>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @break

                        @case('delete')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Response <code>[ Single ]</code>
                                            </h4>
                                        </div>
                                        <div class="card-body">

                                            <pre><code>{{ json_encode(Notes::delete('example id'), JSON_PRETTY_PRINT) }}</code></pre>

                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Response <code>[ Multiple ]</code>
                                            </h4>
                                        </div>
                                        <div class="card-body">

                                            <pre><code>{{ json_encode(Notes::delete([1 => 'id 1', '2' => 'id 2']), JSON_PRETTY_PRINT) }}</code></pre>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @break


                        @case('update')
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Response <code>[ Berhasil ]</code>
                                            </h4>
                                        </div>
                                        <div class="card-body">

                                            <pre><code>{{ json_encode(Notes::update($json), JSON_PRETTY_PRINT) }}</code></pre>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @break

                        @case('data')
                        @php
                        $list = Helper::dataColumn($model->datatable);
                        $datatable = $model->dataRepository()->select($list);
                        @endphp
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Response <code>[ All Data ]</code>
                                            </h4>
                                        </div>
                                        <div class="card-body">

                                            <pre><code>{{ $model ? json_encode(Notes::update($datatable->limit(2)->get()->toArray()), JSON_PRETTY_PRINT) : '' }}</code></pre>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>
                                                Response <code>[ Pagination ]</code>
                                            </h4>
                                        </div>
                                        <div class="card-body">

                                            <pre><code>{{ $model ? json_encode(Notes::update($datatable->paginate(2)), JSON_PRETTY_PRINT) : '' }}</code></pre>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @break

                        @endswitch

                    </div>
                </td>
            </tr>
            @endforeach
            @endforeach
        </tbody>
    </table>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

</body>

</html>