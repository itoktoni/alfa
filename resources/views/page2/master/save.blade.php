@extends(Helper::setExtendBackend())
@section('content')
<div class="row">

    <div class="panel-body">
        @isset($model->$key)
        {!! Form::model($model, ['route'=>[$action_code, 'code' => $model->$key],'class'=>'form-horizontal
        ','files'=>true])
        !!}
        @else
        {!! Form::open(['route' => $action_code, 'class' => 'form-horizontal', 'files' => true]) !!}
        @endisset
        <div class="panel panel-default">

            <header class="panel-heading">
                @isset($model->$key)
                <h2 class="panel-title">Edit {{ ucwords(str_replace('_',' ',$template)) }} : {{ $model->$key }}</h2>
                @else
                <h2 class="panel-title">Create {{ ucwords(str_replace('_',' ',$template)) }}</h2>
                @endisset
            </header>

            <div class="panel-body line">
                <div class="col-md-12 col-lg-12">
                    @includeIf(Helper::include($template))
                </div>
            </div>
            @include($template_action)

        </div>
        {!! Form::close() !!}
       
    </div>
</div>

@endsection