<?php

namespace Modules\System\Dao\Repositories;

use Modules\System\Dao\Interfaces\CrudInterface;
use Illuminate\Database\QueryException;
use Modules\System\Dao\Models\Module;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Notes;

class ModuleRepository extends Module implements CrudInterface
{
    public function dataRepository()
    {
        $list = Helper::dataColumn($this->datatable, $this->getKeyName());
        return $this->select($list);
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
            return Notes::update($update);
        } catch (QueryException $ex) {
            return Notes::error($ex->getMessage());
        }
    }

    public function deleteRepository($data)
    {
        try {
            is_array($data) ? $this->destroy(array_values($data)) : $this->destroy($data);
            return Notes::delete($data);
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
