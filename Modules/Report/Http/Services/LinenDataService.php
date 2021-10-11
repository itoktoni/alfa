<?php

namespace Modules\Report\Http\Services;

use Modules\Report\Http\Resources\LinenCollection;
use Yajra\DataTables\Facades\DataTables;
use Modules\System\Http\Services\DataService;

class LinenDataService extends DataService
{
    public function make()
    {
        $this->setFilter();

        if (!request()->ajax()) {

            $pagination = request()->get('page') ? $this->filter->paginate(request()->get('limit') ?? config('website.pagination')) : $this->filter->get();
            return new LinenCollection($pagination);
        }

        $request = request()->all();
        $filter = $this->filter;

        if($rfid = $request['report_linen_rfid']){
            $filter = $filter->where('report_linen_rfid', $rfid);
        }
        if($company = $request['report_linen_company_id']){
            $filter = $filter->where('report_linen_company_id', $company);
        }
        if($location = $request['report_linen_location_id']){
            $filter = $filter->where('report_linen_location_id', $location);
        }
        if($product = $request['report_linen_product_id']){
            $filter = $filter->where('report_linen_product_id', $product);
        }
        if($create = $request['report_linen_created_at']){
            $filter = $filter->whereDate('report_linen_created_at', $create);
        }
        if($register = $request['report_linen_created_by']){
            $filter = $filter->where('report_linen_created_by', $register);
        }
        if($status = $request['status']){
            $filter = $filter->where('report_linen_status', $status);
        }
        if($rent = $request['rent']){
            $filter = $filter->where('report_linen_rent', $rent);
        }

        $this->datatable = Datatables::of($this->filter);
        $this->setAction();
        $this->setStatus();
        $this->setImage();
        $this->datatable->rawColumns($this->column);
        return $this->datatable->make(true);
    }
}
