<?php

namespace Modules\Item\Listeners\Register;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Events\RegisterLinenEvent;
use Modules\Linen\Dao\Enums\LinenStatus;

class UpdateLinenListener
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
        $linen = LinenFacades::find($event->rfid)->update([
            LinenFacades::mask_latest() => LinenStatus::Register,
            LinenFacades::mask_qty() => 0
        ]);
    }
}
