<?php

namespace Modules\Linen\Http\Services;

use Modules\Linen\Dao\Facades\OpnameFacades;
use Modules\Linen\Dao\Models\OpnameDetail;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class OpnameCreateService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        try {
            OpnameDetail::upsert($data['detail'], [
                'linen_opname_detail_rfid',
                'linen_opname_detail_key'
            ]);

            unset($data['detail'], $data['rfid']);
            $check = OpnameFacades::updateOrCreate([
                OpnameFacades::getKeyName() => $data->{OpnameFacades::getKeyName()}
            ], $data->all());

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
