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

    table.hide-domains .domain {
        display: none;
    }
    </style>
</head>

<body>

    <h1 class="display-4">Routes ({{ count($routes) }})</h1>
    <a style="position:fixed;top:0px;right:0px;" class="btn btn-primary" href="{{ route('home') }}">Go Home</a>

    <table class="table table-sm table-bordered table-hover" style="visibility: hidden;">
        <thead>
            <tr>
                <th>Methods</th>
                <th class="domain">Domain</th>
                <th>End Point</th>
                <th>Name</th>
                <th>Action</th>
                <th>Middleware</th>
                <!-- <th class="text-center">Readme</th> -->
            </tr>
        </thead>
        <tbody>

            <?php $methodColours = ['GET' => 'success', 'HEAD' => 'default', 'POST' => 'primary', 'PUT' => 'warning', 'PATCH' => 'info', 'DELETE' => 'danger']; ?>
            @foreach ($routes as $route)
            <tr>
                <td>
                    @foreach (array_diff($route->methods(), config('pretty-routes.hide_methods')) as $method)
                    <span class="btn btn-sm btn-block btn-{{ Arr::get($methodColours, $method) }}">{{ $method }}</span>
                    @endforeach
                </td>
                <td class="domain{{ strlen($route->domain()) == 0 ? ' domain-empty' : '' }}">{{ $route->domain() }}</td>
                <td>{{ url('/') }}/{!! preg_replace('#({[^}]+})#', '<span class="text-warning">$1</span>',
                    $route->uri()) !!}</td>
                <td>{{ $route->getName() }}</td>
                <td>{!! preg_replace('#(@.*)$#', '<span class="text-warning">$1</span>', $route->getActionName()) !!}
                </td>
                <td>
                    {{ implode(', ', $route->middleware()) }}
                </td>
                <!-- <td>
                    <button data-toggle="collapse" data-target="#collapse{{ $loop->index }}"
                        class="btn btn-secondary btn-block btn-sm">SHOW</button>
                </td> -->
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

    <script type="text/javascript">
    function hideEmptyDomainColumn() {
        var table = document.querySelector('.table');
        var domains = table.querySelectorAll('tbody .domain');
        var emptyDomains = table.querySelectorAll('tbody .domain-empty');
        if (domains.length == emptyDomains.length) {
            table.className += ' hide-domains';
        }

        table.style.visibility = 'visible';
    }

    hideEmptyDomainColumn();
    </script>

</body>

</html>