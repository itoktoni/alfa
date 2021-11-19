<?php

namespace Modules\Item\Listeners\Register;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Events\GantiChipLinenEvent;
use Modules\Item\Events\RegisterLinenEvent;
use Modules\Linen\Dao\Enums\LinenStatus;

class DeleteLinenListener
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
    public function handle(GantiChipLinenEvent $event)
    {
        $linen = LinenFacades::find($event->old_rfid);
        if ($linen) {

            $desc = 'Ganti Chip Dari ' . $event->old_rfid . ' menjadi ' . $event->rfid;
            $linen->mask_description = $desc;
            $linen->update();

            LinenDetailFacades::create([
                LinenDetailFacades::mask_rfid() => $event->old_rfid,
                LinenDetailFacades::mask_status() => LinenStatus::GantiChip,
                LinenDetailFacades::mask_description() => $desc,
            ]);

            $linen->delete();
        }
    }
}
