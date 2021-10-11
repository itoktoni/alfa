@php
use Illuminate\Support\Arr;
@endphp

<!DOCTYPE html>
<html>

<head>
    <title>Routes list</title>
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

    <h1 class="display-4">Routes ({{ count($routes) }})</h1>
    <a style="position:fixed;top:0px;right:0px;" class="btn btn-primary" href="{{ route('home') }}">Go Home</a>

    <table class="table table-sm table-bordered">
        <thead>
            <tr>
                <th style="width: 30%;">End Point</th>
                <th style="width: 20px;">Methods</th>
                <th>Request</th>
                <th style="width: 30px;" class="text-center">Readme</th>
            </tr>
        </thead>
        <tbody>

            <?php $methodColours = ['GET' => 'success', 'HEAD' => 'default', 'POST' => 'primary', 'PUT' => 'warning', 'PATCH' => 'info', 'DELETE' => 'danger']; ?>
            @foreach ($routes as $key => $group)
            <tr>
                <td colspan="4">
                    <h2>
                        {{ Str::of($key)->kebab()->replace('-',' ')->title() }}
                    </h2>
                </td>
            </tr>
            @foreach($group as $api)
            @php
            $code = in_array($api->system_action_function, ['update', 'get']) ? '/{code}' : '';
            @endphp
            <tr>
                <td>
                    {{ url('/api/').'/'.$api->system_action_link }}<span
                        class="text-danger"><strong>{{ $code }}</strong></span>
                </td>
                <td>
                    <span class="btn btn-sm btn-block btn-{{ Arr::get($methodColours, $api->system_action_method) }}">
                        {{ $api->system_action_method }}
                    </span>
                </td>
                <td>
                    <ul>
                        <li>Code</li>
                        <li>Name</li>
                    </ul>
                </td>

                <td>
                    <button data-toggle="collapse" data-target="#collapse{{ $loop->index }}"
                        class="btn btn-secondary btn-block btn-sm">SHOW</button>
                </td>
            </tr>
            <tr>
                <td colspan="7">
                    <div class="collapse" id="collapse{{ $loop->index }}">
                        <div class="card">
                            <div class="card-header">
                                Featured
                            </div>
                            <div class="card-body">
                                This is some text within a card body.
                            </div>
                        </div>
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