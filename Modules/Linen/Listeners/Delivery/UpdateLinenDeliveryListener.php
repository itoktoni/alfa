<?php

namespace Modules\Linen\Listeners\Delivery;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Events\CreateDeliveryEvent;
use Modules\Linen\Events\CreateGroupingEvent;
use Modules\Linen\Events\CreateKotorEvent;

class UpdateLinenDeliveryListener
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
    public function handle(CreateDeliveryEvent $event)
    {
        if($rfid = $event->rfid){

            $status = null;
            if($event->model->mask_status == TransactionStatus::Kotor){
                $status = LinenStatus::Bersih;
            }
            else if($event->model->mask_status == TransactionStatus::Retur){
                $status = LinenStatus::KirimRetur;
            }
            else if($event->model->mask_status == TransactionStatus::Rewash){
                $status = LinenStatus::KirimRewash;
            }

            $sql = LinenFacades::whereIn(LinenFacades::mask_rfid(), $rfid)
            ->increment(LinenFacades::mask_counter(), 1, [
                LinenFacades::mask_latest() =>  $status,
                LinenFacades::mask_qty() => 1,
            ]);

            $map = $rfid->map(function($item) use ($status){
                $data = [
                    'item_linen_detail_rfid' => $item,
                    'item_linen_detail_status' => $status,
                    'item_linen_detail_description' => LinenStatus::getDescription($status),
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
