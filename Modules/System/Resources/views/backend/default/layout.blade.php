<!doctype html>
<html class="scroll {{ Cache::get(Auth::user()->username.'_toggle') ? 'sidebar-left-collapsed' : '' }}">

<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('website.name') }}</title>
    <meta name="keywords" content="{{ config('website.name') }}" />
    <meta name="description" content="{{ config('website.description') }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="turbolinks-cache-control" content="no-cache">
    <link href="{{ Helper::files('logo/'.config('website.favicon')) }}" rel="shortcut icon">

    <link rel="stylesheet" href="{{ Helper::backend('stylesheets/theme.css') }}" />
    @stack('css')

    <script src="{{ Helper::backend('javascripts/main.js') }}"></script>
    
    @if(config('website.pjax'))
    <script src="{{ Helper::backend('vendor/trumbowyg/trumbowyg.min.js') }}"></script>
    <script src="{{ Helper::backend('vendor/trumbowyg/trumbowyg.resizimg.min.js') }}"></script>
    <script src="{{ Helper::backend('vendor/trumbowyg/trumbowyg.upload.min.js') }}"></script>
    <script src="{{ Helper::backend('vendor/flatpickr/flatpickr.min.js') }}"></script>
    <script src="{{ Helper::backend('vendor/mask/cleave.min.js') }}"></script>
    <script src="{{ Helper::backend('vendor/jquery-datatables/media/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ Helper::backend('vendor/pjax/turbolinks.js') }}"></script>
    <script>
    if (Turbolinks.supported) {
        Turbolinks.start()
    } else {
        console.warn("browser kamu tidak mendukung Turbolinks")
    }
    </script>
    @endif
    @stack('style')
    @stack('js')

    @livewireStyles
</head>

<body>
    <section class="body">
        @include(Views::backend('header'))
        <div class="inner-wrapper">
            @include(Views::backend('left'))
            <section role="main" class="content-body">
                <header class="page-header">
                    <span class="col-lg-11 col-sm-6 col-xl-11 pull-left"
                        style="color:#A6A3A3;margin-top:15px;z-index: 1;">
                        @if(config('website.information'))
                        <marquee>
                            <span>test</span>
                        </marquee>
                        @endif
                    </span>
                    <div class="right-wrapper pull-right">
                        <a id="link_menu" class="sidebar-right-toggle" data-open="sidebar-right">
                            <i style="margin-right: -30px;" class="fa fa-paper-plane"></i>
                        </a>
                    </div>
                </header>
                <div id="screen pjax-container" class="screen">
                    @yield('content')
                    @stack('partial')
                </div>
                <div style="padding-bottom: 50px;"></div>
            </section>
        </div>
        @include(Views::backend('right'))
    </section>
    <script src="{{ Helper::backend('javascripts/script.js') }}"></script>
    @include(Views::backend('alert'))
    @stack('javascript')
    @livewireScripts
</body>

</html>