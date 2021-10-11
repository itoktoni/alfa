@extends('backend.'.config('website.backend').'.layouts.blank')

@section('content')
    <div id="terminal-shell"></div>
@endsection

@push('css')
    <link href="{{ Helper::asset('/vendor/terminal/css/terminal.css') }}" rel="stylesheet"/>
@endpush

@push('js')
    <script src="{{ Helper::asset('/vendor/terminal/js/terminal.js') }}"></script>
@endpush

@push('javascript')
<script>
(function() {
    new Terminal("#terminal-shell", {!! $options !!});
})();
</script>
@endpush

@push('style')
    <style>

        #terminal-shell{
            margin-top: -30px;
            background-color: #1d2127 !important;
            font-size: 20px !important;
        }

        @media only screen and (max-width: 600px) {
            #terminal-shell{
                margin-top: 10px;
            }
        }
        
        .cmd, .cmd *, .terminal, .terminal *, .cursor-line, .prompt, .prompt span, .cmd .cursor, .terminal-output{
            margin-left: 3px;
            font-size: 15px;
            background-color: #1d2127 !important;
        }
        .terminal-output [data-index="0"],[data-index="1"]{
            display:none;
        }
    </style>
@endpush