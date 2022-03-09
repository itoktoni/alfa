<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Support\Carbon;
use Modules\Linen\Dao\Facades\MasterOutstandingFacades;
use Modules\Linen\Dao\Facades\OpnameFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Facades\OutstandingLockFacades;
use Modules\Linen\Dao\Models\OpnameDetail;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Notes;

class OpnameCreateService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        try {
            $date = Carbon::createFromFormat('Y-m-d', $data->linen_opname_date);
            $key = Helper::autoNumber(OpnameFacades::getTable(), OpnameFacades::getKeyName(), 'OP' . $date->format('ymd'), env('WEBSITE_AUTONUMBER'));
            $additional = $data->all();
            $additional[OpnameFacades::getKeyName()] = $key;
            $check = $repository->saveRepository($additional);

            if(isset($check['status']) && $check['status']){

                Alert::create();
            }
            else{
                
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }

            // if(isset($check['status']) && $check['status']){

            //     $date = $date->format('Y-m-d');
            //     $outstanding = OutstandingFacades::whereDate(OutstandingFacades::getCreatedAtColumn(),'<', $date)
            //     ->where(OutstandingFacades::mask_company_ori(), $data->linen_opname_company_id)->get();
            //     if($outstanding){

            //         foreach($outstanding as $lock){
            //             $data_lock = $lock->toArray();
            //             $data_lock['linen_outstanding_opname'] = $key;
            //             OutstandingLockFacades::insertOrIgnore($data_lock);
            //         }
            //     }

            //     Alert::create();
            // }
            // else{
            //     $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
            //     Alert::error($message);
            // }
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    } 
}
