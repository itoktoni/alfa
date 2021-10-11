<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Models\Linen;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\Linen\Dao\Models\Grouping;
use Modules\Linen\Dao\Models\GroupingDetail;
use Modules\Linen\Dao\Models\Outstanding;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class DeliveryCreateService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        try {
           
            $key = $data->linen_delivery_key;
            
            Grouping::whereIn('linen_grouping_barcode', $data->barcode)->update([
                'linen_grouping_delivery' => $key
            ]);
           
            $detail = GroupingDetail::whereIn('linen_grouping_detail_barcode', $data->barcode)
            ->where(function($query) use($data){
                $query->whereIn('linen_grouping_detail_rfid', $data->detail);
            })->update([
                'linen_grouping_detail_delivery' => $key
            ]);

            // $linen = LinenFacades::whereIn('item_linen_rfid', $data->detail)->update([
            //     LinenFacades::mask_qty() => 1,
            //     LinenFacades::mask_latest() => LinenStatus::Bersih
            // ]);
            // $linen = LinenFacades::whereIn('item_linen_rfid', $data->detail)->update([LinenFacades::mask_qty() => DB::raw('item_linen_counter + 1')]);

            Outstanding::whereIn('linen_outstanding_rfid', $data->detail)->delete();

            $check = $repository->saveRepository($data->all());

            if(isset($check['status']) && $check['status']){

                Alert::create();
            }
            else{
                $message = env('APP_DEBUG') ? $check['data'] : $check['message'];
                Alert::error($message);
            }
            
        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    } 
}
