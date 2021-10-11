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
    {!! Form::model($data, ['route'=>[$form.'_update', $data->$key],'class'=>'form-horizontal','files'=>true]) !!}
    <div class="panel panel-default">
        <header class="panel-heading">
            <h2 class="panel-title">Edit {{ ucfirst($template) }}</h2>
        </header>
        <div class="panel-body">
            <div class="col-md-12 col-lg-12">
                @include('page.'.$template.'.form')
                <hr>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault">Module </label>
                    <div id="checkbox" class="col-md-10">
                        @foreach($controller as $control)
                        <div id="{{ $control }}" data-toggle="{{ $control }}" data-range="true" class="row"
                            style="margin-left: 0px;border-bottom: 1px solid #cecece;margin-top: 5px;width: 99%">
                            <div class="col-md-10" style="padding:0px 5px;margin-left: 0px;margin-bottom: 5x;">
                                <label style="cursor: pointer;" for="{{ $control }}">
                                    <input type="checkbox" name="controller[]" value="{{ $control }}">
                                    <span onclick="show($(this))" class="btn btn-xs btn-default">{{ $control }}</span>
                                </label>
                                <br>
                                @php
                                $trueAct = Helper::getMethod('Blog', true);
                                @endphp
                                @for ($i = 0; $i < count($trueAct); $i++) <label style="cursor: pointer;"
                                    for="{{ $trueAct[$i] }}">
                                    <input style="margin-top: 0px;" id="{{ $control }}" type="checkbox" name="act[]"
                                        value="{{ $control }}">
                                    <span class="btn btn-xs btn-primary">{{ ucfirst($trueAct[$i]) }}</span>
                                    </label>
                                    @endfor

                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault">Function </label>
                    <div class="col-md-10">
                        @for ($i = 0; $i < count($act); $i++) <div class="col-md-3"
                            style="padding:0px 5px;margin-left: 0px;margin-bottom: 5x;">
                            <div>
                                <label style="cursor: pointer;" for="{{ $act[$i]['code'] }}">
                                    <input type="checkbox" {{ $act[$i]['status'] == true ? 'checked=""' : '' }}
                                        name="actions[]" id="{{ $act[$i]['code'] }}" value="{{ $act[$i]['code'] }}">
                                    {{ ucwords(str_replace('_',' ',$act[$i]['code'])) }}
                                </label>
                                <input type="hidden" name="act[]" value="{{ $act[$i]['code'] }}">
                            </div>
                    </div>
                    @endfor
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label class="col-md-2 control-label">Filter List</label>
                <div class="col-md-4">
                    <select class="form-control input-sm mb-md" multiple id="filter" name="filter[]">
                        @if(!empty($detail))
                        @if(count($detail) > 1)
                        @foreach($detail as $d)
                        <option selected="" value="{{ $d }}">{{ $d }}</option>
                        @endforeach
                        @else
                        <option selected="" value="{{ $detail }}">{{ $detail }}</option>
                        @endif
                        @endif
                    </select>
                </div>

                <label class="col-md-2 control-label">Group Module</label>
                <div class="col-md-4">
                    <select class="form-control input-sm mb-md" multiple id="group_module" name="group[]">
                        @foreach($group as $g)
                        <option selected="" value="{{ $g->group_module_code }}">{{ $g->group_module_name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="navbar-fixed-bottom" id="menu_action">
        <div class="text-right" style="padding:5px">
            <a href="{!! route(" {$form}_list") !!}" class="btn btn-warning">Back</a>
            <button type="reset" class="btn btn-default">Reset</button>
            @isset($update)
            <button type="submit" class="btn btn-primary">Save</button>
            @endisset
        </div>
    </div>

</div>
{!! Form::close() !!}
</div>
@endsection