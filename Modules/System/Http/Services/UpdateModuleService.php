<?php

namespace Modules\System\Http\Services;

use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;
use Illuminate\Support\Str;

class UpdateModuleService extends UpdateService
{
    public $visible = [
        'create', 'list', 'create', 'index', 'stock', 'report'
    ];

    public $method = [
        'create' => 'GET', 
        'save' => 'POST', 
        'list' => 'GET', 
        'data' => 'POST', 
        'edit' => 'GET', 
        'update' => 'POST', 
        'delete' => 'POST', 
        'index' => 'GET', 
        'report' => 'GET',
        'show' => 'GET',
        'patch' => 'POST',
        'master' => 'POST',
        'batch' => 'POST',
        'download' => 'GET',
        'get' => 'GET',
    ];

    public $api = [
        'save' => 1,
        'data' => 1,
        'update' => 1,
        'delete' => 1,
        'get' => 1,
        'patch' => 1,
        'master' => 1,
        'batch' => 1,
        'download' => 1,
    ];

    public function update(CrudInterface $repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        if ($check['status']) {

            $getData = $check['data'] ?? [];
            $getData->action()->delete();
            
            foreach ($data->get('list_action') as $function) {
                $visible = '0';
                
                $metode = $this->method[$function] ?? 'GET';
                if (in_array($function, $this->visible)) {
                    $visible = '1';
                }

                if (strpos($code, 'report') !== false) {
                    
                    $visible = '1';
                    $metode = 'GET';

                    if (strpos($function, 'Export') !== false || strpos($function, 'export') !== false) {
                        $visible = '0';
                        $metode = 'POST';
                    }
                }


                $split = explode('_', $function);
                $name = ucwords(str_replace('_', ' ', $function)) . ' ' . $getData->system_module_controller;
                if (count($split) > 1) {
                    $name = ucwords(str_replace('_', ' ', Str::snake($function)));
                }
                $name = str_replace('Index', 'List', $name);

                $pathSave = '\App\Http\Controllers\\' . $getData->system_module_controller . 'Controller';
                if ($getData->system_module_folder) {
                    $pathSave = '\Modules\\' . ucfirst($getData->system_module_folder) . '\Http\Controllers\\' . $getData->system_module_controller . 'Controller';
                }

                $getData->action()->create([
                    'system_action_code' => $code . '_' . Str::snake($function),
                    'system_action_module' => $code,
                    'system_action_name' => ucwords(str_replace('_', ' ', Str::snake($name))),
                    'system_action_link' => $code . '/' . Str::snake($function),
                    'system_action_controller' => $getData->system_module_controller,
                    'system_action_function' => $function,
                    'system_action_sort' => 1,
                    'system_action_show' => $visible,
                    'system_action_enable' => 1,
                    'system_action_path' => $pathSave,
                    'system_action_method' => $metode ?? '',
                    'system_action_api' => $this->api[$function] ?? 0,
                ]);
            }

            if($data->get('actions')){
                $list_action = [];
                foreach($data->get('actions') as $method){
                    $list_action[] = Str::snake($method);
                }
                $getData->connection_action()->sync($list_action);
            }

            $getData->connection_group_module()->sync($data->get('groups'));
        }

        if ($check['status']) {
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
