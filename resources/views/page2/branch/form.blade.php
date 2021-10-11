<x-area :selector="['area']" />

<div class="form-group">

    {!! Form::label('name', 'Name', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('branch_name') ? 'has-error' : ''}}">
        {!! Form::text('branch_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('branch_name', '<p class="help-block">:message</p>') !!}
    </div>


    {!! Form::label('name', 'Company', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('company') ? 'has-error' : ''}}">
        {{ Form::select('branch_company_id', $company, null, ['class'=> 'form-control ']) }}
        {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', 'Email', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('branch_email') ? 'has-error' : ''}}">
        {!! Form::text('branch_email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('branch_email', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', 'Phone', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-4 {{ $errors->has('branch_phone') ? 'has-error' : ''}}">
        {!! Form::text('branch_phone', null, ['class' => 'form-control']) !!}
        {!! $errors->first('branch_phone', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', 'Contact Address', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10 {{ $errors->has('branch_address') ? 'has-error' : ''}}">
        {!! Form::textarea('branch_address', null, ['class' => 'form-control', 'rows' => '3']) !!}
        {!! $errors->first('branch_address', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    {!! Form::label('name', 'Area', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10 {{ $errors->has('branch_rajaongkir_area_id') ? 'has-error' : ''}}">
        <div class="input-group">
            <span class="input-group-btn">
                <button class="btn btn-primary area" type="button">Contact</button>
                <input type="hidden" name="area" value="{{ old('area') ?? '' }}">
            </span>
            {{ Form::select('branch_rajaongkir_area_id', old('area') ? [old('branch_rajaongkir_area_id') => old('area')] : $area, null, ['class'=> 'form-control select', 'id' => 'area']) }}
            {!! $errors->first('branch_rajaongkir_area_id', '<p class="help-block">:message</p>') !!}
        </div>
    </div>
</div>

<div class="form-group">

    {!! Form::label('name', 'Description', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('branch_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>

</div>

<hr>

<div class="form-group">

    {!! Form::label('name', 'Maps Google', ['class' => 'col-md-2 control-label']) !!}
    <div class="col-md-10">
        {!! Form::textarea('branch_map', null, ['class' => 'form-control', 'rows' => '7']) !!}
    </div>

</div>

<div class="modal fade" id="ModalArea" role="dialog">
    <div class="modal-dialog">
        <div id="popup" class="modal-content">
        </div>
    </div>
</div>