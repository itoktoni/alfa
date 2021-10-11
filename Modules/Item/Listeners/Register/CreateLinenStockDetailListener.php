<?php

namespace Modules\Item\Listeners\Register;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Item\Events\RegisterLinenEvent;
use Modules\Linen\Dao\Facades\StockDetailFacades;

class CreateLinenStockDetailListener
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
        StockDetailFacades::updateOrCreate(
        [
            StockDetailFacades::mask_rfid() => $event->rfid
        ], 
        [
            StockDetailFacades::mask_company_id() => $event->company_id,
            StockDetailFacades::mask_location_id() => $event->location_id,            
            StockDetailFacades::mask_product_id() => $event->product_id,
            StockDetailFacades::mask_company_ori() => $event->company_id,
            StockDetailFacades::mask_location_ori() => $event->location_id,
            StockDetailFacades::mask_qty() => 1,
        ]);
    }
}
