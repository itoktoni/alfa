<?php

namespace Modules\Linen\Http\Services;

use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Http\Resources\LinenCollection;
use Modules\Linen\Http\Resources\OutstandingCollection;
use Yajra\DataTables\Facades\DataTables;
use Modules\System\Http\Services\DataService;

class OutstandingDataService extends DataService
{
    public function make()
    {
        $this->setFilter();

        if (!request()->ajax()) {

            if(request()->get('status')){
                return [
                    'status' => true,
                    'code' => 200,
                    'name' => 'list',
                    'message' => 'Data berhasil di ambil',
                    'data' => [
                        'description' => collect(OutstandingFacades::description())->map(function($item, $key){
                            return ['id' => strval($key), 'name' => $item[0]];
                        })->toArray(),
                        'status' => collect(OutstandingFacades::status())->map(function($item, $key){
                            return ['id' => strval($key), 'name' => $item[0]];
                        })->toArray(),
                    ]
                ];
            }
            
            $pagination = request()->get('page') ? $this->filter->paginate(request()->get('limit') ?? config('website.pagination')) : $this->filter->get();
            return new OutstandingCollection($pagination);
        }

        $request = request()->all();
        $filter = $this->filter;

        if($key = $request['linen_outstanding_key']){
            $filter = $filter->where('linen_outstanding_key', $key);
        }
        if($rfid = $request['linen_outstanding_rfid']){
            $filter = $filter->where('linen_outstanding_rfid', $rfid);
        }
        if($company_ori = $request['linen_outstanding_ori_company_id']){
            $filter = $filter->where('linen_outstanding_ori_company_id', $company_ori);
        }
        if($location_ori = $request['linen_outstanding_ori_location_id']){
            $filter = $filter->where('linen_outstanding_ori_location_id', $location_ori);
        }
        if($company_scan = $request['linen_outstanding_scan_company_id']){
            $filter = $filter->where('linen_outstanding_scan_company_id', $company_scan);
        }
        if($product = $request['linen_outstanding_product_id']){
            $filter = $filter->where('linen_outstanding_product_id', $product);
        }
        if($create = $request['linen_outstanding_created_by']){
            $filter = $filter->where('linen_outstanding_created_by', $create);
        }
        // if($register = $request['item_linen_created_by']){
        //     $filter = $filter->where('item_linen_created_by', $register);
        // }
        if($status = $request['status']){
            $filter = $filter->where('linen_outstanding_status', $status);
        }
        if($description = $request['description']){
            $filter = $filter->where('linen_outstanding_description', $description);
        }

        $this->datatable = Datatables::of($this->filter);
        $this->setAction();
        $this->setStatus();
        $this->setImage();
        $this->datatable->rawColumns($this->column);
        return $this->datatable->make(true);
    }
}
