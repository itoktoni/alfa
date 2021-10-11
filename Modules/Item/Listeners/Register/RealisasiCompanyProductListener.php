<?php

namespace Modules\Item\Listeners\Register;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Item\Dao\Facades\CompanyProductFacades;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Events\RegisterLinenEvent;
use Modules\Linen\Dao\Facades\CardFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\System\Dao\Models\CompanyConnectionItemProduct;

class RealisasiCompanyProductListener
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
        $realisasi = LinenFacades::where(LinenFacades::mask_company_id(), $event->company_id)
            ->where(LinenFacades::mask_product_id(), $event->product_id)->count();

        CompanyProductFacades::where(CompanyProductFacades::mask_company_id(), $event->company_id)
            ->where(CompanyProductFacades::mask_product_id(), $event->product_id)
            ->update([
                CompanyProductFacades::mask_realisasi() => $realisasi
            ]);
    }
}
