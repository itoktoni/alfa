@if(config('website.env') == 'local')
@include(Helper::setExtendBackend('cssdev'))
@else
@include(Helper::setExtendBackend('csspro'))
@endif
@stack('css')
<!-- <link rel="stylesheet" href="{{ Helper::backend('vendor/pnotify/pnotify.custom.css') }}" /> -->
<!-- <link rel="stylesheet" href="{{ Helper::backend('vendor/chosen/chosen.min.css') }}"> -->
<link rel="stylesheet" href="{{ Helper::backend('stylesheets/theme.css') }}" />
<!-- <link rel="stylesheet" href="{{ Helper::backend('stylesheets/skins/default.min.css') }}" /> -->
<!-- <link rel="stylesheet" href="{{ Helper::backend('stylesheets/theme-custom.min.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ Helper::backend('stylesheets/responsive.min.css') }}"> -->