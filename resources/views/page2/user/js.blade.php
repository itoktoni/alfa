
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function product2(search) {

        if (search.length >= 5) {
            $.typeahead({
                input: '#product',
                maxItem: 5,
                debug: false,
                order: "asc",
                source: {
                    car: {
                        ajax: {
                            type: "POST",
                            url: "{{ route('produk') }}",
                            data: {
                                search: $('input[name=product]').val()
                            }
                        }
                    }
                },
                callback: {
                    onClick: function(node, a, item, event) {

                        var dat = item.display.split('(');
                        var produk = dat[1];
                        $('#produk').val(produk.replace(')', ''));

                    }
                }
            });
        }
    }

    function customer2(search) {

        if (search.length >= 5) {
            $.typeahead({
                input: '#customer',
                maxItem: 5,
                debug: false,
                order: "asc",
                source: {
                    car: {
                        ajax: {
                            type: "POST",
                            url: "{{ route('customer') }}",
                            data: {
                                search: $('input[name=customer]').val()
                            }
                        }
                    }
                },
                callback: {
                    onClick: function(node, a, item, event) {

                        var dat = item.display.split('(');
                        var produk = dat[1];
                        $('#segmentasi').val(produk.replace(')', ''));

                    }
                }
            });
        }
    }

</script>


