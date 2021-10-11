<x-area :selector="['area_contact']" />
<x-area :selector="['area_delivery']" />
<x-area :selector="['area_invoice']" />

<header class="panel-heading mb-sm">
    <h2 class="panel-title text-right">Contact Information</h2>
</header>

<div class="form-group">
    {!! Form::label('name', 'Company Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_contact_name') ? 'has-error' : ''}}">
        {!! Form::text('company_contact_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_contact_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Contact Person', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_contact_person') ? 'has-error' : ''}}">
        {!! Form::text('company_contact_person', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_contact_person', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('name', 'Contact Email', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_contact_email') ? 'has-error' : ''}}">
        {!! Form::text('company_contact_email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_contact_email', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Contact Phone', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_contact_phone') ? 'has-error' : ''}}">
        {!! Form::text('company_contact_phone', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_contact_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">

    {!! Form::label('name', 'Logo', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-3 {{ $errors->has('logo_contact') ? 'has-error' : ''}}">
        <input type="hidden" value="{{ $model->company_logo ?? null }}" name="company_logo">
        <input type="file" name="logo_contact"
            class="{{ $errors->has('logo_contact') ? 'has-error' : ''}} btn btn-default btn-sm btn-block">
        {!! $errors->first('logo_contact', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-1">
        <img class="img-responsive img-fluid"
            src="{{ isset($model) ? Helper::files('company/'.$model->company_logo) : '' }}" alt="">
    </div>

    {!! Form::label('name', 'Tanda Tangan', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-3 {{ $errors->has('sign_contact') ? 'has-error' : ''}}">
        <input type="hidden" value="{{ $model->company_contact_sign ?? null }}" name="company_contact_sign">
        <input type="file" name="sign_contact"
            class="{{ $errors->has('sign_contact') ? 'has-error' : ''}} btn btn-default btn-sm btn-block">
        {!! $errors->first('sign_contact', '<p class="help-block">:message</p>') !!}
    </div>
    <div class="col-md-1">
        <img class="img-responsive img-fluid"
            src="{{ isset($model) ? Helper::files('company/'.$model->company_contact_sign) : '' }}" alt="">
    </div>

</div>
<div class="form-group">
    {!! Form::label('name', 'Contact Address', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_contact_address') ? 'has-error' : ''}}">
        {!! Form::textarea('company_contact_address', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('company_contact_address', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_contact_description') ? 'has-error' : ''}}">
        {!! Form::textarea('company_contact_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('company_contact_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('name', 'Contact Area', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10 {{ $errors->has('company_contact_rajaongkir_area_id') ? 'has-error' : ''}}">
        <div class="input-group">
            <span class="input-group-btn">
                <button class="btn btn-primary area_contact" type="button">Contact</button>
                <input type="hidden" name="area_contact" value="{{ old('area_contact') ?? '' }}">
            </span>
            {{ Form::select('company_contact_rajaongkir_area_id', old('area_contact') ? [old('company_contact_rajaongkir_area_id') => old('area_contact')] : $area_contact, null, ['class'=> 'form-control select', 'id' => 'area_contact']) }}
            {!! $errors->first('company_contact_rajaongkir_area_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>


<header class="panel-heading mb-sm">
    <h2 class="panel-title text-right">Delivery Information</h2>
</header>
<hr>


<div class="form-group">
    {!! Form::label('name', 'Delivery Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_delivery_name') ? 'has-error' : ''}}">
        {!! Form::text('company_delivery_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_delivery_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Delivery Person', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_delivery_person') ? 'has-error' : ''}}">
        {!! Form::text('company_delivery_person', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_delivery_person', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('name', 'Delivery Email', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_delivery_email') ? 'has-error' : ''}}">
        {!! Form::text('company_delivery_email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_delivery_email', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Delivery Phone', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_delivery_phone') ? 'has-error' : ''}}">
        {!! Form::text('company_delivery_phone', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_delivery_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', 'Delivery Address', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_delivery_address') ? 'has-error' : ''}}">
        {!! Form::textarea('company_delivery_address', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('company_delivery_address', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_delivery_description') ? 'has-error' : ''}}">
        {!! Form::textarea('company_delivery_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('company_delivery_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('name', 'Delivery Area', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10 {{ $errors->has('company_delivery_rajaongkir_area_id') ? 'has-error' : ''}}">
        <div class="input-group">
            <span class="input-group-btn">
                <button class="btn btn-primary area_delivery" type="button">Delivery</button>
                <input type="hidden" name="area_delivery" value="{{ old('area_delivery') ?? '' }}">
            </span>
            {{ Form::select('company_delivery_rajaongkir_area_id', old('area_delivery') ? [old('company_delivery_rajaongkir_area_id') => old('area_delivery')] : $area_delivery, null, ['class'=> 'form-control select', 'id' => 'area_delivery']) }}
            {!! $errors->first('company_delivery_rajaongkir_area_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>


<header class="panel-heading mb-sm">
    <h2 class="panel-title text-right">Invoice Information</h2>
</header>

<hr>

<div class="form-group">
    {!! Form::label('name', 'Invoice Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_invoice_name') ? 'has-error' : ''}}">
        {!! Form::text('company_invoice_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_invoice_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Invoice Person', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_invoice_person') ? 'has-error' : ''}}">
        {!! Form::text('company_invoice_person', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_invoice_person', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('name', 'Invoice Email', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_invoice_email') ? 'has-error' : ''}}">
        {!! Form::text('company_invoice_email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_invoice_email', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Invoice Phone', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_invoice_phone') ? 'has-error' : ''}}">
        {!! Form::text('company_invoice_phone', null, ['class' => 'form-control']) !!}
        {!! $errors->first('company_invoice_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', 'Invoice Address', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_invoice_address') ? 'has-error' : ''}}">
        {!! Form::textarea('company_invoice_address', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('company_invoice_address', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company_invoice_description') ? 'has-error' : ''}}">
        {!! Form::textarea('company_invoice_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('company_invoice_description', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">

    {!! Form::label('name', 'Invoice Area', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10 {{ $errors->has('company_invoice_rajaongkir_area_id') ? 'has-error' : ''}}">
        <div class="input-group">
            <span class="input-group-btn">
                <button class="btn btn-primary area_invoice" type="button">Invoice</button>
                <input type="hidden" name="area_invoice" value="{{ old('area_invoice') ?? '' }}">
            </span>
            {{ Form::select('company_invoice_rajaongkir_area_id', old('area_invoice') ? [old('company_invoice_rajaongkir_area_id') => old('area_invoice')] : $area_invoice, null, ['class'=> 'form-control select', 'id' => 'area_invoice']) }}
            {!! $errors->first('company_invoice_rajaongkir_area_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>