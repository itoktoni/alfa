@push('javascript')
@foreach($selector as $select)
<script>
    $('.{{ $select }}').click(function() {
        // var userid = $(this).data('id');

        // AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('rajaongkir_area_popup') }}",
            type: 'GET',
            data: {
                selector: '{{ $select }}'
            },
            success: function(response) {
                // Add response in Modal body
                $('#popup').html(response);

                // Display Modal
                $('#ModalArea').modal('show');
            }
        });
    });
</script>
@endforeach
@endpush

@push('partial')
<div class="modal fade" id="ModalArea" role="dialog">
    <div class="modal-dialog">
        <div id="popup" class="modal-content">
        </div>
    </div>
</div>
@endpush