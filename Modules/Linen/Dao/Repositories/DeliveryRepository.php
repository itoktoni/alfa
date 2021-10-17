<?php

namespace Modules\Linen\Dao\Repositories;

use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Kirschbaum\PowerJoins\PowerJoins;
use Modules\Linen\Dao\Models\Delivery;
use Modules\Linen\Dao\Models\DeliveryDetail;
use Modules\Linen\Dao\Models\GroupingDetail;
use Modules\Linen\Dao\Models\MasterOutstanding;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Notes;

class DeliveryRepository extends Delivery implements CrudInterface
{
    use PowerJoins;
    
    public function dataRepository()
    {
        $list = Helper::dataColumn($this->datatable);
        return $this->select($list)->leftJoinRelationship('has_user');
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

    public function batchSelectRepository($code)
    {
        return $this->select('linen_outstanding_rfid')->whereIn('linen_outstanding_rfid', $code);
    }

    public function batchSaveRepository($request)
    {
        try {
            $activity = GroupingDetail::insert($request['detail']);
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

    public function masterRepository($request)
    {
        try {
            $activity = MasterOutstanding::create($request);
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
