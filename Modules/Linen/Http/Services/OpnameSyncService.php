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
        $map = [];
        try {

            $sync = $data->sync;
            $detail = $data->detail;
            $check = OpnameDetail::upsert(
                $sync,
                [
                    'linen_opname_detail_rfid',
                    'linen_opname_detail_key',
                ],
                [
                    'linen_opname_detail_product_id',
                    'linen_opname_detail_product_name',
                    'linen_opname_detail_ori_company_id',
                    'linen_opname_detail_ori_company_name',
                    'linen_opname_detail_ori_location_id',
                    'linen_opname_detail_ori_location_name',
                    'linen_opname_detail_scan_company_id',
                    'linen_opname_detail_scan_company_name',
                    'linen_opname_detail_scan_location_id',
                    'linen_opname_detail_scan_location_name',
                    'linen_opname_detail_scaned_by',
                    'linen_opname_detail_scaned_name',
                ]
            );

            if ($check == $detail->count()) {

                $map = $detail->map(function ($item) {

                    $send['linen_key'] = $item['linen_key'];
                    $send['linen_rfid'] = $item['linen_rfid'];
                    $send['linen_status'] = ResponseStatus::Create;

                    return $send;
                });

            } else {

                $getDetail = OpnameDetail::select('linen_opname_detail_rfid', 'linen_opname_detail_key')->whereIn(OpnameDetailFacades::mask_key(), $data->keys)->get()->pluck('linen_opname_detail_key', 'linen_opname_detail_rfid')->toArray() ?? [];
                // $map = $detail->map(function ($item) use ($getDetail) {

                //     $rfid = $item['linen_rfid'];
                //     $key = $item['linen_key'];
                //     $status = 0;
                //     if (isset($getDetail[$rfid])) {
                //         $status = 1;
                //     }
                //     return [
                //         'linen_key' => $key,
                //         'linen_rfid' => $rfid,
                //         'linen_status' => $status
                //     ];
                // });

                
                $map = $detail->map(function ($item) use ($getDetail, $sync) {

                    $first = $getDetail->where('linen_opname_detail_key', $item['linen_key'])->where('linen_opname_detail_rfid', $item['linen_rfid'])->count();
                    if ($first > 0) {

                        $send['linen_key'] = $item['linen_key'];
                        $send['linen_rfid'] = $item['linen_rfid'];
                        $send['linen_status'] = ResponseStatus::Create;

                    } else {

                        if (array_key_exists($item['linen_key'], $sync)) {

                            $send['linen_key'] = $item['linen_key'];
                            $send['linen_rfid'] = $item['linen_rfid'];
                            $send['linen_status'] = ResponseStatus::Failed;
                        }
                        else{

                            $send['linen_key'] = $item['linen_key'];
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
