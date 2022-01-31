<?php

namespace Modules\Linen\Listeners\Grouping;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Events\CreateGroupingEvent;
use Modules\Linen\Events\CreateKotorEvent;

class UpdateLinenGroupingListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CreateGroupingEvent $event)
    {
        if($rfid = $event->rfid){

            $sql = LinenFacades::whereIn(LinenFacades::mask_rfid(), $rfid)
            ->update([
                LinenFacades::mask_latest() => LinenStatus::Grouping,
            ]);

            $getData = OutstandingFacades::whereIn('linen_outstanding_rfid', $rfid)->get();

            foreach($getData as $opname_data){
                $status = $proses = null;
                if($opname_data->linen_outstanding_description == LinenStatus::LinenKotor){
                    $status = TransactionStatus::Kotor;
                }
                else if($opname_data->linen_outstanding_description == LinenStatus::Bernoda || $opname_data->linen_outstanding_description == LinenStatus::BahanUsang){
                    $status = TransactionStatus::Rewash;
                }
                else if($opname_data->linen_outstanding_description == LinenStatus::ChipRusak || $opname_data->linen_outstanding_description == LinenStatus::LinenRusak || $opname_data->linen_outstanding_description == LinenStatus::KelebihanStock){
                    $status = TransactionStatus::Retur;
                }

                $check = OutstandingFacades::Where('linen_outstanding_rfid', $opname_data->linen_outstanding_rfid)->update([
                    'linen_outstanding_status' => $status,
                    'linen_outstanding_process' => TransactionStatus::Grouping,
                    'linen_outstanding_updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            $map = $rfid->map(function($item){
                $data = [
                    'item_linen_detail_rfid' => $item,
                    'item_linen_detail_status' => LinenStatus::Grouping,
                    'item_linen_detail_description' => LinenStatus::getDescription(LinenStatus::Grouping),
                    'item_linen_detail_created_at' => date('Y-m-d H:i:s'),
                    'item_linen_detail_updated_at' => date('Y-m-d H:i:s'),
                    'item_linen_detail_updated_by' => auth()->user()->id,
                    'item_linen_detail_created_by' => auth()->user()->id,
                ];
                return $data;
            });

            LinenDetailFacades::insert($map->unique()->toArray());
        }
    }
}
