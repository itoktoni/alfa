<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Linen\Dao\Enums\LinenStatus;

class SyncDownloadOutstanding extends Command
{

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:download_outstanding';

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
        $curl = Http::withToken(env('SYNC_TOKEN'))->withoutVerifying()
            ->withOptions(['debug' => false])
            ->withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ])
            ->post(env('SYNC_SERVER') . 'sync_outstanding_download', [
                'limit' => env('SYNC_DOWNLOAD', 5),
            ]);

        $outstanding = json_decode($curl, true);
        $collect = collect($outstanding)->pluck('linen_outstanding_rfid');


        if (isset($outstanding)) {
            $sql = DB::connection('server')->table('linen_outstanding')->whereIn('linen_outstanding_rfid', $collect);
            $check = $sql->count();
            if ($check > 0) {
                $sql->delete();
            }

            $insert = DB::connection('server')->table('linen_outstanding')->insert($outstanding);
            if ($insert) {

                $curl = Http::withToken(env('SYNC_TOKEN'))->withoutVerifying()
                    ->withOptions(['debug' => false])
                    ->withHeaders([
                        'Accept' => 'application/json',
                        'Content-Type' => 'application/json',
                    ])
                    ->post(env('SYNC_SERVER') . 'sync_outstanding_delete', [
                        'rfid' => $collect,
                    ]);
            }
        }

        $this->info('The system has been download successfully!');
    }

}
