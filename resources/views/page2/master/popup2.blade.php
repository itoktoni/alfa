@extends(Helper::setExtendPopup())
@component('components.responsive', ['array' => $fields])
@endcomponent
@component('components.datatableslite',['array' => $fields])@endcomponent
@section('content')
<div class="row">
    <div class="panel-body" style="margin-bottom: -100px;">
        {!! Form::open(['route' => $action_code, 'id' => 'search-form', 'files' => true]) !!}
        <div id="action-master" style="padding-left: 25px;" class="form-inline panel">
            <div class="row">
                <div class="col-md-3">
                    <div class="row">
                        <select name="code" class="form-control">
                            <option value="">Spesific Search</option>
                            @foreach($fields as $item => $value)
                            <option value="{{ $item }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <select name="aggregate" class="form-control">
                            <option value="">Aggregate</option>
                            <option value="=">Equals</option>
                            <option value="!=">Not Equals</option>
                            <option value="like">Contains</option>
                            <option value="not like">Not Contains</option>
                            <option value=">">Greater Than</option>
                            <option value="<">Less Than</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="input-group">
                            <input autofocus name="search" class="form-control" placeholder="Advance Search"
                                type="text">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary">Search</button>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix"></div>
        {!! Form::close() !!}
        {!! Form::open(['route' => $module.'_delete', 'id' => '', 'files' => true]) !!}


        <div class="line">
            <div class="table-control">
                <div>
                    <table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
                        <thead>
                            <tr>
                                @php
                                $status = [
                                'Images',
                                'Active',
                                'Default',
                                'Status',
                                'Paid',
                                'Visible',
                                'Homepage',
                                'Total',
                                ];
                                $sort = [
                                'Sort',
                                'Qty',
                                'Size',
                                ];
                                @endphp
                                @foreach($fields as $item => $value)<th {!! strpos($value, 'Description' ) !==false
                                    ? ' id="description"' : '' !!} {!! in_array($value, $sort) ? ' id="sort"' : '' !!}
                                    {!! $value=='Type' ? ' id="type"' : '' !!} {!! $value=='Ongkir' ? ' id="ongkir"'
                                    : '' !!} {!! $value=='Full Name' ? ' id="fullname"' : '' !!} {!! in_array($value,
                                    $status) ? ' id="status"' : '' !!}>
                                    <strong>{{ $value }}</strong></th>
                                @endforeach
                                @php
                                $button = '100';
                                if(session()->has('button')){
                                $button = session('button') > 4 ? '150' : '100';
                                }
                                @endphp
                                <th style="width: {{ $button }}px !important;" class="text-center">
                                    @if($action->count() > 0 ) <strong>Actions</strong> @endif</th>
                            </tr>
                        </thead>
                    </table>
                </diV>
            </div>
        </div>
        {!! Form::close() !!}
    </div>
</div>

<script>
function setID(id, data) {
    var area = $('#area');
    area.empty();
    area.append('<option value=""></option>');
    area.append('<option value="' + id + '">' + data.name + '</option>');
    area.trigger("chosen:updated");
    $('#empModal').modal('hide');
}
</script>