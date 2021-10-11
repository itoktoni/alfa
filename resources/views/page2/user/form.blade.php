<div class="form-group">
    <label class="col-md-2 control-label">Name</label>
    <div class="col-md-4 {{ $errors->has('name') ? 'has-error' : ''}}">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
        {!! $errors->first('name', '<p class="help-block">:message</p>') !!}
    </div>

    <label class="col-md-2 control-label">Email</label>
    <div class="col-md-4 {{ $errors->has('email') ? 'has-error' : ''}}">
        {!! Form::email('email', null, ['class' => 'form-control']) !!}
        {!! $errors->first('email', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Username</label>
    <div class="col-md-4 {{ $errors->has('username') ? 'has-error' : ''}}">
        {!! Form::text('username', null, ['class' => 'form-control', 'autocomplete' => false]) !!}
        {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
    </div>

    <label class="col-md-2 control-label">Password</label>
    <div class="col-md-4 {{ $errors->has('password') ? 'has-error' : ''}}">
        {!! Form::password('password', ['class' => 'form-control','autocomplete' => false]) !!}
        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
    </div>
</div>

<div class="form-group">
    <label class="col-md-2 control-label">Group</label>
    <div class="col-md-4 {{ $errors->has('group_user') ? 'has-error' : ''}}">
        {{ Form::select('group_user', $group, null, ['class'=> 'form-control', 'data-plugin-selectTwo']) }}
    </div>

    <label class="col-md-2 control-label">Active</label>
    <div class="col-md-4 {{ $errors->has('active') ? 'has-error' : ''}}">
        {{ Form::select('active', $status, null, ['class'=> 'form-control']) }}
    </div>
</div>