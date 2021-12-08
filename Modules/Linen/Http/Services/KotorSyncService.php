<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Linen\Dao\Facades\CardFacades;
use Modules\Linen\Dao\Facades\KotorDetailFacades;
use Modules\Linen\Dao\Facades\KotorFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\Linen\Dao\Models\KotorDetail;
use Modules\Linen\Dao\Models\Outstanding;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Notes;

class KotorSyncService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        // DB::beginTransaction();
        try {
            if(!empty($data['kotor'])){
                foreach($data['kotor'] as $key => $kotor){
                    $master_kotor = KotorFacades::find($key);
                    if(empty($master_kotor)){
                        $kotor['linen_created_name'] = auth()->user()->name;
                        $kotor['linen_kotor_total'] = count($kotor['detail']);
                        $repository->saveRepository($kotor);
                    }
                    
                    KotorDetail::upsert($kotor['detail'], [
                        'linen_kotor_detail_rfid',
                        'linen_kotor_detail_key'
                    ]);
                }
            }
            if(!empty($data['outstanding'])){

                Outstanding::upsert($data['outstanding'], ['linen_kotor_detail_rfid']);
            }

            $list_rfid = collect($data['sync']);
            // $return = KotorDetailFacades::select('linen_kotor_detail_rfid')->whereIn(KotorDetailFacades::mask_rfid(), $list_rfid->pluck('linen_rfid')->toArray())->get();
            
            $map = $list_rfid->map(function($item){

                $send['linen_rfid'] = strval($item['linen_rfid']);
                $send['linen_status'] = $item['linen_status'];
                return $send;
            });

            // $check = Notes::create($map->toArray());

            $check = Notes::create($map->values()->toArray());


        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            // DB::rollBack();
            return $th->getMessage();
        }

        return $check;
    } 
}
