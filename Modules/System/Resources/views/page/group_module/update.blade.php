@extends(Views::backend())

@section('content')
<div class="row">
    <div class="panel-body">

        {!! Form::model($model, ['route'=>[$route_update, 'code' =>
        $model->{$model->getKeyName()}],'class'=>'form-horizontal','files'=>true])
        !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">Edit {{ $form_name }}</h2>
            </header>
            <div class="panel-body line">

                @include($folder.'::page.'.$template.'.form')

                @empty(!$controller)
                <hr>

                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault">Module </label>
                    <div id="checkbox" class="col-md-10">
                        @foreach($controller as $control)

                        <div id="{{ $control }}" data-toggle="{{ $control }}" data-range="true" class="row mt-xs">
                            <div class="col-md-10">
                                <div class="row">

                                    <div class="col-md-3 col-xs-12">
                                        @php
                                        $module_check = $model->system_group_module_code.'_'.Helper::snake($control);
                                        $module_true = $data_module->contains($module_check) ? true : false;
                                        @endphp
                                        <div class="col-md-2 col-xs-1">
                                            <input type="checkbox" {{ $module_true ? 'checked' : ''}}
                                                name="module[]" value="{{ $control }}">
                                        </div>
                                        <div class="col-md-9 col-xs-10">
                                            <div class="row">
                                                <span onclick="show($(this))" control="{{ $control }}"
                                                    class="btn btn-default btn-block btn-sm">{{ Helper::functionToLabel($control) }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-9">
                                        @php
                                        $trueAct = Helper::getMethod($control, $model->system_group_module_folder);
                                        $dataAction = $data_action[$control] ?? [];
                                        @endphp
                                        @foreach($trueAct as $act)

                                        <input type="hidden" name="groups[{{ $control }}][real][]"
                                            value="{{ $act }}">

                                        <label class="col-md-4 col-xs-6" style="cursor: pointer;"
                                            for="{{ $act }}">

                                            <input id="{{ $control }}" type="checkbox" name="groups[{{ $control }}][data][]"
                                                {{ in_array($act, $dataAction) ? 'checked' : ''}} value="{{ $act }}">
                                            
                                            <span class="btn btn-xs btn-primary">
                                                {{ Helper::functionToLabel($act)  }}
                                            </span>
                                        </label>

                                        @endforeach
                                    </div>

                                </div>
                            </div>
                        </div>

                        <hr>
                        @endforeach
                    </div>
                </div>
                @endempty
            </div>
        </div>

        <div class="navbar-fixed-bottom" id="menu_action">
            <div class="text-right" style="padding:5px">
                <a href="{{ route($module.'_data') }}" class="btn btn-warning">Back</a>
                <button type="reset" class="btn btn-default">Reset</button>
                <button type="submit" class="btn btn-primary">Save</button>
                @isset($actions['update'])
                @endisset
            </div>
        </div>

        {!! Form::close() !!}
    </div>

</div>
@endsection

@push('javascript')
<script src="{{ Helper::backend('vendor/jquery/jquery.checkboxes.js') }}"></script>
<script>
function show(value) {

    if (value.attr('data') == 'true') {

        $('#' + value.attr('control')).checkboxes('uncheck');
        value.attr('data', false);

    } else {

        $('#' + value.attr('control')).checkboxes('check');
        value.attr('data', true);
    }
}
</script>
@endpush