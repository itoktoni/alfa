<?php

namespace Modules\Linen\Http\Services;

use Modules\Linen\Dao\Enums\OpnameStatus;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Models\OpnameSummary;
use Modules\Linen\Http\Resources\LinenCollection;
use Modules\Linen\Http\Resources\OutstandingCollection;
use Yajra\DataTables\Facades\DataTables;
use Modules\System\Http\Services\DataService;
use Modules\System\Plugins\Notes;

class OpnameDataService extends DataService
{
    public function make()
    {
        $this->setFilter();

        if (!request()->ajax()) {

            $data = [];

            if ($opname = request()->get('linen_opname_key')) {
                $pagination = OpnameSummary::where('linen_opname_summary_master_id', $opname)->get();
            } else {

                $pagination =  $this->filter->select([
                    'linen_opname_key',
                    'linen_opname_company_id',
                    'linen_opname_company_name',
                    'linen_opname_status',
                ])->where('linen_opname_status', OpnameStatus::Proses)->get()->map(function ($item) {

                    $location = [];
                    if (isset($item->has_company->has_location)) {

                        $location = $item->has_company->has_location->map(function ($loc) {
                            return [
                                'location_id' => $loc->location_id,
                                'location_name' => $loc->location_name,
                            ];
                        });
                    }
                    $data['linen_opname_key'] = $item->linen_opname_key;
                    $data['linen_opname_company_id'] = $item->linen_opname_company_id;
                    $data['linen_opname_company_name'] = $item->linen_opname_company_name;
                    $data['linen_opname_status'] = $item->linen_opname_status;
                    $data['linen_opname_keterangan'] = OpnameStatus::getDescription($item->linen_opname_status);
                    $data['locations'] = $location->toArray();
                    return $data;
                });


                $data = [
                    'total' => $pagination->count(),
                    'data' => $pagination->toArray()
                ];
            }

            return Notes::data($data);
        }

        $request = request()->all();
        $filter = $this->filter;

        if ($key = $request['linen_opname_key']) {
            $filter = $filter->where('linen_opname_key', $key);
        }
        if ($date = $request['linen_opname_date']) {
            $filter = $filter->whereDate('linen_opname_date', $date);
        } 
        if ($date2 = $request['linen_opname_created_at']) {
            $filter = $filter->whereDate('linen_opname_created_at', $date2);
        }
        if ($company_ori = $request['linen_opname_company_id']) {
            $filter = $filter->where('linen_opname_company_id', $company_ori);
        }

        $this->datatable = Datatables::of($this->filter);
        $this->setAction();
        $this->setStatus();
        $this->setImage();
        $this->datatable->rawColumns($this->column);
        $this->datatable->orderColumn('linen_opname_created_at', '-linen_opname_created_at $1');
        return $this->datatable->make(true);
    }
}
