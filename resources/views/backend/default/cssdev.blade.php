<!-- <link rel="stylesheet" type="text/css" href="{{ Helper::backend('vendor/bootstrap/css/bootstrap.min.css') }}"> -->
<!-- <link rel="stylesheet" href="{{ Helper::frontend('vendor/fontawesome-free/css/all.min.css') }}" /> -->
<!-- <link rel="stylesheet" href="{{ Helper::backend('vendor/jquery-ui/css/jquery-ui.min.css') }}" /> -->

@if(config('website.loading'))
<!-- <link rel="stylesheet" href="{{ Helper::backend('vendor/loading/pace.css') }}" /> -->
@endif
@if(config('website.pjax'))
<link rel="stylesheet" href="{{ Helper::backend('vendor/flatpickr/flatpickr.min.css') }}">
<link rel="stylesheet" href="{{ Helper::backend('vendor/trumbowyg/trumbowyg.min.css') }}">
@endif
