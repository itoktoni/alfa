@extends(Helper::setExtendBackend())
@section('content')
<div class="row">
     <div class="panel-body">
         <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">@lang('pages.show') {{ $form_name }} : {{ $model->{$model->getKeyName()} }}</h2>
            </header>

            <div class="panel-body line">
                <div class="show">
                    <table class="table table-table table-bordered table-striped table-hover mb-none">
                        <tbody>
                            @foreach($fields as $item => $value)
                            <tr>
                                <th class="col-lg-2">{{ $value['name'] }}</th>
                                <td>{{ $model->{$item} }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            @include($template_action)

        </div>
     </div>
    
</div>

@endsection