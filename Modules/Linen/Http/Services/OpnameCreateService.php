<?php

namespace Modules\Linen\Http\Services;

use Illuminate\Support\Facades\DB;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\Linen\Dao\Models\OpnameDetail;
use Modules\Linen\Dao\Models\OpnameSummary;
use Modules\System\Dao\Interfaces\CrudInterface;
use Modules\System\Plugins\Alert;

class OpnameCreateService
{
    public function save(CrudInterface $repository, $data)
    {
        $check = false;
        try {
            $check = $repository->saveRepository($data->all());

            if (isset($check['status']) && $check['status']) {

                $data_stock = DB::table('stock')->where('company_id', $data->linen_opname_company_id)->get();
                foreach ($data_stock as $stock) {
                    OpnameSummary::create([
                        'linen_opname_summary_master_id' => $check['data']->linen_opname_key ?? '',
                        'linen_opname_summary_item_product_id' => $stock->item_product_id,
                        'linen_opname_summary_item_product_name' => $stock->linen_stock_item_product_name,
                        'linen_opname_summary_qty_stock' => $stock->linen_stock_qty,
                        'linen_opname_summary_qty_target' => $stock->company_item_target,
                        'linen_opname_summary_qty_realisasi' => $stock->company_item_realisasi,
                    ]);
                }
                Alert::create();
            } else {

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
