<?php

namespace Modules\System\Http\Services;

use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class UpdateGroupUserService extends UpdateService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        if($check['status']){
            
            $getData = $check['data'] ?? [];
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
