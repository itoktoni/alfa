<?php

namespace Modules\System\Plugins;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\ProductStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\CardFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Facades\StockDetailFacades;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\System\Dao\Facades\CompanyFacades;

class Cards
{
    public static function Log($company_id, $location_id, $product_id, $status)
    {
        $register = LinenFacades::where(LinenFacades::mask_company_id(), $company_id)
            ->where(LinenFacades::mask_location_id(), $location_id)
            ->where(LinenFacades::mask_product_id(), $product_id)->count();

        $stock = StockFacades::where(StockFacades::mask_company_id(), $company_id)
            ->where(StockFacades::mask_location_id(), $location_id)
            ->where(StockFacades::mask_product_id(), $product_id)->first();

        $bersih = $stock->mask_qty ?? 0;

        $outstanding = OutstandingFacades::where(OutstandingFacades::mask_company_ori(), $company_id)
            ->where(OutstandingFacades::mask_location_ori(), $location_id)
            ->where(OutstandingFacades::mask_product_id(), $product_id)->get();

        $list_kotor = [LinenStatus::LinenKotor, LinenStatus::BedaRs];
        $list_retur = [LinenStatus::ChipRusak, LinenStatus::LinenRusak, LinenStatus::KelebihanStock];
        $list_rewash = [LinenStatus::Bernoda, LinenStatus::BahanUsang];

        $kotor = $outstanding->whereIn(OutstandingFacades::mask_description(), $list_kotor)->count();
        $retur = $outstanding->whereIn(OutstandingFacades::mask_description(), $list_retur)->count();
        $rewash = $outstanding->whereIn(OutstandingFacades::mask_description(), $list_rewash)->count();
        $pending = $outstanding->where(OutstandingFacades::mask_status(), TransactionStatus::Pending)->count();
        $hilang = $outstanding->where(OutstandingFacades::mask_status(), TransactionStatus::Hilang)->count();

        $saldo = $bersih + $kotor + $pending + $retur + $rewash;

        $description = TransactionStatus::getDescription($status);
        $save = [
            'linen_card_company_id' => $company_id,
            'linen_card_location_id' => $location_id,
            'linen_card_product_id' => $product_id,
            'linen_card_status' => $status,
            'linen_card_stock_register' => $register,
            'linen_card_stock_kotor' => $kotor,
            'linen_card_stock_bersih' => $bersih,
            'linen_card_stock_pending' => $pending,
            'linen_card_stock_return' => $retur,
            'linen_card_stock_rewash' => $rewash,
            'linen_card_stock_hilang' => $hilang,
            'linen_card_stock_saldo' => $saldo,
            'linen_card_stock_notes' => $description,
        ];
        CardFacades::create($save);
    }
}
