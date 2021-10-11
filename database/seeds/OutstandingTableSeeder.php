<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;

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
        $data = LinenFacades::dataRepository()->whereNotIn('item_linen_rfid', $out)->limit(1000)->get();
        
        foreach($data as $rfid){
            OutstandingFacades::create([
                'linen_outstanding_rfid' => $rfid->item_linen_rfid, 
                'linen_outstanding_scan_location_id' => $rfid->location_id, 
                'linen_outstanding_scan_company_id' => $rfid->company_id, 
                'linen_outstanding_status' => 1, 
                'linen_outstanding_created_by' => 1, 
                'linen_outstanding_updated_by' => 1, 
                'linen_outstanding_created_name' => 'itok toni laksono', 
            ]);
        }
    }
}
