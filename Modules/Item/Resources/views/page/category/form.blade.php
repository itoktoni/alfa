<div class="form-group">

    {!! Form::label('name', __('Name'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_category_name') ? 'has-error' : ''}}">
        {!! Form::text('item_category_name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('item_category_name', '<p class="help-block">:message</p>') !!}
    </div>

    {!! Form::label('name', __('Active'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-4 col-sm-4 {{ $errors->has('item_category_status') ? 'has-error' : ''}}">
        {{ Form::select('item_category_status', ['0' => 'No', '1' => 'Yes'], null, ['class'=> 'form-control ']) }}
        {!! $errors->first('item_category_status', '<p class="help-block">:message</p>') !!}
    </div>

</div>

<div class="form-group">
    {!! Form::label('name', __('Description'), ['class' => 'col-md-2 col-sm-2 control-label']) !!}
    <div class="col-md-10 col-sm-10">
        {!! Form::textarea('item_category_description', null, ['class' => 'form-control', 'rows' => '3']) !!}
    </div>
</div>