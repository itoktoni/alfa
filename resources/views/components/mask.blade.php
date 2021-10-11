@push('partial')
<script src="{{ Helper::backend('vendor/mask/cleave.min.js') }}"></script>
<script src="{{ Helper::backend('vendor/mask/numeral.min.js') }}"></script>
@endpush
@push('partial')
<script>
    $('.number').toArray().forEach(function (field) {
        new Cleave(field, {
            numeral: true,
            numeralDecimalMark: '.',
            delimiter: ',',
            numeralDecimalScale: 4
        });
    });

    $('.money').toArray().forEach(function (field) {
        new Cleave(field, {
        numeral: true,
            numeral: true,
            delimiter: ',',
            numeralDecimalScale: 0
        });
    });
</script>
@endpush