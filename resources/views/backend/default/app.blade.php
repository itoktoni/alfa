<!doctype html>
<html class="scroll {{ Cache::get(Auth::user()->username.'_toggle') ? 'sidebar-left-collapsed' : '' }}">

<head>
    @include(Helper::setExtendBackend('meta'))

    @include(Helper::setExtendBackend('css'))
    <script src="{{ Helper::backend('javascripts/main.js') }}"></script>
    @include(Helper::setExtendBackend('js'))

    @livewireStyles
</head>

<body>

    <section class="body">
        @include(Helper::setExtendBackend('header'))
        <div class="inner-wrapper">
            @include(Helper::setExtendBackend('left'))
            <section role="main" class="content-body">
                <header class="page-header">
                    <span class="col-lg-11 col-sm-6 col-xl-11 pull-left"
                        style="color:#A6A3A3;margin-top:15px;z-index: 1;">
                        <marquee>
                            <span>test</span>
                        </marquee>
                    </span>
                    <div class="right-wrapper pull-right">
                        <a id="link_menu" class="sidebar-right-toggle" data-open="sidebar-right">
                            <i style="margin-right: -30px;" class="fa fa-paper-plane"></i>
                        </a>
                    </div>
                </header>
                <div id="screen pjax-container" class="screen">
                    @include('page.master.chosen')
                    @yield('content')
                    @stack('partial')
                </div>
                <div style="padding-bottom: 50px;"></div>
            </section>
        </div>
        @include(Helper::setExtendBackend('right'))
    </section>
    <script src="{{ Helper::backend('javascripts/script.js') }}"></script>
    @include(Helper::setExtendBackend('alert'))
    @stack('style')
    @stack('javascript')
    @livewireScripts
</body>

</html>