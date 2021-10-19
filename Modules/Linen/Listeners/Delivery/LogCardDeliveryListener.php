<?php

namespace Modules\Linen\Listeners\Delivery;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\KotorDetailFacades;
use Modules\Linen\Events\CreateDeliveryEvent;
use Modules\Linen\Events\CreateKotorEvent;
use Modules\System\Plugins\Cards;

class LogCardDeliveryListener
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
    public function handle(CreateDeliveryEvent $event)
    {
        // $grouped = $event->linen->mapToGroups(function ($item, $key) {
        //     $combile = $item['linen_grouping_detail_product_id'].$item['linen_grouping_detail_ori_company_id'].$item['linen_grouping_detail_ori_location_id'];
        //     return [
        //         $combile => $item
        //     ];
        // });

        $grouped = $event->linen->unique(function ($item) {
            return $item['linen_grouping_detail_product_id'].$item['linen_grouping_detail_ori_company_id'].$item['linen_grouping_detail_ori_location_id'];
        });
        
        if($grouped){
            foreach($grouped as $group){
                // $product = $group->first();
                // $total = $group->count();

                Cards::Log($group['linen_grouping_detail_ori_company_id'], $group['linen_grouping_detail_ori_location_id'], $group['linen_grouping_detail_product_id'], TransactionStatus::Bersih);
            }
        }
    }
}
