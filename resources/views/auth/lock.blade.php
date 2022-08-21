@extends('auth.credential')
@section('content')

<div class="container">
<form class="form login text-center form-control" id="auth" role="form" method="POST" action="{{ route('lock') }}">
    {{ csrf_field() }}

    <div class="form__field form__field--email">
        <div class="form__input-wrapper">
            {!! Form::password('change_password', null, ['autofocus', 'class' => 'form__input','id' =>
            'login__email','placeholder' =>
            'Secure Password']) !!}
        </div>
    </div>

    <div id="container_submit" class="form__field form__field--submit">
        <input id="submit" type="submit" value="Reset">
    </div>
    <a style="position: absolute;z-index: 99999999 !important;color:#FFFFFF" href="{{ route('home') }}">
        {{ __('Back to Dashboard') }} ?</a>

    {!! Form::close() !!}

    <div class="container_desc">
        <div class="description">
            <div class="error">
                <p>
                    @if ($errors->any())
                    @foreach ($errors->all() as $error)
                    @if ($loop->first)
                    <span class="help-block text-danger text-left">
                        <strong>{{ $error }}</strong><br>
                    </span>
                    @endif
                    @endforeach
                    @endif
                </p>
            </div>
        </div>
    </div>
</div>


    @endsection