<div class="form-group">
    <label class="col-md-2 control-label">{{ __('Name') }}</label>
    <div class="col-md-4 {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>

    <label class="col-md-2 control-label">{{ __('Email') }}</label>
    <div class="col-md-4 {{ $errors->has('email') ? 'has-error' : ''}}">
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">{{ __('Username') }}</label>
    <div class="col-md-4 {{ $errors->has('username') ? 'has-error' : ''}}">
        {!! Form::text('username', null, ['class' => 'form-control', 'autocomplete' => false]) !!}
        {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
    </div>

    <label class="col-md-2 control-label">{{ __('Password') }}</label>
    <div class="col-md-4 {{ $errors->has('password') ? 'has-error' : ''}}">
        {!! Form::password('password', ['class' => 'form-control','autocomplete' => false]) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>
<div class="form-group">
    <label class="col-md-2 control-label">{{ __('Group') }}</label>
    <div class="col-md-4 {{ $errors->has('group_user') ? 'has-error' : ''}}">
        {{ Form::select('group_user', $group, null, ['class'=> 'form-control']) }}
        {!! $errors->first('group_user', '<p class="help-block">:message</p>') !!}
    </div>

    <label class="col-md-2 control-label">{{ __('Active') }}</label>
    <div class="col-md-4 {{ $errors->has('active') ? 'has-error' : ''}}">
        {{ Form::select('active', $status, null, ['class'=> 'form-control']) }}
    </div>
</div>
<div class="form-group">

    <label class="col-md-2 control-label">{{ __('Holding') }}</label>
    <div class="col-md-4 {{ $errors->has('holding') ? 'has-error' : ''}}">
        {{ Form::select('holding', $holding, null, ['class'=> 'form-control']) }}
        {!! $errors->first('holding', '<p class="help-block">:message</p>') !!}
    </div>

    <label class="col-md-2 control-label">{{ __('Company') }}</label>
    <div class="col-md-4 {{ $errors->has('company') ? 'has-error' : ''}}">
        {{ Form::select('company', $company, null, ['class'=> 'form-control']) }}
        {!! $errors->first('company', '<p class="help-block">:message</p>') !!}
    </div>

</div>