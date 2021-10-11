<?php

namespace Modules\System\Dao\Repositories;

use Modules\System\Dao\Interfaces\CrudInterface;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Modules\System\Dao\Models\GroupModule;
use Modules\System\Dao\Models\GroupUser;
use Modules\System\Dao\Models\GroupUserConnectionGroupModule;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Notes;

class GroupUserRepository extends GroupUser implements CrudInterface
{
    public static $group_module;
    public static $group_user_connection_group_module;

    public function __construct()
    {
        if (self::$group_module == null) {
            self::$group_module = new GroupModule();
        }

        if (self::$group_user_connection_group_module == null) {
            self::$group_user_connection_group_module = new GroupUserConnectionGroupModule();
        }
    }
    
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

    public function getGroupByUser($user)
    {
        $select = DB::table(self::$group_module->getTable());
        $select->join(self::$group_user_connection_group_module->getTable(), self::$group_module->getKeyName(), '=', 'conn_gu_group_module');
        $select->where('conn_gu_group_user', $user)->orderBy('conn_gu_group_user', 'asc');
        return $select;
    }

    public function saveConnectionModule($code, $data)
    {
        try {
            DB::beginTransaction();
            DB::table(self::$group_user_connection_group_module->getTable())->where('conn_gu_group_user', '=', $code)->delete();
            if (!empty($data)) {
                foreach ($data as $group_module) {
                    $insert[] = [
                        'conn_gu_group_module' => $group_module,
                        'conn_gu_group_user' => $code
                    ];
                }
            }
            DB::table(self::$group_user_connection_group_module->getTable())->insert($insert);
            DB::commit();
            return Notes::create($insert);
        } catch (\Illuminate\Database\QueryException $ex) {
            DB::rollBack();
            return Notes::error($ex->getMessage());
        }
    }

}
