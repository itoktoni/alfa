<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Ixudra\Curl\Facades\Curl;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Facades\OutstandingFacades;

class SyncUploadOutstanding extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:upload_outstanding';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This commands to download outstanding transaction from server to local';

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
        // description = 3
        $outstanding = DB::connection('server')->table('linen_outstanding')->select([
            'linen_outstanding_rfid',
            'linen_outstanding_status',
            'linen_outstanding_created_at',
            'linen_outstanding_deleted_at',
            'linen_outstanding_created_name',
            'linen_outstanding_created_by',
            'linen_outstanding_deleted_by',
            'linen_outstanding_session',
            'linen_outstanding_scan_company_id',
            'linen_outstanding_scan_company_name',
            'linen_outstanding_product_id',
            'linen_outstanding_product_name',
            'linen_outstanding_ori_company_id',
            'linen_outstanding_ori_company_name',
            'linen_outstanding_description',
        ])
            ->where('linen_outstanding_description', LinenStatus::BedaRs)
            ->whereNull('linen_outstanding_uploaded_at')
            ->limit(env('SYNC_UPLOAD', 100))
            ->get();

        $array = json_decode(json_encode($outstanding), true) ?? [];
       
        $response = Http::withoutVerifying()
            ->withToken(env('SYNC_TOKEN'))
            ->withOptions(['debug' => true])
            ->post(env('SYNC_SERVER') . 'sync_outstanding_upload', [
                'insert' => $array,
            ]);

        if (isset($outstanding)) {

            $pluck = collect($outstanding)->pluck('linen_outstanding_rfid');
            DB::connection('server')->table('linen_outstanding')
                ->whereIn('linen_outstanding_rfid', $pluck)
                ->update([
                    'linen_outstanding_uploaded_at' => date('Y-m-d H:i:s'),
                ]);
        }

        $this->info('The system has been download successfully!');
    }

}
