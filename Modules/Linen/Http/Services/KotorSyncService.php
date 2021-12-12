<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\ResponseStatus;
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
            if (!empty($data['kotor'])) {
                foreach ($data['kotor'] as $key => $kotor) {
                    $master_kotor = KotorFacades::find($key);
                    if (empty($master_kotor)) {
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
            if (!empty($data['outstanding'])) {

                // Outstanding::upsert($data['outstanding'], ['linen_kotor_detail_rfid']);
            }

            $check_rfid = collect($data['outstanding'])->pluck(OutstandingFacades::mask_rfid());
            $succes = OutstandingFacades::whereIn(OutstandingFacades::mask_rfid(), $check_rfid)->get();
            
            if (count($check_rfid) == count($succes)) {

                $list_rfid = collect($data['sync']);
                $map = $list_rfid->map(function ($item) {

                    $send['linen_rfid'] = strval($item['linen_rfid']);
                    $send['linen_status'] = $item['linen_status'];
                    return $send;
                });

            } else {

                $list_rfid = collect($data['sync']);
                $map = $list_rfid->map(function ($item) use ($succes) {

                    $status = $item['linen_status'];
                    if ($status == ResponseStatus::Create && !($succes->contains(OutstandingFacades::mask_rfid(), $item['linen_rfid']))) {
                        $status = ResponseStatus::Failed;
                    }

                    $send['linen_rfid'] = strval($item['linen_rfid']);
                    $send['linen_status'] = $status;
                    return $send;
                });
            }

            $check = Notes::create($map->values()->toArray());
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            // DB::rollBack();
            return $th->getMessage();
        }

        return $check;
    }
}
