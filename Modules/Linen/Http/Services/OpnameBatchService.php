<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\Linen\Dao\Models\OpnameDetail;
use Modules\Linen\Dao\Models\OpnameSummary;
use Modules\Linen\Dao\Models\ReturDetail;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Notes;

class OpnameBatchService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        try {
            $data['linen_opname_petugas_id'] = auth()->user()->id;
            $data['linen_opname_petugas_name'] = auth()->user()->name;
            
            $repository->updateRepository($data->all(), $data->linen_opname_key);
            $check = OpnameDetail::insertOrIgnore($data['detail']);
            
            if($check){
                
                $collection = OpnameDetail::where('linen_opname_detail_key', $data->linen_opname_key)->groupBy('linen_opname_detail_product_id');
                foreach($collection as $key => $stock){
                    $first = $stock->first();
                    OpnameSummary::where('linen_opname_summary_master_id', $data->linen_opname_key)
                    ->where('linen_opname_summary_item_product_id', $key)
                    ->update([
                        'linen_opname_summary_master_id' => $data->linen_opname_key,
                        'linen_opname_summary_item_product_id' => $key,
                        'linen_opname_summary_item_product_name' => $first['linen_opname_detail_product_name'] ?? '',
                        'linen_opname_summary_qty_end' => $stock->count('linen_opname_detail_rfid'),
                    ]);
                }
            }
            
            $summary = OpnameSummary::where('linen_opname_summary_master_id', $data->linen_opname_key)->get();

            $check = Notes::update($summary);
            Alert::create($data['rfid']);

        } catch (\Throwable $th) {
            Alert::error($th->getMessage());
            return $th->getMessage();
        }

        return $check;
    } 
}
