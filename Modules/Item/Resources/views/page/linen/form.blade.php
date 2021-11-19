@push('javascript')
<script>
    $('#company').change(function() {
        var id = $("#company option:selected").val();

        var uri = window.location.toString();
        var clean_uri = window.location.toString();
        if (uri.indexOf("?") > 0) {
            clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
        }

        window.location = clean_uri + '?company_id=' + id;
    });

    $('#status').change(function() {
        var id = $("#status option:selected").val();

        var uri = window.location.toString();
        var clean_uri = window.location.toString();
        if (uri.indexOf("&") > 0) {
            clean_uri = uri.substring(0, uri.indexOf("&"));
            window.history.replaceState({}, document.title, clean_uri);
        }

        window.location = clean_uri + '&status=' + id;

    });
</script>
@endpush

<div class="form-group">

    {!! Form::label('name', __('Company'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_company_id') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_company_id', $company, request()->get('company_id') ?? null, ['class'=> 'form-control', 'id' => 'company']) }}
        {!! $errors->first('item_linen_company_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Location'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_location_id') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_location_id', $location, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_location_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<hr>

<div class="form-group">

    {!! Form::label('name', __('Product'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_product_id') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_product_id', $product, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_product_id', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('No. Seri RFID'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_rfid') ? 'has-error' : ''}}">
        {!! Form::text('item_linen_rfid', null, ['class' => 'form-control']) !!}
        {!! $errors->first('item_linen_rfid', '<p class="help-block">:message</p>') !!}
    </div>

</div>


<div class="form-group">

    {!! Form::label('name', __('Status'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_status') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_status', $status, request()->get('status') ?? null, ['id' => 'status', 'class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_status', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Sewa'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_rent') ? 'has-error' : ''}}">
        {{ Form::select('item_linen_rent', $rent, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_linen_rent', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">
    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        {!! Form::textarea('item_linen_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>
    
    @if(request()->get('status') == LinenStatus::GantiChip)
    {!! Form::label('name', __('No. Seri RFID Lama'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_linen_rfid_old') ? 'has-error' : ''}}">
        {!! Form::text('item_linen_rfid_old', $model->item_linen_rfid, ['class' => 'form-control', 'readonly']) !!}
        {!! $errors->first('item_linen_rfid_old', '<p class="help-block">:message</p>') !!}
    </div>
    @endif

</div>