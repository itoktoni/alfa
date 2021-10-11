@extends(Helper::setExtendBackend())
@section('content')

<div class="row">
    {!! Form::model($model, ['route'=>[config('my.module'), 'code' => $model->$key],'class'=>'form-horizontal','files'=>true]) !!}
    <div class="panel panel-default" style="margin-bottom: 300px;">
        <header class="panel-heading">
            <h2 class="panel-title">Edit Users</h2>
        </header>
        @include('page.'.$template.'.form')
        
    </div>

    @include('page.master.action')

    {!! Form::close() !!}
</div>
@endsection


