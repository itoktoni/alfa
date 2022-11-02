<?php

namespace Modules\Item\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Models\Linen;
use Modules\Item\Http\Resources\LinenCollection;
use Yajra\DataTables\Facades\DataTables;
use Modules\System\Http\Services\DataService;
use Modules\System\Plugins\Notes;
use Modules\System\Plugins\Response;

class LinenDataService extends DataService
{
    public function make()
    {
        $this->setFilter();

        $request = request()->all();
        $filter = $this->filter;

        if (!request()->ajax()) {

            $pagination = request()->get('page') ? $this->filter->paginate(request()->get('limit') ?? config('website.pagination')) : $this->filter->get();
            if(isset($request['item_linen_rfid']) && $rfid = $request['item_linen_rfid']){
                $pagination = Linen::find($rfid);
                return [
                    'status' => true,
                    'code' => 200,
                    'name' => 'list',
                    'message' => 'Data berhasil di ambil',
                    'data' => [
                        'total' => 1,
                        'data' => $pagination,
                    ]
                ];
                // return Notes::data(['total' => 1, 'data' => $pagination]);
            }
            return new LinenCollection($pagination);
        }

        $filter = $filter->filter();
        if($rfid = $request['item_linen_rfid']){
            $filter = $filter->where('item_linen_rfid', $rfid);
        }
        if($company = $request['item_linen_company_id']){
            $filter = $filter->where('item_linen_company_id', $company);
        }
        if($location = $request['item_linen_location_id']){
            $filter = $filter->where('item_linen_location_id', $location);
        }
        if($product = $request['item_linen_product_id']){
            $filter = $filter->where('item_linen_product_id', $product);
        }
        if($create = $request['item_linen_created_at']){
            $filter = $filter->whereDate('item_linen_created_at', $create);
        }
        if($register = $request['item_linen_created_by']){
            $filter = $filter->where('item_linen_created_by', $register);
        }
        if($status = $request['status']){
            $filter = $filter->where('item_linen_status', $status);
        }
        if($rent = $request['rent']){
            $filter = $filter->where('item_linen_rent', $rent);
        }
        if($latest = $request['latest']){
            $filter = $filter->where('item_linen_latest', $latest);
        }

        $this->datatable = Datatables::of($this->filter);
        $this->setAction();
        $this->setStatus();
        $this->setImage();
        $this->datatable->rawColumns($this->column);
        return $this->datatable->make(true);
    }
}
