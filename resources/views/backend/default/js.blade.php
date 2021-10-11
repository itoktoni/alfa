@if(config('website.env') == 'local')
@include(Helper::setExtendBackend('jsdev'))
@else
@include(Helper::setExtendBackend('jspro'))
@endif
<!-- <script src="{{ Helper::backend('javascripts/main.js') }}"></script> -->

@stack('js')
<!-- <script src="{{ Helper::backend('vendor/jquery/jquery.checkboxes.js') }}"></script> -->
<!-- <script src="{{ Helper::backend('vendor/jquery/jquery.alertable.min.js') }}"></script> -->
<!-- <script src="{{ Helper::backend('vendor/jquery/arrow-table.min.js') }}"></script> -->
<!-- <script src="{{ Helper::backend('vendor/pnotify/pnotify.custom.js') }}"></script> -->
<!-- <script src="{{ Helper::backend('javascripts/theme.custom.js') }}"></script> -->

<!-- <script src="{{ Helper::backend('javascripts/main.js') }}"></script> -->
@if(config('website.pjax'))
<!-- <script src="{{ Helper::backend('javascripts/pjax.js') }}"></script> -->
@if(config('website.env') == 'local')
<script src="{{ Helper::backend('vendor/pjax/turbolinks.js') }}"></script>
@else
<script src="https://cdnjs.cloudflare.com/ajax/libs/turbolinks/5.2.0/turbolinks.js"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/pjax@0.2.8/pjax.min.js"></script> -->
@endif
<script>
if (Turbolinks.supported) {
    Turbolinks.start()
} else {
    console.warn("browser kamu tidak mendukung Turbolinks")
}
</script>
@endif

