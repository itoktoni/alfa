@extends(Helper::setExtendBackend())
@section('content')
<div class="row">
    <div class="panel-body">
        {!! Form::open(['route' => $route_save, 'class' => 'form-horizontal', 'files' => true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">@lang('pages.create') {{ $form_name }}</h2>
            </header>

            <div class="panel-body line">
                @includeIf(Helper::include($template))
            </div>

            @include($template_action)
        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection