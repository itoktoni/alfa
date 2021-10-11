<?php

namespace Modules\Linen\Http\Services;

use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Http\Resources\LinenCollection;
use Modules\Linen\Http\Resources\OutstandingCollection;
use Yajra\DataTables\Facades\DataTables;
use Modules\System\Http\Services\DataService;

class StockDataService extends DataService
{
    public function make()
    {
        $this->setFilter();

        $request = request()->all();
        $filter = $this->filter;

        if($key = $request['linen_stock_company_id']){
            $filter = $filter->where('linen_stock_company_id', $key);
        }
        if($key = $request['linen_stock_item_product_id']){
            $filter = $filter->where('linen_stock_item_product_id', $key);
        }

        $this->datatable = Datatables::of($this->filter);
        $this->setAction();
        $this->setStatus();
        $this->setImage();
        $this->datatable->rawColumns($this->column);
        return $this->datatable->make(true);
    }
}
