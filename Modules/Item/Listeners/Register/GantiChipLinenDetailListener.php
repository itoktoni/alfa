<?php

namespace Modules\Item\Listeners\Register;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Events\GantiChipLinenEvent;
use Modules\Item\Events\RegisterLinenEvent;
use Modules\Linen\Dao\Enums\LinenStatus;

class GantiChipLinenDetailListener
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
        $desc = 'Register Chip '.$event->rfid.' dari yang lama '.$event->old_rfid;
        LinenFacades::create([
            'item_linen_rfid' => $event->rfid,
            'item_linen_rfid_old' => $event->old_rfid,
            'item_linen_rent' => $event->rent,
            'item_linen_status' => $event->status,
            'item_linen_location_id' => $event->location_id,
            'item_linen_company_id' => $event->company_id,
            'item_linen_product_id' => $event->product_id,
            'item_linen_latest' => LinenStatus::GantiChip,
            'item_linen_qty' => 1,
            'item_linen_ganti_at' => date('Y-m-d h:i:s'),
            'item_linen_ganti_by' => auth()->user()->name ?? '',
            'item_linen_description' => $desc,
        ]);

        LinenDetailFacades::create([
            LinenDetailFacades::mask_rfid() => $event->rfid,
            LinenDetailFacades::mask_status() => LinenStatus::Register,
            LinenDetailFacades::mask_description() => $desc,
        ]);
    }
}
