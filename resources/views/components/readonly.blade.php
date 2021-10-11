@push('javascript')
<script>
    $(document).ready(function() {
        @if(in_array('input', $array))
        $("{{ $selector ?? '' }} input").datepicker("destroy");
        $('{{ $selector ?? '' }} input, {{ $selector ?? '' }} textarea').attr('readonly', 'readonly');
        @endif
        @if(in_array('select', $array))
        $('{{ $selector ?? '' }} option:not(:selected)').attr('disabled',true);
        @endif
    });
</script>
@endpush