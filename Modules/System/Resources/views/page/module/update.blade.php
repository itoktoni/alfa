@extends(Views::backend())
@section('content')
<div class="row">
    <div class="panel-body">
        {!! Form::model($model, ['route'=>[$module.'_update', 'code' =>
        $model->$key],'class'=>'form-horizontal','files'=>true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">Edit {{ ucfirst($template) }}</h2>
            </header>

            <div class="panel-body line">
                @include($folder.'::page.'.$template.'.form')
                <div class="form-group">
                    <label class="col-md-2 control-label">Group Module</label>
                    <div class="col-md-10">
                        <select data-plugin-selectTwo class="form-control input-sm mb-md" multiple id="group_module"
                            name="groups[]">
                            @foreach($list_group as $key => $value)
                            <option {{ in_array($key, $data_group) ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-md-2 control-label" for="inputDefault">Function </label>
                    <div class="col-md-10">
                        @foreach($list_action as $key => $value)
                        <div class="col-md-2 mt-xs pd-xs">
                            <div>
                                <label style="cursor: pointer;" for="{{ $value }}">
                                    <input type="checkbox" {{ in_array($value, $data_action) ? 'checked' : '' }}
                                        name="actions[]" id="{{ $value }}" value="{{ $model->{$model->getKeyName()}.'_'.$value }}">
                                    {{ ucwords(str_replace('_',' ',$value)) }}
                                    <input type="hidden" name="list_action[]" value="{{ $value }}">
                                </label>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @include($template_action)

    </div>
    {!! Form::close() !!}
</div>
</div>

@endsection
