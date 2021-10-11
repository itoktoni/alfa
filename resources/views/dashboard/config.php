@extends('backend.'.config('website.backend').'.layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('public/assets/vendor/jquery-ui/css/jquery-ui.min.css') }}">
<link rel="stylesheet" href="{{ asset('public/assets/vendor/select/select2.css') }}">
@endsection

@section('js')
<script src="{{ asset('public/assets/vendor/jquery-ui/js/jquery-ui.min.js') }}"></script>
<script src="{{ asset('public/assets/vendor/select/select2.min.js') }}"></script>
@endsection

@section('javascript')

<script>

$(function() {
    $("#datepicker").datepicker({
        dateFormat: 'yy-mm-dd'
    });

    $('#site').select2({
        placeholder: 'Select an site',
        ajax: {
            url: '{{ route("site_all") }}',
            dataType: 'json',
            data: function(params) {
                return {
                    q: params.term, // search term
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });

    $('#group').select2({
        placeholder: 'Select an group',
        ajax: {
            url: '{{ route("group_all") }}',
            dataType: 'json',
            data: function(params) {
                return {
                    q: params.term, // search term
                };
            },
            processResults: function(data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });



});
</script>

@endsection

@section('content')

<div class="row">
    {!! Form::open(['route' => 'team_create', 'class' => 'form-horizontal', 'files' => true]) !!}  
    <div class="panel panel-default" style="margin-bottom: 300px;">
        <header class="panel-heading">
            <div class="btn-group pull-right">
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
            <h2 class="panel-title">Create Users</h2>
        </header>

        <div class="panel-body">
            <div class="col-md-12">
                <div class="form-group">                                          
                    <label class="col-md-2 control-label">NIK</label>
                    <div class="col-md-4 {{ $errors->has('nik') ? 'has-error' : ''}}">
                        {!! Form::text('nik', $code,['class' => 'form-control']) !!}
                        {!! $errors->first('nik', '<p class="help-block">:message</p>') !!}
                    </div>

                    <label class="col-md-2 control-label">NPWP</label>
                    <div class="col-md-4">
                        {!! Form::text('no_tax', null,['class' => 'form-control']) !!}
                    </div>

                </div>

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
                        {!! Form::text('username', null, ['class' => 'form-control']) !!}
                        {!! $errors->first('username', '<p class="help-block">:message</p>') !!}
                    </div>

                    <label class="col-md-2 control-label">Password</label>
                    <div class="col-md-4 {{ $errors->has('password') ? 'has-error' : ''}}">
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                        {!! $errors->first('password', '<p class="help-block">:message</p>') !!}
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-2 control-label">Site</label>
                    <div class="col-md-4">
                        <select class="form-control" id="site" name="site_id">
                            <option value="">Choose Select</option>
                        </select>
                    </div>

                    <label class="col-md-2 control-label">Group</label>
                    <div class="col-md-4">
                        <select class="form-control" id="group" name="group_user">
                            <option value="">Choose Select</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
@endsection


