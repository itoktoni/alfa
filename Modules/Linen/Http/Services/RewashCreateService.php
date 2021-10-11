<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\Linen\Dao\Models\RewashDetail;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class RewashCreateService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        try {
            $check = $repository->saveRepository($data->all());
            RewashDetail::insert($data['detail']);

            if($data->stock){
                foreach($data->stock as $key_stock => $stock){
                    $update_stock = StockFacades::where('linen_stock_company_id', $data->linen_rewash_company_id)
                    ->where('linen_stock_item_product_id', $key_stock)->update([
                        'linen_stock_qty' => DB::raw('linen_stock_qty - '.count($stock))
                    ]);
                }
            }
            
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
