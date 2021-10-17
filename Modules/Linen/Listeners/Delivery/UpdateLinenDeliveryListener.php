<?php

namespace Modules\Linen\Listeners\Delivery;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
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

            $sql = LinenFacades::whereIn(LinenFacades::mask_rfid(), $rfid)
            ->update([
                LinenFacades::mask_qty() => 1,
                LinenFacades::mask_latest() => LinenStatus::Bersih,
            ]);

            $map = $rfid->map(function($item){
                $data = [
                    'item_linen_detail_rfid' => $item,
                    'item_linen_detail_status' => LinenStatus::Bersih,
                    'item_linen_detail_description' => LinenStatus::getDescription(LinenStatus::Bersih),
                    'item_linen_detail_created_at' => date('Y-m-d H:i:s'),
                    'item_linen_detail_updated_at' => date('Y-m-d H:i:s'),
                    'item_linen_detail_updated_by' => auth()->user()->id,
                    'item_linen_detail_created_by' => auth()->user()->id,
                ];
                return $data;
            });
        }
    }
}
