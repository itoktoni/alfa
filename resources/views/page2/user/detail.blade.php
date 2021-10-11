@extends(Helper::setExtendBackend())
@section('content')
 {!! Form::model($model, ['route'=>[$form.'_update', 'code' => $model->$key],'class'=>'row form-horizontal','files'=>true]) !!} 
<div class="panel-body panel-group" id="accordion">
    <div class="panel panel-accordion">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1One">
                    Information
                </a>
            </h4>
        </div>
        <div id="collapse1One" class="accordion-body collapse in">
            <div class="panel-body line">
                <div class="col-md-12">
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
                        <label class="col-md-2 control-label">Group</label>
                        <div class="col-md-4">
                            <select class="form-control" id="group" name="group_user">
                                <option value="{{ $model->group_user }}" selected="selected">{{ $model->group_user }}</option>
                            </select>
                        </div>
                        <label class="col-md-2 control-label">Active</label>
                        <div class="col-md-4">
                            {!! Form::select('active', ['1' => 'Active', '0' => 'Not Active'], null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Username</label>
                        <div class="col-md-4 {{ $errors->has('username') ? 'has-error' : ''}}">
                            {!! Form::text('username', null, ['class' => 'form-control']) !!}
                            {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
                        </div>
                        <label class="col-md-2 control-label">Password</label>
                        <div class="col-md-4 {{ $errors->has('pwd') ? 'has-error' : ''}}">
                            {!! Form::password('pwd', ['class' => 'form-control']) !!}
                            {!! $errors->first('pwd', '<p class="help-block">:message</p>') !!}
                        </div>
                    </div>
               
                    <div class="form-group">
                        <label class="col-md-2 control-label">Team List</label>
                        <div class="col-md-10">
                            <select class="form-control input-sm mb-md" multiple id="team" name="team[]">
                                @foreach($detail as $d)
                                <option selected="" value="{{ $d->email }}">{{ $d->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-accordion">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#address">
                    Address
                </a>
            </h4>
        </div>
        <div id="address" class="accordion-body collapse">
            <div class="panel-body line">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::textarea('address',null,['class'=>'form-control', 'rows' => 2]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-accordion">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Two">
                    Description
                </a>
            </h4>
        </div>
        <div id="collapse1Two" class="accordion-body collapse">
            <div class="panel-body line">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Date</label>
                        <div class="col-md-4">
                            <div class="input-group">
                                {!! Form::text('birth', null,['data-plugin-datepicker', 'class' => 'form-control']) !!}
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                            </div>
                        </div>
                        <label class="col-md-2 control-label">Place</label>
                        <div class="col-md-4">
                            {!! Form::text('place_birth', null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Gender</label>
                        <div class="col-md-4">
                            {!! Form::select('gender', ['' => 'Not Assign', 'Male' => 'Male','Female' => 'Female'], null, ['class' => 'form-control']) !!}
                        </div>
                        <label class="col-md-2 control-label">Phone</label>
                        <div class="col-md-4">
                            {!! Form::text('handphone', null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">NPWP</label>
                        <div class="col-md-4">
                            {!! Form::text('no_tax', null,['class' => 'form-control']) !!}
                        </div>
                        <label class="col-md-2 control-label">NIK</label>
                        <div class="col-md-4">
                            {!! Form::text('nik', null,['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="panel panel-accordion">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapse1Four">
                    Note
                </a>
            </h4>
        </div>
        <div id="collapse1Four" class="accordion-body collapse">
            <div class="panel-body line">
                <div class="col-md-12">
                    <div class="form-group">
                        {!! Form::textarea('biografi',null,['class'=>'form-control', 'rows' => 3]) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{!! Form::close() !!}
@endsection