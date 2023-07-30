<?php

namespace Modules\System\Http\Services;

use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class UpdateCompanyService extends UpdateService
{
    public function update(CrudInterface $repository, $data, $code)
    {
        $check = $repository->updateRepository($data->all(), $code);
        if($check['status']){

            $getData = $check['data'] ?? [];
            $location = $product = [];
            if(isset($data->locations)){
                $location = $data->locations;
            }

            $getData->has_location()->sync($location);
        }

        if ($check['status']) {
            Alert::update();
        } else {
            Alert::error($check['data']);
        }
        return $check;
    }
}
