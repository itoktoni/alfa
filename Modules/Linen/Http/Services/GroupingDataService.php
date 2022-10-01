<?php

namespace Modules\Linen\Http\Services;

use Modules\Linen\Dao\Facades\GroupingFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Http\Resources\LinenCollection;
use Modules\Linen\Http\Resources\OutstandingCollection;
use Yajra\DataTables\Facades\DataTables;
use Modules\System\Http\Services\DataService;
use Modules\System\Plugins\Notes;

class GroupingDataService extends DataService
{
    public function make()
    {
        $this->setFilter();

        $request = request()->all();
        $filter = $this->filter;

        if (!request()->ajax()) {

            if(isset($request[GroupingFacades::mask_status()])){
                $status = $request[GroupingFacades::mask_status()];
                $filter = $filter->where(GroupingFacades::mask_status(), $status);
            }
            if(isset($request[GroupingFacades::mask_company_id()])){
                $company = $request[GroupingFacades::mask_company_id()];
                $filter = $filter->where(GroupingFacades::mask_company_id(), $company);
            }

            $response = $filter->get()->toArray();

            return Notes::data([
                "total" => count($response),
                "data" => $response
            ]);
        }

        $this->datatable = Datatables::of($filter);
        $this->setAction();
        $this->setStatus();
        $this->setImage();
        $this->setColumn();

        $this->datatable->rawColumns($this->column);
        return $this->datatable->make(true);
    }
}
