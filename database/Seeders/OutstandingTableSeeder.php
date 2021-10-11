<?php

use Illuminate\Database\Seeder;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Models\Product;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Rajaongkir\Facade\Area;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;

class OutstandingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $out = OutstandingFacades::all()->pluck('linen_outstanding_rfid');
        $data = LinenFacades::dataRepository()->whereNotIn('item_linen_rfid', $out)->get();
        
        foreach($data as $rfid){

            OutstandingFacades::create([
                'linen_outstanding_rfid' => $rfid->item_linen_rfid, 
                'linen_outstanding_scan_location_id' => $rfid->item_linen_location_id, 
                'linen_outstanding_scan_company_id' => $rfid->item_linen_company_id, 
                'linen_outstanding_status' => 1, 
            ]);
        }
    }
}
