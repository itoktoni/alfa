<?php

namespace Modules\Linen\Dao\Repositories;

use Illuminate\Database\QueryException;
use Kirschbaum\PowerJoins\PowerJoins;
use Modules\Linen\Dao\Models\MasterStock;
use Modules\Linen\Dao\Models\Stock;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Notes;

class StockRepository extends Stock implements CrudInterface
{    
    use PowerJoins;
    
    public function dataRepository()
    {
        $list = Helper::dataColumn($this->datatable);
        return $this->select($list);
    }

    public function saveRepository($request)
    {
        try {
            unset($request['_token']);
            $activity = $this->updateOrCreate(['linen_outstanding_rfid' => $request['linen_outstanding_rfid']], $request);
            return Notes::create($activity);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function batchSelectRepository($code)
    {
        return $this->select('linen_outstanding_rfid')->whereIn('linen_outstanding_rfid', $code);
    }

    public function batchSaveRepository($request)
    {
        try {
            $activity = $this->insert($request);
            return Notes::create(array_keys($request));
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function batchDeleteRepository($rfid)
    {
        try {
            $activity = $this->whereIn('linen_outstanding_rfid' , $rfid)->delete();
            return Notes::delete($activity);
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
