<?php

namespace Modules\System\Dao\Repositories;

use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Notes;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\QueryException;
use Modules\System\Dao\Interfaces\CoreInterface;
use Modules\System\Dao\Models\GroupModule;
use Modules\System\Dao\Models\GroupModuleConnectionModule;
use Modules\System\Dao\Models\ModuleConnectionAction;

class ModuleActionRepository extends GroupModule implements CoreInterface
{
    public static $module;
    public static $module_connection_action;
    public static $action;
    public static $group_module_connection_module;

    public function __construct(ModuleRepository $module, ActionRepository $action, ModuleConnectionAction $module_connection_action, GroupModuleConnectionModule $group_module_connection_module)
    {
        self::$module = $module;
        self::$action = $action;
        self::$group_module_connection_module = $group_module_connection_module;
        self::$module_connection_action = $module_connection_action;
    }

    public function deleteModule($folder)
    {
        return DB::table(self::$module->getTable())->where('module_folder', $folder)->delete();
    }

    public function saveModule($code, $moduleName, $controller, $folder, $enable, $sort = 1, $description = null)
    {
        return DB::table(self::$module->getTable())->insert([

            'module_code'        => $code,
            'module_name'        => $moduleName,
            'module_link'        => $code,
            'module_controller'  => $controller,
            'module_folder'      => $folder,
            'module_enable'      => $enable,
            'module_sort'        => $sort,
            'module_description' => $description,
            'module_single'      => 0,
            'module_visible'     => 1,
            'module_module'      => 1,
        ]);
    }

    public function deleteAction($code)
    {
        return DB::table(self::$action->getTable())->where('action_code', 'like', "$code%")->delete();
    }

    public function checkModuleConnectionAction($action, $module)
    {
        $act = DB::table(self::$module_connection_action->getTable());
        $act->where('conn_ma_action', '=', $action);
        $act->where('conn_ma_module', '=', $module);
        if ($act->count() > 0) {
            return true;
        }
        return false;
    }


    public function deleteModuleConnectionAction($code)
    {
        return DB::table(self::$module_connection_action->getTable())->where('conn_ma_module', 'like', "$code%")->delete();
    }

    public function saveAction($code, $name, $link, $controller, $function, $path, $visible)
    {
        return DB::table(self::$action->getTable())->insert([
            'action_code'       => $code . '_' . $link,
            'action_module'     => $code,
            'action_name'       =>  ucwords(str_replace('_', ' ', Str::snake($name))),
            'action_link'       => $code . '/' . $link,
            'action_controller' => $controller,
            'action_function'   => $function,
            'action_path'       => $path,
            'action_sort'       => 0,
            'action_visible'    => $visible,
            'action_enable'     => '1',
        ]);
    }

    public function saveModuleAction($module, $action)
    {
        return DB::table(self::$module_connection_action->getTable())->insert([
            'conn_ma_module' => $module,
            'conn_ma_action' => $module . '_' . $action
        ]);
    }

    public function saveGroupModule($code, $data)
    {
        try {
            DB::beginTransaction();
            DB::table(self::$group_module_connection_module->getTable())->where('conn_gm_module', '=', $code)->delete();
            $activity = [];
            if (!empty(request()->get('group'))) {
                foreach ($data as $group) {
                    $select = DB::table(self::$group_module_connection_module->getTable());
                    $select->where('conn_gm_group_module', '=', $group);
                    $select->where('conn_gm_module', '=', $code);
                    $select->get();
                    if ($select->Count() > 0) { } else {
                        $activity = [
                            'conn_gm_group_module' => $group,
                            'conn_gm_module' => $code,
                        ];
                        DB::table(self::$group_module_connection_module->getTable())->insert($activity);
                    }
                }
            }
            DB::commit();

            return Notes::create($activity);
        } catch (QueryException $ex) {
            DB::rollBack();
            return Notes::error($ex->getMessage());
        }
    }


    public function showRepository($id, $relation = null)
    {
        if ($relation) {
            return $this->with($relation)->findOrFail($id);
        }
        return $this->findOrFail($id);
    }
}
