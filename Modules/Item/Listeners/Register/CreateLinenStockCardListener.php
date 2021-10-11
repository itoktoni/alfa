<?php

namespace Modules\Item\Listeners\Register;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Events\RegisterLinenEvent;
use Modules\Linen\Dao\Enums\ProductStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\CardFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\System\Dao\Models\CompanyConnectionItemProduct;
use Modules\System\Plugins\Cards;

class CreateLinenStockCardListener
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
        Cards::Log($event->company_id, $event->location_id, $event->product_id, TransactionStatus::Register);
    }
}
