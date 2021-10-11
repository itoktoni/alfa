@extends(Views::backend())

@section('content')

<div class="row">
     <div class="panel-body">
         <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Show') }} {{  __($form_name) }} : {{ $model->{$model->getKeyName()} }}</h2>
            </header>
            <div class="panel-body line">
                <div class="show">
                    <table class="table table-table table-bordered table-striped table-hover mb-none">
                        <tbody>
                            @foreach($fields as $item => $value)
                            @if(!empty($model->{$item}))
                            <tr>
                                <th class="col-lg-2">{{ $value['name'] }}</th>
                                <td>{{ $model->{$item} }}</td>
                            </tr>
                            @endif
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