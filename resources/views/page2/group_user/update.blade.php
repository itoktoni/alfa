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
                            <select class="form-control input-sm mb-md" multiple id="group_module"
                                name="group[]">
                                @foreach($group as $key => $value)
                                <option {{ in_array($key, $group_module) ? 'selected' : '' }} value="{{ $key }}">
                                    {{ $value }}</option>
                                @endforeach
                            </select>
                        </div>
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