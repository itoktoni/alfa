<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Artisan;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\CardFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Facades\StockDetailFacades;
use Modules\System\Plugins\Cards;

class CheckOutstandingHilang extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'outstanding:hilang';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Commands To copy web frontend to vendor console';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $outstanding = OutstandingFacades::where(OutstandingFacades::mask_created_at(), '<=', Carbon::now()->subDays(4)->toDateString())
        ->get();

        $rfid = $outstanding->pluck(OutstandingFacades::mask_rfid());

        $map = $rfid->map(function($item){
            $data = [
                'item_linen_detail_rfid' => $item,
                'item_linen_detail_status' => LinenStatus::Hilang,
                'item_linen_detail_description' => LinenStatus::getDescription(LinenStatus::Hilang),
                'item_linen_detail_created_at' => date('Y-m-d H:i:s'),
                'item_linen_detail_updated_at' => date('Y-m-d H:i:s'),
                'item_linen_detail_updated_by' => auth()->user()->id,
                'item_linen_detail_created_by' => auth()->user()->id,
            ];
            return $data;
        });

        OutstandingFacades::whereIn(OutstandingFacades::mask_rfid(), $rfid->toArray())
        ->update([
            OutstandingFacades::mask_status() => TransactionStatus::Hilang,
            OutstandingFacades::mask_hilang() => date('Y-m-d H:i:s'),
        ]);

        LinenFacades::whereIn(LinenFacades::mask_rfid(), $rfid->toArray())->update([
            LinenFacades::mask_latest() => LinenStatus::Hilang
        ]);

        // $grouped = $outstanding->mapToGroups(function ($item) {

        //     $combile = $item['linen_outstanding_product_id'] . $item['linen_outstanding_ori_company_id'] . $item['linen_outstanding_ori_location_id'];
        //     return [
        //         $combile => $item
        //     ];

        // })->toArray();
        
        // if ($grouped) {
        //     foreach ($grouped as $groups) {
                
        //         $group = $groups[0] ?? false;
        //         if($group){

        //             Cards::Log($group['linen_outstanding_ori_company_id'], $group['linen_outstanding_ori_location_id'], $group['linen_outstanding_product_id'], TransactionStatus::Hilang);
        //         }

        //     }
        // }

        $this->info('The system has been copied successfully!');
    }
}
