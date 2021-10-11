@extends(Helper::setExtendBackend())
@component('components.datatables',['array' => $fields])
   
@endcomponent
@section('content')
<div class="row">
    <div class="panel-body">

        {!! Form::open(['route' => $form.'_list', 'id' => 'search-form', 'files' => true]) !!}
        <div class="form-inline panel">
            <select name="code" class="form-control">
                <option value="">Item Data</option>
                @foreach($fields as $item => $value)
                    <option value="{{ $item }}">{{ $value }}</option>
                @endforeach
            </select>

            <select name="aggregate" class="form-control">
                <option value="">Aggregate</option>
                <option value="=">Equals</option>
                <option value="!=">Not Equals</option>
                <option value="like">Contains</option>
                <option value="not like">Not Contains</option>
                <option value=">">Greater Than</option>
                <option value="<">Less Than</option>
            </select>

            <div class="input-group">
                <input name="search" class="form-control" placeholder="Advance Search" type="text">
                <span class="input-group-btn">
                    <button type="submit" class="btn btn-primary">Search</button>
                </span>
            </div>

        </div>
        <div class="clearfix"></div>

        {!! Form::close() !!}

        {!! Form::open(['route' => $form.'_delete', 'id' => '', 'files' => true]) !!}  
        <header class="panel-heading">
            <h2 class="panel-title text-right">
                List {{ ucwords(str_replace('_',' ',$template)) }}
            </h2>
        </header>

        <div class="panel-body">
            <div class="">
                <div class="table-responsive">
                    <table id="datatable" class="table table-bordered table-condensed table-striped table-hover">
                        <thead>
                            <tr>
                                @foreach($fields as $item => $value)
                                <td {{ $item == 'active' ? 'id=status' : '' }}>
                                    <strong>{{ $value }}</strong>
                                </td>
                                @endforeach
                                <th width="3" class="center"><input type="checkbox" id="checkAll" onClick="toggle(this)" class="selectall"/></th>
                                <td style="width: {{ session('button') * config('website.button') }}px;" class="text-center">
                                    <strong>Actions</strong>
                                </td>
                            </tr>
                        </thead>
                    </table>
                </diV>
            </div>
        </div>

        <div class="navbar-fixed-bottom" id="menu_action">
            <div class="text-right" style="padding:5px">
                @isset($create)
                <a href="{!! route("{$form}_create") !!}" class="btn btn-success">Create</a>
                @endisset
                @isset($delete)
                <button type="submit" value="delete" class="btn btn-danger">Delete</button>
                @endisset
            </div>
        </div>

        {!! Form::close() !!}

    </div>
</div>

@endsection