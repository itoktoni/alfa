@push('javascript')
<script>
    $(document).ready(function() {
        @if(in_array('input', $array))
        $("{{ $selector ?? '' }} input").datepicker("destroy");
        $('{{ $selector ?? '' }} input, {{ $selector ?? '' }} textarea').attr('disabled', 'disabled');
        @endif
        @if(in_array('select', $array))
        $('{{ $selector ?? '' }} select').attr('disabled', 'disabled');
        @endif
        @if(in_array('select2', $array))
        $("{{ $selector ?? '' }} select[data-plugin-selectTwo]").select2({
            disabled: 'readonly'
        });
        @endif
    });
</script>
@endpush

@if (in_array('action', $array))
    @push('style')
        <style>
            .show-table td[data-title="Action"],
            .show-table #action {
            display: none !important;
            }
        </style>
    @endpush
@endif