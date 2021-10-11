<?php

namespace Modules\Linen\Listeners\Kotor;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Facades\StockDetailFacades;
use Modules\Linen\Events\CreateKotorEvent;

class RemoveStockDetailKotorListener
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
        StockDetailFacades::whereIn(StockDetailFacades::getKeyName(), $event->rfid)->update([
            StockDetailFacades::mask_qty() => 0
        ]);
    }
}
