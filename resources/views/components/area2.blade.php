@if(!config('website.pjax'))

@push('style')
<style>.ck-editor__editable {min-height: 200px !important;}</style>
@endpush

@push('js')
<script src="{{ Helper::backend('vendor/chosen/chosen.ajax.js') }}"></script>
@endpush
@else
<script src="{{ Helper::backend('vendor/chosen/chosen.ajax.js') }}"></script>
@endif

@push('javascript')
<script>
    $("#chosen").chosen_ajax({
        allow_single_deselect: true, 
        ajax_base_url: "{{ route('area') }}", 
        ajax_method: "POST", 
        ajax_data: {type: 'A', "_token": "{{ csrf_token() }}"},
        ajax_min_chars: 4                              
    });

</script>
@endpush