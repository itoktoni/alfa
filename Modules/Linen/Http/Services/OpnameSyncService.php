<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Linen\Dao\Enums\ResponseStatus;
use Modules\Linen\Dao\Facades\OpnameDetailFacades;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\Linen\Dao\Models\OpnameDetail;
use Modules\Linen\Dao\Models\OpnameSummary;
use Modules\Linen\Dao\Models\ReturDetail;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Notes;

class OpnameSyncService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        try {

            $sync = $data->sync;
            $detail = $data->detail;

            $check = OpnameDetail::insertOrIgnore($sync);

            if ($check) {
                if ($check == $detail->count()) {

                    $map = $detail->map(function ($item) {

                        $send['linen_rfid'] = $item['linen_rfid'];
                        $send['linen_status'] = ResponseStatus::Create;

                        return $send;
                    });
                }
            } else {

                $getDetail = OpnameDetail::whereIn(OpnameDetailFacades::mask_key(), $data->keys)->get();

                $map = $detail->map(function ($item) use ($getDetail, $sync) {

                    $first = $getDetail->where('linen_opname_detail_key', $item['linen_key'])->where('linen_opname_detail_rfid', $item['linen_rfid'])->count();
                    if ($first > 0) {

                        $send['linen_rfid'] = $item['linen_rfid'];
                        $send['linen_status'] = ResponseStatus::Create;

                    } else {

                        if (array_key_exists($item['linen_key'], $sync)) {

                            $send['linen_rfid'] = $item['linen_rfid'];
                            $send['linen_status'] = ResponseStatus::Failed;
                        }
                        else{

                            $send['linen_rfid'] = $item['linen_rfid'];
                            $send['linen_status'] = ResponseStatus::Unknown;
                        }
                    }

                    return $send;
                });
            }

            $check = Notes::create($map->values()->toArray());
            
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    }
}
