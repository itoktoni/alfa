@extends(Helper::setExtendBackend())
@push('js')
<script src="{{ Helper::backend('vendor/jquery-datatables/media/js/jquery.dataTables.min.js') }}"></script>
@endpush
@push('javascript')
<script>
    $(document).ready(function(){
            $("#basic-laratable").DataTable({
                serverSide: true,
                method : 'POST',
                ajax: "{!! route($module.'_delete') !!}",
                columns: [
                    { name: 'name' },
                    { name: 'email' },
                    { name: 'group_user' },
                ],
            });
        });
</script>
@endpush
@section('content')
<div class="row">
    <div class="panel-body">
        <header class="panel-heading">
            <h2 class="panel-title text-right">
                List {{ ucwords(str_replace('_',' ',$template)) }}
            </h2>
        </header>
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
                    <table id="basic-laratable" class="responsive table-striped table-condensed table-bordered table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Start Date</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection