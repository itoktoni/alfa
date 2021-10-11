<?php

namespace Modules\Linen\Listeners\Grouping;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
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
        }
    }
}
