@push('css')
<link rel="stylesheet" href="{{ Helper::backend('vendor/flatpickr/flatpickr.min.css') }}">
@endpush

@push('js')
<script src="{{ Helper::backend('vendor/flatpickr/flatpickr.min.js') }}"></script>
@endpush

@push('javascript')
    <script>
        @if(in_array('date', $array))
        $(".date").flatpickr({
            altInput: true,
            altFormat: "j F Y",
            dateFormat: "Y-m-d",
        });
        @endif

        @if(in_array('datetime', $array))
        $(".datetime").flatpickr({
            enableTime: true,
            altInput: true,
            altFormat: "j F Y H:i",
            dateFormat: "Y-m-d H:i",
        });
        @endif
    </script>
@endpush