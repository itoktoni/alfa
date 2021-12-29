<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('website.name', 'Laravel') }}</title>
    @if(file_exists(Helper::files('logo/'.config('website.favicon')))) 
    <link href="{{ Avatar::create(config('website.name'))->setShape('square') }}" rel="shortcut icon">
    @else
    <link href="{{ Helper::vendor('default/favicon.png') }}" rel="shortcut icon">
    @endif
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ Helper::credential('default/css/index.min.css') }}">
    <link rel="stylesheet" media="screen" href="{{ Helper::credential('default/css/style.min.css') }}">
</head>

<body id="particles-js">
    <div class="overlay"></div>
    <div class="login-container">

        @yield('content')

        <svg width="0" height="0" xmlns="http://www.w3.org/2000/svg" class="icons">
            <symbol id="lock" viewBox="0 0 1792 1792">
                <path
                    d="M640 768h512V576q0-106-75-181t-181-75-181 75-75 181v192zm832 96v576q0 40-28 68t-68 28H416q-40 0-68-28t-28-68V864q0-40 28-68t68-28h32V576q0-184 132-316t316-132 316 132 132 316v192h32q40 0 68 28t28 68z" />
            </symbol>
            <symbol id="user" viewBox="0 0 1792 1792">
                <path
                    d="M1600 1405q0 120-73 189.5t-194 69.5H459q-121 0-194-69.5T192 1405q0-53 3.5-103.5t14-109T236 1084t43-97.5 62-81 85.5-53.5T538 832q9 0 42 21.5t74.5 48 108 48T896 971t133.5-21.5 108-48 74.5-48 42-21.5q61 0 111.5 20t85.5 53.5 62 81 43 97.5 26.5 108.5 14 109 3.5 103.5zm-320-893q0 159-112.5 271.5T896 896 624.5 783.5 512 512t112.5-271.5T896 128t271.5 112.5T1280 512z" />
            </symbol>
        </svg>
    </div>
    @if (config('website.env') == 'local')
    <script src="{{ Helper::credential('default/js/TweenMax.min.js') }}"></script>
    @else
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.20.4/TweenMax.min.js"
        integrity="sha256-S6G5lg9rzC1JCAkx3dQFqP2lefkFxwlNVn0rWCOueXA=" crossorigin="anonymous"></script>
    @endif
    <script src="{{ Helper::credential('default/js/cartoon.js') }}"></script>

    <!-- scripts -->
    <script src="{{ Helper::credential('default/js/particles.min.js') }}"></script>
    <script src="{{ Helper::credential('default/js/config.js') }}"></script>

</body>

</html>