@push('javascript')
<script>
    // $('#company').change(function() {
    //     var id = $("#company option:selected").val();

    //     var uri = window.location.toString();
    //     var clean_uri = window.location.toString();
    //     if (uri.indexOf("?") > 0) {
    //         clean_uri = uri.substring(0, uri.indexOf("?"));
    //         window.history.replaceState({}, document.title, clean_uri);
    //     }

    //     window.location = clean_uri + '?company_id=' + id;
    // });

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
    @if(isset($master['lock_id']))
    <div class="col-md-4 col-sm-4 {{ $errors->has('company_id') ? 'has-error' : ''}}">
        {{ Form::select('', $company, $master['company_id'] ?? null, ['id' => 'company', 'class'=> 'form-control', 'disabled']) }}
        <input type="hidden" {{ $master['lock_id'] }} name="company_id">
        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
    </div>
    @else
    <div class="col-md-4 col-sm-4 {{ $errors->has('company_id') ? 'has-error' : ''}}">
        {{ Form::select('company_id', $company, $master['company_id'] ?? null, ['id' => 'company', 'class'=> 'form-control']) }}
        {!! $errors->first('company_id', '<p class="help-block">:message</p>') !!}
    </div>
    @endif

    {!! Form::label('name', __('Location'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('location_id') ? 'has-error' : ''}}">
        {{ Form::select('location_id', $location, null, ['class'=> 'form-control', ]) }}
        {!! $errors->first('location_id', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">

    {!! Form::label('name', __('Product'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    @if(isset($master['item_product_id']))
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_product_id') ? 'has-error' : ''}}">
        {{ Form::select('', $product, $master['item_product_id'] ?? null, ['class'=> 'form-control', 'disabled']) }}
        <input type="hidden" {{ $master['item_product_id'] }} name="item_product_id">
        {!! $errors->first('item_product_id', '<p class="help-block">:message</p>') !!}
    </div>
    @else
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_product_id') ? 'has-error' : ''}}">
        {{ Form::select('item_product_id', $product, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_product_id', '<p class="help-block">:message</p>') !!}
    </div>
    @endif

    {!! Form::label('name', __('Size'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('company_item_size_id') ? 'has-error' : ''}}">
        {{ Form::select('company_item_size_id', $size, null, ['class'=> 'form-control', ]) }}
        {!! $errors->first('company_item_size_id', '<p class="help-block">:message</p>') !!}
    </div>



</div>

<!-- <div class="form-group">

    {!! Form::label('name', __('Minimal'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('company_item_minimal') ? 'has-error' : ''}}">
        {!! Form::text('company_item_minimal', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_item_minimal', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Maximal'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('company_item_maximal') ? 'has-error' : ''}}">
        {!! Form::text('company_item_maximal', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_item_maximal', '<p class="help-block">:message</p>') !!}
    </div>

</div> -->


<div class="form-group">

{!! Form::label('name', __('Weight'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('company_item_weight') ? 'has-error' : ''}}">
        {!! Form::text('company_item_weight', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_item_weight', '<p class="help-block">:message</p>') !!}
    </div>

{!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4">
        {!! Form::textarea('company_item_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>
<!--
    {!! Form::label('name', __('Unit'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('company_item_unit_id') ? 'has-error' : ''}}">
        {{ Form::select('company_item_unit_id', $unit, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('company_item_unit_id', '<p class="help-block">:message</p>') !!}
    </div> -->

</div>

<hr>

<div class="form-group">

    {!! Form::label('name', __('Parstok'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('company_item_target') ? 'has-error' : ''}}">
        {!! Form::text('company_item_target', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_item_target', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Realisasi'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('company_item_realisasi') ? 'has-error' : ''}}">
        {!! Form::text('company_item_realisasi', null, ['class' => 'form-control', 'readonly']) !!}
        {!! $errors->first('company_item_realisasi', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">
    @php
    $kekurangan = '';
    if(isset($model)){
        $kekurangan = $model->company_item_target - $model->company_item_realisasi;
    }
    @endphp

    @if(isset($model))
    <input type="hidden" name="old_product_id" value="{{ $model->item_product_id }}">
    <input type="hidden" name="old_company_id" value="{{ $model->company_id }}">
    @endif

    {!! Form::label('name', __('Kekurangan'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('company_item_kekurangan') ? 'has-error' : ''}}">
        {!! Form::text('company_item_kekurangan', $kekurangan, ['class' => 'form-control', 'disabled']) !!}
        {!! $errors->first('company_item_kekurangan', '<p class="help-block">:message</p>') !!}
    </div>


    {!! Form::label('name', __('Price'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('company_item_price') ? 'has-error' : ''}}">
        {!! Form::text('company_item_price', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_item_price', '<p class="help-block">:message</p>') !!}
    </div>
</div>
