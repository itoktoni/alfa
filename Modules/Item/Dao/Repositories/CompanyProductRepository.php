<?php

namespace Modules\Item\Dao\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Kirschbaum\PowerJoins\PowerJoins;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Dao\Models\CompanyConnectionItemProduct;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Notes;

class CompanyProductRepository extends CompanyConnectionItemProduct implements CrudInterface
{
    use PowerJoins;
    
    public function dataRepository()
    {
        $list = Helper::dataColumn($this->datatable);
        return $this->select($list)->addSelect(DB::raw('company_item_target - company_item_realisasi as company_item_outstanding'))
        ->leftJoinRelationship('has_product')
        ->leftJoinRelationship('has_company')
        ->leftJoinRelationship('has_location')
        ->leftJoinRelationship('has_size')
        ->leftJoinRelationship('has_unit')->groupby($this->getKeyName());
    }

    public function getRealisasi($company, $product){

        return $this->where('company_id', $company)->where('item_product_id', $product);
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
            $update = $this->findOrFail($code);
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
            return $this->with($relation)->findOrFail($code);
        }
        return $this->findOrFail($code);
    }

}
