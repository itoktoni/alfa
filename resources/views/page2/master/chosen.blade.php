@push('js')
<script src="{{ Helper::backend('vendor/chosen/chosen.jquery.min.js') }}"></script>
@endpush

@push('javascript')
<script>
     $("select.form-control:not(.select)").chosen();
</script>
@endpush