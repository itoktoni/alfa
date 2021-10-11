<?php

namespace Modules\Linen\Http\Services;

use Modules\Linen\Dao\Models\GroupingDetail;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class GroupingCreateService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        try {
            GroupingDetail::insert($data['detail']);
            $check = $repository->saveRepository($data->all());

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
