<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Linen\Dao\Facades\CardFacades;
use Modules\Linen\Dao\Facades\KotorDetailFacades;
use Modules\Linen\Dao\Facades\KotorFacades;
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
            
            if(!empty($data->get('kotor'))){
                foreach($data->get('kotor') as $key => $kotor){

                    $master_kotor = KotorFacades::find($key);
                    if(empty($master_kotor)){
                        $repository->saveRepository($master_kotor);
                    }

                    KotorDetail::upsert($kotor['detail'], [
                        'linen_opname_detail_rfid',
                        'linen_opname_detail_key'
                    ]);
                }
            }
            if(!empty($data['outstanding'])){

                Outstanding::insert($data['outstanding']);
            }

            $list_rfid = collect($data->get('data'));
            $return = KotorDetailFacades::select('linen_kotor_detail_rfid')->whereIn(KotorDetailFacades::mask_rfid(), $list_rfid->pluck('linen_rfid')->toArray())->get();
            
            $map = $list_rfid->map(function($item) use($return){

                $data_outstanding = $return->pluck('linen_kotor_detail_rfid')->toArray();
                $item = $item;
                $item['linen_status'] = in_array($item['linen_rfid'], $data_outstanding) ? 1 : 0;
                return $item;
            });

            $check = $map->toArray();


        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            // DB::rollBack();
            return $th->getMessage();
        }

        return $check;
    } 
}
