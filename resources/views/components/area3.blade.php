@push('javascript')
<script>
$(document).ready(function() {
    $('.area').click(function() {
        // var userid = $(this).data('id');

        // AJAX request
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            url: "{{ route('rajaongkir_area_popup') }}",
            type: 'get',
            data: {
                // userid: userid
            },
            success: function(response) {
                // Add response in Modal body
                $('#popup').html(response);

                // Display Modal
                $('#ModalArea').modal('show');
            }
        });
    });
});
</script>
@endpush

@push('partial')
<div class="modal fade" id="ModalArea" role="dialog">
    <div class="modal-dialog">
        <div id="popup" class="modal-content">

        </div>
    </div>
</div>
@endpush