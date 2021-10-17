<?php

namespace Modules\Linen\Listeners\Kotor;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Events\CreateKotorEvent;

class CreateKotorLinenDetailListener
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
        if($event->linen){

            $map = $event->linen->map(function($item){
                $data = [
                    'item_linen_detail_rfid' => $item->linen_kotor_detail_rfid,
                    'item_linen_detail_status' => LinenStatus::LinenKotor,
                    'item_linen_detail_description' => LinenStatus::getDescription(LinenStatus::LinenKotor),
                    'item_linen_detail_created_at' => date('Y-m-d H:i:s'),
                    'item_linen_detail_updated_at' => date('Y-m-d H:i:s'),
                    'item_linen_detail_updated_by' => auth()->user()->id,
                    'item_linen_detail_created_by' => auth()->user()->id,
                ];
                return $data;
            });
            
            LinenDetailFacades::insert($map->unique()->toArray());
        }
    }
}
