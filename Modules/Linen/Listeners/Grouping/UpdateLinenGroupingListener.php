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

            OutstandingFacades::whereIn(OutstandingFacades::mask_rfid(), $rfid)
            ->update([
                LinenFacades::mask_process() => TransactionStatus::Grouping,
            ]);

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
