@extends('auth.credential')
@section('content')
<div class="auth-box">

    <div class="login-box">

        <div class="login-logo" data-aos="fade-up" data-aos-duration="300">
            <a href="http://accufy.kontrakin.com/">
                <img class="circles" src="{{ Helper::files('logo/'.config('website.logo')) }}" style="height: 45px;margin-left: 0px;cursor:pointer" alt="{{ config('app.name') }}" />
            </a>
            <br>
        </div>

        <div class="mb-4 mt-4">

            @if ($errors->any())
            @foreach ($errors->all() as $error)
            @if ($loop->first)
            <span class="help-block text-danger text-left">
                <strong>{{ $error }}</strong><br>
            </span>
            <div class="error text-danger" style="display: none;">{{ $error }}</div>
            @endif
            @endforeach
            @endif

            <div class="success text-success"></div>
            <div class="warning text-warning"></div>
        </div>

        <!-- /.login-logo -->
        <div style="padding-bottom: 50px;" id="login-area" class="login-box-body" data-aos="fade-up" data-aos-duration="400">
            <p class="login-box-msg">Sign in</p>

            {!! Form::open(['class' => 'form login', 'id' => 'login-form']) !!}

            <div class="form-group has-feedback">
                {!! Form::text('login', null, ['autofocus', 'class' => 'form-control log','id' => 'login__email', 'placeholder' =>
                __('Username or Email')]) !!}
                <span class="ion ion-email form-control-feedback"></span>
            </div>

            <div class="form-group has-feedback">
                {!! Form::password('password', ['class' => 'form-control log', 'id' => 'login__password','placeholder' =>
                __('Secure Password')]) !!}
                <span class="ion ion-locked form-control-feedback"></span>
                <a class="pull-right forgot_pass" href="{{ route('password.request') }}">{{ __('Forgot Password') }}</a>
            </div>

            <div class="row">
                <!-- csrf token -->
                <div class="col-12 text-center">
                    <input id="submit" class="btn btn-info btn-block signin_btn" type="submit" value="{{ __('Sign in') }}">
                    <a class="create" href="{{ route('register') }}">Create Account</a>
                </div>
            </div>

            {!! Form::close() !!}
            <!-- /.social-auth-links -->

        </div>
        <!-- /.login-box-body -->


        <!-- forgot area -->
        <div id="forgot-area" class="login-box-body" style="display: none;">
            <p class="login-box-msg">Recover password</p>

            <form id="lost-form" method="post" action="http://accufy.kontrakin.com/auth/forgot_password">

                <div class="form-group has-feedback">
                    <input type="email" name="email" class="form-control log" placeholder="Enter your email">
                    <span class="ion ion-email form-control-feedback"></span>
                    <a class="pull-right back_login" href="#"><i class="fa fa-angle-left"></i> Back</a>
                </div>

                <div class="row">
                    <!-- csrf token -->
                    <input type="hidden" name="csrf_test_name" value="7d497fb0934073456b62378aa4dca723">
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-info btn-block margin-top-10 signin_btn">SUBMIT</button>
                    </div>
                </div>
            </form>
            <!-- /.social-auth-links -->

            <div class="margin-top-30 text-center">
            </div>

        </div>
    </div>

</div>

@endsection