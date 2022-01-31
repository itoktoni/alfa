<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Models\Linen;
use Modules\Item\Http\Controllers\LinenController;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Facades\OutstandingLockFacades;
use Modules\Linen\Dao\Models\OutstandingLock;
use Modules\System\Http\Controllers\TeamController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

if (Cache::has('routing')) {
    $cache_query = Cache::get('routing')->where('system_action_api', 1);
    Route::middleware(['auth:sanctum'])->group(function () use ($cache_query) {
        foreach ($cache_query as $route) {
            $path = $route->system_action_path . '@' . $route->system_action_function;
            $code = $route->system_action_module . '/' . $route->system_action_function;

            if (in_array($route->system_action_function, ['get', 'update'])) {
                $code = $code . '/{code}';
            } else if ($route->system_action_function == 'save') {
                $code = $route->system_action_module . '/create';
            }
            if ($route->system_action_method) {

                Route::{$route->system_action_method}($code, $path)->name($route->system_action_code . '_api');
            }
        }

        Route::post('sync_outstanding_delete', function () {

            $rfid = request()->get('rfid');
            OutstandingFacades::whereIn('linen_outstanding_rfid', $rfid)->update([
                'linen_outstanding_downloaded_at' => date('Y-m-d H:i:s'),
            ]);

            $check = Linen::whereIn('item_linen_rfid', $rfid)->update([
                LinenFacades::mask_latest() => LinenStatus::Download,
            ]);
        });

        Route::post('sync_outstanding_download', function () {

            $limit = request()->get('limit');

            $outstanding = OutstandingFacades::dataRepository()->select([
                'linen_outstanding_key',
                'linen_outstanding_rfid',
                'linen_outstanding_created_at',
                'linen_outstanding_updated_at',
                'linen_outstanding_deleted_at',
                'linen_outstanding_updated_by',
                'linen_outstanding_created_name',
                'linen_outstanding_created_by',
                'linen_outstanding_deleted_by',
                'linen_outstanding_session',
                'linen_outstanding_scan_location_id',
                'linen_outstanding_scan_location_name',
                'linen_outstanding_scan_company_id',
                'linen_outstanding_scan_company_name',
                'linen_outstanding_product_id',
                'linen_outstanding_product_name',
                'linen_outstanding_ori_location_id',
                'linen_outstanding_ori_location_name',
                'linen_outstanding_ori_company_id',
                'linen_outstanding_ori_company_name',
                'linen_outstanding_status',
                'linen_outstanding_process',
                'linen_outstanding_description',

            ])->whereNull('linen_outstanding_downloaded_at')->limit($limit)->get();

            $id = $outstanding->pluck('linen_outstanding_rfid');
            
            $map = $outstanding->map(function($item){
                $data = [
                    'item_linen_detail_rfid' => $item->linen_kotor_detail_rfid,
                    'item_linen_detail_status' => LinenStatus::Download,
                    'item_linen_detail_description' => LinenStatus::getDescription(LinenStatus::Download),
                    'item_linen_detail_created_at' => date('Y-m-d H:i:s'),
                    'item_linen_detail_updated_at' => date('Y-m-d H:i:s'),
                    'item_linen_detail_updated_by' => auth()->user()->id,
                    'item_linen_detail_created_by' => auth()->user()->id,
                ];
                return $data;
            });
            
            LinenDetailFacades::insert($map->unique()->toArray());

            return $outstanding->toArray();

        })->name('sync_outstanding_download');

        Route::post('sync_outstanding_update', function () {

            $rfid = request()->get('rfid');

            $getData = OutstandingFacades::whereIn('linen_outstanding_rfid', $rfid)->get();

            foreach($getData as $opname_data){

                $status = $proses = null;
                if($opname_data->linen_outstanding_description == LinenStatus::LinenKotor){
                    $status = TransactionStatus::Kotor;
                }
                else if($opname_data->linen_outstanding_description == LinenStatus::Bernoda || $opname_data->linen_outstanding_description == LinenStatus::BahanUsang){
                    $status = TransactionStatus::Rewash;
                }
                else if($opname_data->linen_outstanding_description == LinenStatus::ChipRusak || $opname_data->linen_outstanding_description == LinenStatus::LinenRusak || $opname_data->linen_outstanding_description == LinenStatus::KelebihanStock){
                    $status = TransactionStatus::Retur;
                }

                $check = OutstandingFacades::whereIn('linen_outstanding_rfid', $opname_data->linen_outstanding_rfid)->update([
                    'linen_outstanding_status' => $status,
                    'linen_outstanding_process' => TransactionStatus::Gate,
                    'linen_outstanding_updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            OutstandingLockFacades::whereIn('linen_outstanding_rfid', $rfid)->delete();
            
            $map = collect($rfid)->map(function($item){
                $data = [
                    'item_linen_detail_rfid' => $item,
                    'item_linen_detail_status' => LinenStatus::LinenKotor,
                    'item_linen_detail_process' => LinenStatus::LinenKotor,
                    'item_linen_detail_description' => LinenStatus::getDescription(LinenStatus::LinenKotor),
                    'item_linen_detail_created_at' => date('Y-m-d H:i:s'),
                    'item_linen_detail_updated_at' => date('Y-m-d H:i:s'),
                    'item_linen_detail_updated_by' => auth()->user()->id,
                    'item_linen_detail_created_by' => auth()->user()->id,
                ];
                return $data;
            });
            
            LinenDetailFacades::insert($map->unique()->toArray());
            
            $check = Linen::whereIn('item_linen_rfid', $rfid)->update([
                LinenFacades::mask_latest() => LinenStatus::LinenKotor,
            ]);

            return $rfid;

        })->name('sync_outstanding_update');

        Route::post('sync_outstanding_upload', function () {

            $insert = request()->get('insert');
            $collect = collect($insert)->pluck('linen_outstanding_rfid');

            $map = collect($collect)->map(function($item){
                $data = [
                    'item_linen_detail_rfid' => $item,
                    'item_linen_detail_status' => LinenStatus::BelumDiScan,
                    'item_linen_detail_description' => LinenStatus::getDescription(LinenStatus::BelumDiScan),
                    'item_linen_detail_created_at' => date('Y-m-d H:i:s'),
                    'item_linen_detail_updated_at' => date('Y-m-d H:i:s'),
                    'item_linen_detail_updated_by' => auth()->user()->id,
                    'item_linen_detail_created_by' => auth()->user()->id,
                ];
                return $data;
            });
            
            LinenDetailFacades::insert($map->unique()->toArray());

            $check = OutstandingFacades::whereIn('linen_outstanding_rfid', $collect);
            if (!empty($check)) {
                $check->delete();
            }

            OutstandingFacades::insert($insert);

            $check = Linen::whereIn('item_linen_rfid', $collect)->update([
                LinenFacades::mask_latest() => LinenStatus::BelumDiScan,
            ]);

            return $insert;

        })->name('sync_outstanding_upload');

    });
}

Route::post('login', [TeamController::class, 'login'])->name('api_login');

Route::match(['POST', 'GET'], '/deploy', function (Request $request) {

    // $githubPayload = $request->getContent();
    // $githubHash = $request->header('X-Hub-Signature');

    // $localToken = config('app.deploy_secret');
    // $localHash = 'sha1=' . hash_hmac('sha1', $githubPayload, $localToken, false);

    // if (hash_equals($githubHash, $localHash)) {
    //     $root_path = base_path();
    // }

    exec('git pull origin master');

    return 'sucess';
});

Route::get('download', [LinenController::class, 'download'])->name('download');
