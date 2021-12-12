<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Modules\Linen\Dao\Enums\LinenStatus;

class SyncUpdateOutstanding extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:update_outstanding';

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
        $outstanding = DB::connection('server')->table('linen_outstanding')
            ->where('linen_outstanding_description', '!=', LinenStatus::BelumDiScan)
            ->whereNull('linen_outstanding_uploaded_at')
            ->limit(env('SYNC_LIMIT', 100))
            ->get()
            ->pluck('linen_outstanding_rfid');

        $curl = Http::withToken(env('SYNC_TOKEN'))->withoutVerifying()
            ->withOptions(['debug' => false])
            ->post(env('SYNC_SERVER') . 'sync_outstanding_update', [
                'rfid' => $outstanding,
            ]);

        $rfid = json_decode($curl, true);
        if ($rfid && count($rfid) > 0) {

            if (isset($outstanding)) {
                DB::connection('server')->table('linen_outstanding')
                    ->whereIn('linen_outstanding_rfid', $rfid)
                    ->update([
                        'linen_outstanding_uploaded_at' => date('Y-m-d H:i:s'),
                    ]);
            }
        }

        $this->info('The system has been download successfully!');
    }

}
