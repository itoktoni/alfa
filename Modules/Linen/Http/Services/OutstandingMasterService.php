<?php

namespace Modules\Linen\Http\Services;

use Modules\System\Plugins\Alert;

class OutstandingMasterService
{
    public function save($repository, $data)
    {
        $check = false;
        try {
            $check = $repository->masterRepository($data->all());
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
