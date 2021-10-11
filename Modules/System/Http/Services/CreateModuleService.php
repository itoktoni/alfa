<?php

namespace Modules\System\Http\Services;

use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class CreateModuleService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        try {
            $insert = $data->all();

            $pathSave = '\Modules\\' . ucfirst($data->get('system_module_folder')) . '\Http\Controllers\\' . $data->get('system_module_controller') . 'Controller';
            $insert['system_module_link'] = strtolower($data->get('system_module_folder')).'/'.$data->get('system_module_code');
            $insert['system_module_show'] = 1;
            $insert['system_module_api'] = 1;
            $insert['system_module_path'] = $pathSave;

            $check = $repository->saveRepository($insert);
            if(isset($check['status']) && $check['status']){

                Alert::create();
            }
            else{
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    } 
}
