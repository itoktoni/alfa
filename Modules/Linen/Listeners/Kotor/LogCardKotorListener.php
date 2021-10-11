<?php

namespace Modules\Linen\Listeners\Kotor;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\KotorDetailFacades;
use Modules\Linen\Events\CreateKotorEvent;
use Modules\System\Plugins\Cards;

class LogCardKotorListener
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
        $grouped = $event->linen->mapToGroups(function ($item, $key) {
            $combile = $item[KotorDetailFacades::mask_company_scan()].$item[KotorDetailFacades::mask_location_scan()].$item[KotorDetailFacades::mask_product_id()];
            return [
                $combile => $item
            ];
        });
        
        if($grouped){
            foreach($grouped as $group){

                $product = $group->first();
                $total = $group->count();

                Cards::Log($product->linen_kotor_detail_scan_company_id, $product->linen_kotor_detail_scan_location_id, $product->linen_kotor_detail_product_id, TransactionStatus::Kotor);
            }
        }
    }
}
