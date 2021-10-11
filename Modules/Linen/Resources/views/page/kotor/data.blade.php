@extends(Views::backend())

@component('components.responsive', ['array' => $fields])
@endcomponent

<x-date :array="['date']" />

@push('js')
<script src="{{ Helper::backend('vendor/jquery-datatables/media/js/jquery.dataTables.min.js') }}"></script>
@endpush
@push('javascript')
{{-- for datatable and parse fields --}}
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        var oTable = $('#datatable').DataTable({
            processing: true,
            orderCellsTop: true,
            fixedHeader: true,
            dom: '<<t>p><"pull-left"i>',
            serverSide: true,
            order: [[5, 'asc']],
            pageLength: {{ config('website.pagination') }},
            pagingType: 'first_last_numbers',
            ajax: {
            url: '{{ route($route_data) }}',
                method : 'POST',
                data: function(d) {
                    d.code = $('select[name=code]').val();
                    d.search = $('input[name=search]').val();
                    d.aggregate = $('select[name=aggregate]').val();
                    d.linen_kotor_key = $('input[name=linen_kotor_key]').val();
                    d.date_from = $('input[name=date_from]').val();
                    d.date_to = $('input[name=date_to]').val();
                    d.linen_kotor_company_id = $('select[name=linen_kotor_company_id]').val();
                    d.linen_kotor_created_by = $('select[name=linen_kotor_created_by]').val();
                },
                error: function (xhr, textStatus, errorThrown) {
                    new PNotify({
                        title: 'Datatable Error !',
                        text: {{ config('website.env') == 'local' ? 'xhr.responseJSON.message' : 'errorThrown' }},
                        type: 'error',
                        hide: false
                    });
                }
            },
            columns: 
            [
                @foreach($fields as $key => $value)
                {data: '{{ $key }}', name: '{{ $key }}', orderable: true, searchable: true},
                @endforeach
                {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
        });

        $('#search-form').on('submit', function(e) {
            oTable.draw();
            e.preventDefault();
        });
    });

    
</script>
@endpush

<x-date :array="['date']" />

@section('content')

<div class="row">
    <div class="panel-body">

        <div class="panel panel-default">
            <header class="panel-heading">
                <h2 class="panel-title">{{ __('Data') }} {{ __($form_name) }}
                </h2>
            </header>

            <div class="panel-body line wrap">

                <div class="filter-data form-group">
                    {!! Form::open(['route' => $route_data, 'id' => 'search-form', 'files' => true]) !!}
                    <div class="form-horizontal">

                        <div class="group-search">
                            <div class="form-group">
                               
                                <div class="col-md-3 col-sm-2">
                                    <div class="row input-group filter-search space-sm">
                                    <span class="input-group-addon">
                                        {{ __('No. Transaksi') }}
                                    </span>
                                    {!! Form::text('linen_kotor_key', null, ['class' => 'form-control', 'id' => 'linen_kotor_key']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-2 {{ $errors->has($search_code) ? 'has-error' : ''}}">
                                    <div class="row input-group filter-search space-sm">
                                    <span class="input-group-addon">
                                        {{ __('Rumah Sakit') }}
                                    </span>
                                    {{ Form::select('linen_kotor_company_id', $company, null, ['class'=> 'form-control ']) }}
                                    </div>
                                </div>
                                
                                <div class="col-md-3 col-sm-2 {{ $errors->has($search_code) ? 'has-error' : ''}}">
                                    <div class="row input-group filter-search space-sm">
                                    <span class="input-group-addon">
                                        {{ __('Date From') }}
                                    </span>
                                    {!! Form::text('date_from', old('date_from') ?? date('Y-m-d'), ['class' => 'form-control date', 'id' => 'linen_kotor_reported_date']) !!}
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-2 {{ $errors->has($search_code) ? 'has-error' : ''}}">
                                    <div class="row input-group filter-search space-sm">
                                    <span class="input-group-addon">
                                        {{ __('Date To') }}
                                    </span>
                                    {!! Form::text('date_to', old('date_to') ?? date('Y-m-d'), ['class' => 'form-control date', 'id' => 'linen_kotor_reported_date']) !!}
                                    </div>
                                </div>

                            </div>

                            <div class="form-group">

                                <div class="col-md-3 col-sm-2 {{ $errors->has($search_code) ? 'has-error' : ''}}">
                                    <div class="row input-group filter-search space-sm">
                                    <span class="input-group-addon">
                                        {{ __('Created By') }}
                                    </span>
                                    {{ Form::select('linen_kotor_created_by', $user, null, ['class'=> 'form-control ']) }}
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-2 {{ $errors->has($search_code) ? 'has-error' : ''}}">
                                    <div class="row input-group filter-search space-sm">
                                        <span class="input-group-addon">
                                            {{ __('Criteria') }}
                                        </span>
                                    <select name="code" class="form-control">
                                        <option value="">{{ __('Select Data') }}</option>
                                        @foreach($fields as $item => $value)
                                        <option value="{{ $item }}">{{ __($value['name']) }}</option>
                                        @endforeach
                                    </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-2 {{ $errors->has($search_code) ? 'has-error' : ''}}">
                                    <div class="row input-group filter-search space-sm">
                                        <span class="input-group-addon">
                                            {{ __('Operator') }}
                                        </span>
                                        <select name="aggregate" class="form-control">
                                            <option value="">{{ __('Search With') }}</option>
                                            <option value="=">{{ __('Equal') }}</option>
                                            <option value="!=">{{ __('Not Equal') }}</option>
                                            <option value="like">{{ __('Contains') }}</option>
                                            <option value="not like">{{ __('Not Contains') }}</option>
                                            <option value=">">{{ __('More Than') }}</option>
                                            <option value="<">{{ __('Less Than') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-sm-12">
                                    <div class="row input-group filter-search space-sm">
                                        <span class="input-group-addon">
                                            {{ __('Searching') }}
                                        </span>
                                        <input autofocus name="search" class="form-control" placeholder="{{ __('Advance Search') }}"
                                            type="text">
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
                                        </span>
                                    </div>
                                </div>

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
                                    <strong>{{ __($value['name']) }}</strong>
                                </th>
                                @endforeach
                                <th width="9" class="center"><input id="checkAll" class="selectall"
                                        onclick="toggle(this)" type="checkbox"></th>

                                <th class="text-center" width=70>
                                    <strong>{{ __('Actions') }}</strong>
                                </th>
                            </tr>
                            
                        </thead>
                    </table>
                    <div class="navbar-fixed-bottom" id="menu_action">
                        <div class="text-right action-wrapper">

                            <a class="btn btn-success" href="{{ route(Route::currentRouteName()) }}">{{ __('Refresh') }}</a>
                            
                            <button type="submit" onclick="return confirm('Are you sure to delete data ?');" id="delete-action"
                                value="delete" name="action" class="btn btn-danger">{{ __('Delete') }}</button>
                            
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>

            </div>

        </div>

    </div>
</div>

@endsection