@isset ($array)
    @push('js')
    @if (config('website.env') == 'production')
        @if( (is_array($array) && in_array('Chartjs', $array) ) || $array == 'Chartjs')
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>
        @elseif((is_array($array) && in_array('Highcharts', $array)) || $array == 'Highcharts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
        @elseif((is_array($array) && in_array('Fusioncharts', $array)) || $array == 'Fusioncharts')
<script src="https://cdn.jsdelivr.net/npm/fusioncharts@3.12.2/fusioncharts.js" charset="utf-8"></script>
        @elseif((is_array($array) && in_array('Echarts', $array)) || $array == 'Echarts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/echarts/4.0.2/echarts-en.min.js" charset="utf-8"></script>
        @elseif((is_array($array) && in_array('Frappe', $array)) || $array == 'Frappe')
<script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
        @else
<script src="https://cdn.jsdelivr.net/npm/frappe-charts@1.1.0/dist/frappe-charts.min.iife.js"></script>
        @endif
    @else
        @if( (is_array($array) && in_array('Chartjs', $array) ) || $array == 'Chartjs')
<script src="{{ Helper::backend('vendor/charts/chart.min.js') }}" charset="utf-8"></script>
        @elseif((is_array($array) && in_array('Highcharts', $array)) || $array == 'Highcharts')
<script src="{{ Helper::backend('vendor/charts/highcharts.js') }}" charset="utf-8"></script>
        @elseif((is_array($array) && in_array('Fusioncharts', $array)) || $array == 'Fusioncharts')
<script src="{{ Helper::backend('vendor/charts/fusioncharts.js') }}" charset="utf-8"></script>
        @elseif((is_array($array) && in_array('Echarts', $array)) || $array == 'Echarts')
<script src="{{ Helper::backend('vendor/charts/echarts-en.min.js') }}" charset="utf-8"></script>
        @elseif((is_array($array) && in_array('Frappe', $array)) || $array == 'Frappe')
<script src="{{ Helper::backend('vendor/charts/frappe-charts.min.iife.js') }}"></script>
        @else
<script src="{{ Helper::backend('vendor/charts/frappe-charts.min.iife.js') }}"></script>
        @endif
    @endif
    @endpush
@endisset
