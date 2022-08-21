<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="">
    @if(file_exists(Helper::files('logo/'.config('website.favicon'))))
    <link href="{{ Avatar::create(config('website.name'))->setShape('square') }}" rel="shortcut icon">
    @else
    <link href="{{ Helper::vendor('default/favicon.png') }}" rel="shortcut icon">
    @endif
    <title>{{ env('WEBSITE_DESCRIPTION') }}</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ Helper::credential('accufy/bootstrap-extend.css') }}">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ Helper::credential('accufy/admin_style.css') }}">

    <link rel="stylesheet" href="{{ Helper::credential('accufy/simple-line-icons.css') }}">
    <link href="{{ Helper::credential('accufy/sweet-alert.css') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Alata&display=swap', 'Quicksand:300,400,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <style type="text/css">
        body {
            font-family: Alata, 'sans-serif';
        }
    </style>
</head>

<body class="hold-transition login-page">

    @yield('content')
    <!-- /.login-box -->

    <!-- jQuery 3 -->
    <script src="{{ Helper::credential('accufy/jquery.min.js') }}"></script>
    <!-- popper -->
    <script src="{{ Helper::credential('accufy/popper.min.js') }}"></script>
    <!-- Bootstrap 4.0-->
    <script src="{{ Helper::credential('accufy/bootstrap.min.js') }}"></script>
    <script src="{{ Helper::credential('accufy/admin.js') }}"></script>
    <script src="{{ Helper::credential('accufy/sweet-alert.min.js') }}"></script>

    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
</body>

</html>