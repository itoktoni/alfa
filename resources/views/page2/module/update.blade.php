@extends(Helper::setExtendBackend())
@section('content')
<div class="row">
    <div class="panel-body">

        {!! Form::model($model, ['route'=>[$action_code, 'code' =>
        $model->$key],'class'=>'form-horizontal','files'=>true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">Edit {{ ucfirst($template) }}</h2>
            </header>
            <div class="panel-body line">
                <div class="col-md-12 col-lg-12">
                    @include('page.'.$template.'.form')
                    <div class="form-group">
                        <label class="col-md-2 control-label">Group Module</label>
                        <div class="col-md-10">
                            <select data-plugin-selectTwo class="form-control input-sm mb-md" multiple id="group_module" name="group[]">
                                @foreach($list_group as $value)
                                <option
                                    {{ $data_group->where('group_module_code', $value->group_module_code)->count() > 0 ? 'selected=""' : ''}}
                                    value="{{ $value->group_module_code }}">{{ $value->group_module_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="form-group">
                        <label class="col-md-2 control-label" for="inputDefault">Function </label>
                        <div class="col-md-10">
                            @for ($i = 0; $i < count($act); $i++) <div class="col-md-2"
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
            </div>
        </div>

        @include($template_action)

    </div>
    {!! Form::close() !!}
</div>
</div>

@endsection