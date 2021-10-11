@extends(Views::backend())
@section('content')
<div class="row">
    <div class="panel-body">
        {!! Form::model($model, ['route'=>[$module.'_update', 'code' =>
        $model->{$model->getKeyName()}],'class'=>'form-horizontal','files'=>true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">Edit {{ ucfirst($template) }}</h2>
            </header>

            <div class="panel-body line">
                @include($folder.'::page.'.$template.'.form')
            </div>
            @include($template_action)

        </div>
        {!! Form::close() !!}
    </div>

</div>

@endsection