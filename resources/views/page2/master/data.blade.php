@extends(Helper::setExtendBackend())
@component('components.responsive', ['array' => $fields])
@endcomponent
@component('components.datatables',['array' => $fields])@endcomponent
@section('content')
<div class="row">
    <div class="panel-body">

        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">@lang('pages.data') {{ ucwords(str_replace('_',' ',$template)) }}
                </h2>
            </header>

            <div class="panel-body line">

                <div class="form-group">
                    {!! Form::open(['route' => $route_data, 'id' => 'search-form', 'files' => true]) !!}
                    <div class="form-horizontal">
                        {!! Form::label($search_code, 'Criteria', ['class' => 'col-md-1 control-label']) !!}
                        <div class="col-md-2 {{ $errors->has($search_code) ? 'has-error' : ''}}">
                            <select name="code" class="form-control">
                                <option value="">@lang('pages.search')</option>
                                @foreach($fields as $item => $value)
                                <option value="{{ $item }}">{{ $value['name'] }}</option>
                                @endforeach
                            </select>
                        </div>

                        {!! Form::label($search_code, 'Operator', ['class' => 'col-md-1 control-label']) !!}
                        <div class="col-md-2 {{ $errors->has($search_code) ? 'has-error' : ''}}">
                            <div class="">
                                <select name="aggregate" class="form-control">
                                    <option value="">@lang('pages.search_name')</option>
                                    <option value="=">@lang('pages.equal')</option>
                                    <option value="!=">@lang('pages.notequal')</option>
                                    <option value="like">@lang('pages.contains')</option>
                                    <option value="not like">@lang('pages.notcontains')</option>
                                    <option value=">">@lang('pages.more')</option>
                                    <option value="<">@lang('pages.less')</option>
                                </select>
                            </div>
                        </div>

                        {!! Form::label($search_code, 'Searching', ['class' => 'col-md-1 control-label']) !!}
                        <div class="col-md-5">
                            <div class="input-group">
                                <input autofocus name="search" class="form-control" placeholder="@lang('pages.search')"
                                    type="text">
                                <span class="input-group-btn">
                                    <button type="submit" class="btn btn-primary">@lang('pages.search_button')</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}

                </div>

                <div class="form-group">
                    {!! Form::open(['route' => $route_delete, 'class' => 'form-horizontal', 'files' => true]) !!}

                    <table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
                        <thead>
                            <tr>
                                @foreach($fields as $item => $value)
                                <th class="{{ $value['class'] ?? '' }}">
                                    <strong>{{ $value['name'] }}</strong>
                                </th>
                                @endforeach
                                <th width="9" class="center"><input id="checkAll" class="selectall"
                                        onclick="toggle(this)" type="checkbox"></th>

                                <th class="text-center" width=100>
                                    <strong>Actions</strong>
                                </th>
                            </tr>
                        </thead>
                    </table>
                    @include($template_action)
                    {!! Form::close() !!}
                </div>

            </div>

        </div>

    </div>
</div>

@endsection