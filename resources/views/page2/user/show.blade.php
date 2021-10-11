@extends(Helper::setExtendBackend())

@section('content')
<div class="row">
    <div class="panel panel-default">
        <header class="panel-heading">
            <h2 class="panel-title">Show Name : {{ ucfirst($data->name) }}</h2>
        </header>

        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-table table-bordered table-striped table-hover mb-none">
                    <tbody>

                        @foreach($fields as $item => $value)
                        <tr>
                            <th class="col-lg-2">{{ $value }}</th>
                            <td>{{ $data->$item }}</td>
                        </tr>
                        @endforeach
                        <tr>
                            <td colspan="2"></td>
                        </tr>
                        @foreach($detail as $c)
                        <tr>
                            <td class="col-lg-2">{{ $c->group_user }}</td>
                            <th>{{ $c->name }}</th>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
        <div class="navbar-fixed-bottom" id="menu_action">
            <div class="text-right" style="padding:5px">
                <a href="{!! route("{$form}_list") !!}" class="btn btn-warning">Back</a>
                @isset($update)
                <a href="{!! route("{$template}_update", ["code" => $data->$key]) !!}" class="btn btn-primary">Edit</a>
                @endisset
            </div>
        </div>
                
    </div>
</div>

@endsection