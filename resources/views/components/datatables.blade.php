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
                dom: '<<t>p><"pull-left"i>',
                serverSide: true,
                order: [ [0, 'desc'] ],
                pageLength: {{ config('website.pagination') }},
                pagingType: 'first_last_numbers',
                ajax: {
                url: '{{ route($route_data) }}',
                    method : 'POST',
                    data: function(d) {
                        d.code = $('select[name=code]').val();
                        d.search = $('input[name=search]').val();
                        d.aggregate = $('select[name=aggregate]').val();
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
                columns: [
@foreach($array as $key => $value)
                            {data: '{{ $key }}', name: '{{ $key }}', searchable: false},
@endforeach
                            {data: 'checkbox', name: 'checkbox', orderable: false, searchable: false},
                            {data: 'action', name: 'action', orderable: false, searchable: false}
                        ]
        });

        $('#search-form').on('submit', function(e) {
            oTable.draw();
            e.preventDefault();
        });
    });

    
</script>
@endpush