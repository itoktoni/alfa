<?php

namespace Modules\Linen\Http\Services;

use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Http\Resources\LinenCollection;
use Modules\Linen\Http\Resources\OutstandingCollection;
use Yajra\DataTables\Facades\DataTables;
use Modules\System\Http\Services\DataService;

class DeliveryDataService extends DataService
{
    public function make()
    {
        $this->setFilter();

        if (!request()->ajax()) {
            
            $pagination = request()->get('page') ? $this->filter->paginate(request()->get('limit') ?? config('website.pagination')) : $this->filter->get();
            return new OutstandingCollection($pagination);
        }

        $request = request()->all();
        $filter = $this->filter;

        if($key = $request['linen_delivery_key']){
            $filter = $filter->where('linen_delivery_key', $key);
        }
        if($date_from = $request['date_from']){
            $filter = $filter->where('linen_delivery_reported_date','>=', $date_from);
        }
        if($date_to = $request['date_to']){
            $filter = $filter->where('linen_delivery_reported_date', '<=', $date_to);
        }
        if($company_ori = $request['linen_delivery_company_id']){
            $filter = $filter->where('linen_delivery_company_id', $company_ori);
        }
        if($create = $request['linen_delivery_created_by']){
            $filter = $filter->where('linen_delivery_created_by', $create);
        }

        $this->datatable = Datatables::of($this->filter);
        $this->setAction();
        $this->setStatus();
        $this->setImage();
        $this->datatable->rawColumns($this->column);
        $this->datatable->orderColumn('linen_delivery_created_at', '-linen_delivery_created_at $1');
        return $this->datatable->make(true);
    }
}
