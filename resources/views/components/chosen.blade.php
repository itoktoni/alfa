@push('javascript')
<script src="{{ Helper::backend('vendor/chosen/chosen.ajax.js') }}"></script>
<script>
$("#chosen").chosen_ajax({
    allow_single_deselect: true,
    // Ajax options
    ajax_base_url: "{{ route('area') }}",  
    ajax_method: "POST", 
    ajax_data: {type: 'A', _token: "{{ csrf_token() }}"},   
    ajax_min_chars: 2 
});
</script>
@endpush