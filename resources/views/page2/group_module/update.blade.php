@extends(Helper::setExtendBackend())

@push('javascript')
<script>
    function show(value){
    
    if(value.attr('data') == 'true'){
        $('#'+value.text()).checkboxes('uncheck');
        value.attr('data', false);
    }
    else{
        
        $('#'+value.text()).checkboxes('check');
        value.attr('data', true);
    }
 }

</script>
@endpush
@section('content')
<div class="row">
    <div class="panel-body">

        {!! Form::model($model, ['route'=>[$module.'_update', 'code' =>
        $model->$key],'class'=>'form-horizontal','files'=>true])
        !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">Edit {{ ucwords(str_replace('_',' ',$template)) }}</h2>
            </header>
            <div class="panel-body line">

                <div class="col-md-12 col-lg-12">
                    @include('page.'.$template.'.form')

                    @empty(!$controller)
                    <hr>

                    <div class="form-group">
                        <label class="col-md-2 control-label" for="inputDefault">Module </label>
                        <div id="checkbox" class="col-md-10">
                            @foreach($controller as $control)

                            <div id="{{ $control }}" data-toggle="{{ $control }}" data-range="true" class="row"
                                style="margin-left: 0px;margin-top: 5px;width: 99%">
                                <div class="col-md-10" style="padding:0px 5px;margin-left: 0px;margin-bottom: 5x;">
                                    <div class="row">

                                        <div class="col-md-3 col-xs-12">
                                            @php
                                            $module_true = false;
                                            $module_check = $model->group_module_code.'_'.Helper::snake($control);
                                            if($data_module->contains($module_check)){
                                            $module_true = true;
                                            }
                                            @endphp
                                            <div class="col-md-2 col-xs-1">
                                                <input type="checkbox" {{ $module_true ? 'checked=""' : ''}}
                                                    name="controller[]" value="{{ $control }}">
                                            </div>
                                            <div class="col-md-9 col-xs-10" style="margin-bottom:10px">
                                                <div class="row">
                                                    <span onclick="show($(this))"
                                                        class="btn btn-default btn-block btn-sm">{{ $control }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-9">
                                            @php
                                            $trueAct = Helper::getMethod($control, $model->group_module_folder);
                                            @endphp
                                            @for ($i = 0; $i < count($trueAct); $i++) @php $action_parse=$trueAct[$i];
                                                $action_true=false; $action_check=$module_check.'_'.$action_parse;
                                                if($list_action->contains($action_check)){
                                                $action_true = true;
                                                }
                                                @endphp

                                                <input type="hidden" name="real_act[{{ $control }}][]"
                                                    value="{{ $action_parse }}">
                                                <label class="col-md-4 col-xs-6" style="cursor: pointer;" for="{{ $trueAct[$i] }}">
                                                    <input style="margin-top: 0px;" id="{{ $control }}" type="checkbox"
                                                        name="act[{{ $control }}][]"
                                                        {{ $action_true ? 'checked=""' : ''}}
                                                        value="{{ $action_parse }}">
                                                    <span class="btn btn-xs btn-primary">
                                                        {{ ucwords(str_replace('_',' ',$trueAct[$i])) }}
                                                    </span>
                                                </label>
                                                @endfor
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

        </div>
        {!! Form::close() !!}
    </div>

</div>
@endsection