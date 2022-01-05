<?php

namespace Modules\Item\Dao\Repositories;

use Illuminate\Database\QueryException;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Item\Dao\Models\Linen;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Notes;
use Kirschbaum\PowerJoins\PowerJoins;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Models\LinenDetail;

class LinenRepository extends Linen implements CrudInterface
{
    public function dataRepository()
    {
        $list = Helper::dataColumn($this->datatable);
        return $this->select($list);
    }

    public function linenDetailRepository()
    {
        return LinenDetailFacades::query()->select('*')->leftJoin(LinenFacades::getTable(), LinenFacades::getKeyName(), LinenDetailFacades::mask_rfid());
    }

    public function saveRepository($request)
    {
        try {
            $activity = $this->create($request);
            return Notes::create($activity);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function updateRepository($request, $code)
    {
        try {
            $update = $this->withTrashed()->findOrFail($code);
            $update->update($request);
            return Notes::update($update->toArray());
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function deleteRepository($request)
    {
        try {
            is_array($request) ? $this->destroy(array_values($request)) : $this->destroy($request);
            return Notes::delete($request);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function singleRepository($code, $relation = false)
    {
        if ($relation) {
            return $this->withTrashed()->with($relation)->findOrFail($code);
        }
        return $this->withTrashed()->findOrFail($code);
    }
    
    public function rfidRepository($code){
        
        return $this->with(['has_location', 'has_product', 'has_company'])->find($code);
    }

    public function getTotal($company, $location, $product){

        return $this
        ->where('item_linen_company_id', $company)
        ->where('item_linen_location_id', $location)
        ->where('item_linen_product_id', $product);
    }

}
