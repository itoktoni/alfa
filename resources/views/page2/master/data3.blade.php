@extends(Helper::setExtendBackend())
@component('components.responsive', ['array' => $fields])
@endcomponent
@component('components.datatables',['array' => $fields])@endcomponent
@section('content')
<div class="row">
    <div class="panel-body">

        <div class="panel-body">

            <div class="card" id="scheduleCard"
                style="box-shadow: 0 1px 8px rgb(0 0 1 / 20%);border-radius: 8px;padding:15px 10px">
                <div class="card-body pb-2">
                    {!! Form::open(['route' => $action_code, 'id' => 'search-form', 'files' => true]) !!}

                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group mb-0">
                                <select name="code" class="form-control">
                                    <option value="">@lang('pages.search')</option>
                                    @foreach($fields as $item => $value)
                                    <option value="{{ $item }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group mb-0">
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

                        <div class="col-md-4 col-xl-2 px-md-2">
                            <div class="form-group mb-0">

                                <div class="input-group">
                                    <input autofocus name="search" class="form-control"
                                        placeholder="@lang('pages.search')" type="text">
                                    <span class="input-group-btn">
                                        <button type="submit"
                                            class="btn btn-primary">@lang('pages.search_button')</button>
                                    </span>
                                </div>
                            </div>
                        </div>

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        </div>

        {!! Form::open(['route' => $module.'_delete', 'class' => 'form-horizontal', 'files' => true]) !!}

        <div id="selection" class="row">
            <div class="col-xs-12 visible-xs">
                <button type="button" class="btn btn-default">
                    <input type="checkbox" id="checkAll" onClick="toggle(this)" class="selectall" />
                </button>
            </div>
        </div>
        <div class="panel-body line">
            <div class="table-control">
                <div>
                    <table id="datatable" class="responsive table-striped table-condensed table-bordered table-hover">
                        <thead>
                            <tr>
                                @php
                                $status = [
                                'Images',
                                'Active',
                                'Default',
                                'Status',
                                'Paid',
                                'Visible',
                                'Homepage',
                                'Total',
                                'Price',
                                ];
                                $sort = [
                                'Sort',
                                'Qty',
                                'Size',
                                'Stock',
                                ];
                                @endphp
                                @foreach($fields as $item => $value)<th {!! strpos($value, 'Description' ) !==false
                                    ? ' id="description"' : '' !!} {!! in_array($value, $sort) ? ' id="sort"' : '' !!}
                                    {!! $value=='Type' ? ' id="type"' : '' !!} {!! $value=='Ongkir' ? ' id="ongkir"'
                                    : '' !!} {!! $value=='Full Name' ? ' id="fullname"' : '' !!} {!! in_array($value,
                                    $status) ? ' id="status"' : '' !!}>
                                    <strong>{{ $value }}</strong>
                                </th>
                                @endforeach
                                <th width="5" class="center"><input id="checkAll" class="selectall"
                                        onclick="toggle(this)" type="checkbox"></th>
                                @php
                                $button = '100';
                                if(session()->has('button')){
                                $button = session('button') > 4 ? '150' : '100';
                                }
                                @endphp
                                <th style="width: {{ $button }}px !important;" class="text-center">
                                    @if($actions->count() > 0 ) <strong>Actions</strong> @endif</th>
                            </tr>
                        </thead>
                    </table>
                </diV>
            </div>
        </div>
        @include($template_action)
        {!! Form::close() !!}
    </div>
</div>

@endsection