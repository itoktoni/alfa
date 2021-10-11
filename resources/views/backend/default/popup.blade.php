<meta name="csrf-token" content="{{ csrf_token() }}">

<link rel="stylesheet" href="{{ Helper::backend('vendor/jquery-ui/css/jquery-ui.min.css') }}" />
<link rel="stylesheet" type="text/css" href="{{ Helper::backend('vendor/bootstrap/css/bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ Helper::backend('vendor/chosen/chosen.min.css') }}">
<link rel="stylesheet" href="{{ Helper::backend('stylesheets/theme.css') }}" />
<link rel="stylesheet" href="{{ Helper::backend('stylesheets/theme-custom.min.css') }}">
<!-- <link rel="stylesheet" href="{{ Helper::backend('stylesheets/skins/default.min.css') }}" /> -->
<!-- <link rel="stylesheet" href="{{ Helper::backend('stylesheets/responsive.min.css') }}"> -->
@stack('style')

<script src="{{ Helper::backend('vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ Helper::backend('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ Helper::backend('vendor/chosen/chosen.jquery.min.js') }}"></script>
<script src="{{ Helper::backend('vendor/pnotify/pnotify.custom.js') }}"></script>

@stack('js')

@yield('content')

@stack('javascript')