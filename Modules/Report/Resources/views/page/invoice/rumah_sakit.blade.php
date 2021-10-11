@extends(Views::backend())

@push('css')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
@endpush

@push('js')
<script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
@endpush

@push('javascript')
<script>
$(document).ready( function () {
    $('#datatable').DataTable({
        "paging": true,
    });
} );
</script>
@endpush

@section('content')

<div class="row">
    <div class="panel-body">
        {!! Form::model($model, ['route'=>[Route::currentRouteName().'_export', 'code' => $model->{$model->getKeyName()}],'class'=>'form-horizontal','files'=>true]) !!}
        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Report') }} {{ __('Linen') }} {{ __('Detail') }}</h2>
            </header>

            <div class="panel-body line">
                @includeIf(Views::form('rumah_sakit_form', $template, $folder))
            </div>

            <div class="navbar-fixed-bottom" id="menu_action">
                <div class="text-right action-wrapper">
                    <!-- <button type="submit" value="pdf" name="action" class="btn btn-danger">{{ __('PDF') }}</button> -->
                    <button type="submit" value="preview" name="action" class="btn btn-primary">{{ __('Preview') }}</button>
                    <button type="submit" value="excel" name="action" class="btn btn-success">{{ __('Excel') }}</button>
                </div>
            </div>

        </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection
