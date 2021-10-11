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
        }
    }
}
