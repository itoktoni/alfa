<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Linen\Dao\Facades\CardFacades;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\Linen\Dao\Models\KotorDetail;
use Modules\Linen\Dao\Models\Outstanding;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Notes;

class KotorCreateService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        // DB::beginTransaction();
        try {
            
            KotorDetail::insert($data['kotor']);
            Outstanding::insert($data['outstanding']);
            $check = $repository->saveRepository($data->all());
            // DB::commit();

            if(isset($check['status']) && $check['status']){

                Alert::create();
                $check = Notes::create(array_keys($data['outstanding']));
            }
            else{
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }

        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            // DB::rollBack();
            return $th->getMessage();
        }

        return $check;
    } 
}
