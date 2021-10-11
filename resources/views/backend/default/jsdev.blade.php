<!-- <script src="{{ Helper::backend('vendor/modernizr/modernizr.min.js') }}"></script> -->
<!-- <script src="{{ Helper::backend('vendor/jquery/jquery.min.js') }}"></script> -->
<!-- <script src="{{ Helper::backend('vendor/jquery-ui/js/jquery-ui.min.js') }}"></script> -->
<!-- <script src="{{ Helper::backend('vendor/bootstrap/js/bootstrap.min.js') }}"></script> -->
<!-- <script src="{{ Helper::backend('vendor/chosen/chosen.jquery.min.js') }}"></script> -->

@if(config('website.loading'))
<!-- <script src="{{ Helper::backend('vendor/loading/pace.min.js') }}"></script> -->
@endif	
@if(config('website.pjax'))
<script src="{{ Helper::backend('vendor/trumbowyg/trumbowyg.min.js') }}"></script>
<script src="{{ Helper::backend('vendor/trumbowyg/trumbowyg.resizimg.min.js') }}"></script>
<script src="{{ Helper::backend('vendor/trumbowyg/trumbowyg.upload.min.js') }}"></script>
<script src="{{ Helper::backend('vendor/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ Helper::backend('vendor/mask/cleave.min.js') }}"></script>
<script src="{{ Helper::backend('vendor/jquery-datatables/media/js/jquery.dataTables.min.js') }}"></script>
<!-- <script src="{{ Helper::backend('vendor/pjax/pjax.min.js') }}"></script> -->
@endif