<table class="table table-no-more table-bordered table-striped mb-none">
                        <thead>
                            <tr>
                                <th style="width: 2%;" class="text-left">No.</th>
                                <th class="text-left col-md-2">Product Name</th>
                                <th class="text-left col-md-1">Stock Awal</th>
                                <th class="text-left col-md-1">Hasil Opname</th>
                                <th class="text-left col-md-1">Pending Obsesiman</th>
                                <th class="text-left col-md-1">Hilang Obsesiman</th>
                                <th class="text-left col-md-1">Hilang Rs.</th>
                            </tr>
                        </thead>
                        <tbody class="markup">

                            @if($register)
                            @foreach ($register as $item)
                            @php
                            $qty_opname = isset($opname[$item->view_product_id]) ? $opname[$item->view_product_id]->count() : 0;
                            $qty_pending = $qty_hilang = 0;
                            if($lock){
                            $qty_pending = $lock->where('linen_outstanding_status','!=', LinenStatus::Hilang)->where('linen_outstanding_product_id', $item->view_product_id)->count() ?? 0;
                            $qty_hilang = $lock->where('linen_outstanding_status', LinenStatus::Hilang)->where('linen_outstanding_product_id', $item->view_product_id)->count() ?? 0;
                            }
                            $qty_hilang_rs = $qty_opname - ($item->view_register - ($qty_pending + $qty_hilang));
                            @endphp
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->view_product_name ?? '' }}</td>
                                <td>{{ $item->view_register ?? '' }}</td>
                                <td>{{ $qty_opname ?? '' }}</td>
                                <td>{{ $qty_pending ?? '' }}</td>
                                <td>{{ $qty_hilang ?? '' }}</td>
                                <td>{{ abs($qty_hilang_rs) ?? '' }}</td>
                            </tr>
                            @endforeach
                            @endisset

                        </tbody>
                    </table>