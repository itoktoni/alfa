<?php

namespace Modules\System\Dao\Repositories;

use App\Models\User;
use Modules\System\Dao\Interfaces\CrudInterface;
use Illuminate\Database\QueryException;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Notes;

class TeamRepository extends User implements CrudInterface
{
    public function dataRepository()
    {
        $list = Helper::dataColumn($this->datatable);
        return $this->select($list);
    }

    public function saveRepository($request)
    {
        try {
            $request['password'] = bcrypt($request['password']);
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
            $request['password'] = bcrypt($request['password']);
            $update->update($request);
            return Notes::update($update);
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
