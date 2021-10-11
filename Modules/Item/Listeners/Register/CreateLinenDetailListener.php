<?php

namespace Modules\Item\Listeners\Register;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Events\RegisterLinenEvent;
use Modules\Linen\Dao\Enums\LinenStatus;

class CreateLinenDetailListener
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
    public function handle(RegisterLinenEvent $event)
    {
        LinenDetailFacades::create([
            LinenDetailFacades::mask_rfid() => $event->rfid,
            LinenDetailFacades::mask_status() => LinenStatus::Register,
        ]);
    }
}
