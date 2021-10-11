@extends(Helper::setExtendPopup())
@component('components.responsive', ['array' => $fields])
@endcomponent
@component('components.datatableslite',['array' => $fields])@endcomponent
@section('content')
<div class="row">
    <div class="panel-body">

        {!! Form::open(['route' => $action_code, 'id' => 'search-form', 'files' => true]) !!}
        <div id="action-master" class="panel">
            <div class="">
                <div class="col-md-3">
                    <div class="row">
                        <select name="code" class="form-control">
                            <option value="">Search By</option>
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
        {!! Form::close() !!}

        <div class="table-control" style="margin:15px">
            <input type="hidden" id="data" value="{{ request()->get('selector') }}" name="">
            <table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
                <thead>
                    <tr>
                        @foreach($fields as $item => $value)
                        <th><strong>{{ $value }}</strong></th>
                        @endforeach
                        <th style="width: 50px !important;text-align:center !important">
                            <strong>Actions</strong>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>

<script>
function setID(id, data) {
    var selector = $('#data').val();
    var select = $('#'+selector);
    select.empty();
    select.append('<option value="' + id + '">' + data + '</option>');
    select.val(id);

    $("input[name='"+selector+"']").remove();
    $('<input type="hidden" name="'+selector+'" value="'+data+'">').insertAfter('.'+selector);
    $('#ModalArea').modal('hide');
}
</script>