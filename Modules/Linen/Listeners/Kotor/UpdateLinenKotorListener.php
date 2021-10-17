<?php

namespace Modules\Linen\Listeners\Kotor;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Events\CreateKotorEvent;

class UpdateLinenKotorListener
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
    public function handle(CreateKotorEvent $event)
    {
        if($rfid = $event->rfid){

            $sql = LinenFacades::whereIn(LinenFacades::mask_rfid(), $rfid)
            ->increment(LinenFacades::mask_counter(), 1, [
                LinenFacades::mask_latest() => LinenStatus::LinenKotor,
                LinenFacades::mask_qty() => 0,
            ]);
        }
    }
}
