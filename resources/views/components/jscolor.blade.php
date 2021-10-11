@if (config('website.env') == 'local')
@push('js')
<script src="{{ Helper::backend('vendor/jscolor/jscolor.min.js') }}"></script>
@endpush
@else
@push('js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jscolor/2.0.4/jscolor.min.js"></script>
@endpush
@endif