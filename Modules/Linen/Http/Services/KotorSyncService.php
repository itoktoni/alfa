<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Dao\Facades\LinenFacades;
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
use Modules\System\Plugins\Cards;
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

                Outstanding::upsert($data['outstanding'], ['linen_kotor_detail_rfid']);

                // $data_log = collect($data['outstanding'])->mapToGroups(function ($item) {
                //     return [$item['linen_outstanding_scan_company_id'] . $item['linen_outstanding_scan_location_id'] . $item['linen_outstanding_product_id'] . $item['linen_outstanding_description'] => $item];
                // });

                // foreach ($data_log as $log) {
                //     $log_first = $log->first();
                //     Cards::Log($log_first['linen_outstanding_scan_company_id'], $log_first['linen_outstanding_scan_location_id'], $log_first['linen_outstanding_product_id'], $log_first['linen_outstanding_description']);
                // }
            }
            $check_rfid = collect($data['outstanding'])->pluck(OutstandingFacades::mask_rfid());
            $succes = OutstandingFacades::whereIn(OutstandingFacades::mask_rfid(), $check_rfid)->get();

            if (count($check_rfid) > 0 && count($check_rfid) == count($succes)) {

                $list_rfid = collect($data['sync']);
                $map = $list_rfid->map(function ($item) {
                    $sql = LinenFacades::find($item['linen_rfid'])
                        ->update([
                            LinenFacades::mask_latest() => $item['linen_description_id'],
                            LinenFacades::mask_qty() => 0,
                        ]);

                    $linen_detail = [
                        'item_linen_detail_rfid' => $item['linen_rfid'],
                        'item_linen_detail_status' => $item['linen_description_id'],
                        'item_linen_detail_description' => LinenStatus::getDescription($item['linen_description_id']),
                        'item_linen_detail_created_at' => date('Y-m-d H:i:s'),
                        'item_linen_detail_updated_at' => date('Y-m-d H:i:s'),
                        'item_linen_detail_updated_by' => auth()->user()->id,
                        'item_linen_detail_created_by' => auth()->user()->id,
                    ];

                    LinenDetailFacades::create($linen_detail);

                    $send['linen_rfid'] = $item['linen_rfid'];
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

                    if ($status == ResponseStatus::Create) {

                        $sql = LinenFacades::whereIn(LinenFacades::mask_rfid(), $item['linen_rfid'])
                            ->update([
                                LinenFacades::mask_latest() => $item['linen_description_id'],
                                LinenFacades::mask_qty() => 0,
                            ]);

                        $linen_detail = [
                            'item_linen_detail_rfid' => $item->linen_kotor_detail_rfid,
                            'item_linen_detail_status' => $item['linen_description_id'],
                            'item_linen_detail_description' => LinenStatus::getDescription($item['linen_description_id']),
                            'item_linen_detail_created_at' => date('Y-m-d H:i:s'),
                            'item_linen_detail_updated_at' => date('Y-m-d H:i:s'),
                            'item_linen_detail_updated_by' => auth()->user()->id,
                            'item_linen_detail_created_by' => auth()->user()->id,
                        ];

                        LinenDetailFacades::insert($linen_detail);
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
