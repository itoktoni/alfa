@extends(Helper::setExtendBackend())
@section('content')
<div class="row">
    <div class="panel-body">
        {!! Form::model($model, ['route'=>[$route_update, 'code' => $model->{$model->getKeyName()}],'class'=>'form-horizontal','files'=>true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">@lang('pages.update') {{ $form_name }} : {{ $model->{$model->getKeyName()} }}</h2>
            </header>
            <div class="panel-body line">
                <div class="">
                    @includeIf(Helper::include($template))
                </div>
            </div>
        </div>
         @include($template_action)
        {!! Form::close() !!}
    </div>
</div>
@endsection