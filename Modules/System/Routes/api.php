<?php

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Models\Linen;
use Modules\Item\Http\Controllers\LinenController;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\GroupingDetailFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Facades\OutstandingLockFacades;
use Modules\Linen\Dao\Models\GroupingDetail;
use Modules\Linen\Dao\Repositories\DeliveryRepository;
use Modules\Linen\Http\Controllers\DeliveryController;
use Modules\Linen\Http\Requests\DeliveryRequest;
use Modules\Linen\Http\Services\DeliveryCreateService;
use Modules\System\Dao\Models\Company;
use Modules\System\Http\Controllers\TeamController;
use Modules\System\Plugins\Notes;
use Modules\System\Plugins\Response;

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

            $map = $outstanding->map(function ($item) {
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

            foreach ($getData as $opname_data) {
                $status = $proses = null;
                if ($opname_data->linen_outstanding_description == LinenStatus::LinenKotor) {
                    $status = TransactionStatus::Kotor;
                } else if ($opname_data->linen_outstanding_description == LinenStatus::Bernoda || $opname_data->linen_outstanding_description == LinenStatus::BahanUsang) {
                    $status = TransactionStatus::Rewash;
                } else if ($opname_data->linen_outstanding_description == LinenStatus::ChipRusak || $opname_data->linen_outstanding_description == LinenStatus::LinenRusak || $opname_data->linen_outstanding_description == LinenStatus::KelebihanStock) {
                    $status = TransactionStatus::Retur;
                }

                $check = OutstandingFacades::Where('linen_outstanding_rfid', $opname_data->linen_outstanding_rfid)->update([
                    'linen_outstanding_status' => $status,
                    'linen_outstanding_process' => TransactionStatus::Gate,
                    'linen_outstanding_updated_at' => date('Y-m-d H:i:s'),
                ]);
            }

            OutstandingLockFacades::whereIn('linen_outstanding_rfid', $rfid)->delete();

            $map = collect($rfid)->map(function ($item) {
                $data = [
                    'item_linen_detail_rfid' => $item,
                    'item_linen_detail_status' => LinenStatus::LinenKotor,
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

            $map = collect($collect)->map(function ($item) {
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

        Route::post('linen_detail', function () {

            $rfid = request()->get('rfid');

            $linen = LinenFacades::withCount('has_bersih')->whereIn(LinenFacades::getKeyName(), $rfid)->get();
            if ($linen) {
                $linen = $linen->map(function ($item) {
                    return [
                        "linen_rfid" => $item->item_linen_rfid,
                        "linen_product_name" => $item->item_linen_product_name,
                        "linen_company_name" => $item->item_linen_company_name,
                        "linen_location_name" => $item->item_linen_location_name,
                        "linen_latest" => LinenStatus::getDescription(intval($item->item_linen_latest)) ?? 'Unknown',
                        "linen_counter" => (String)$item->has_bersih_count,
                        "linen_updated_at" => $item->item_linen_updated_at->format('d-m-Y h:i:s') ?? '',
                        "linen_created_at" => $item->item_linen_created_at->format('d-m-Y h:i:s'),
                    ];
                });
            }

            return Notes::data($linen);

        })->name('linen_detail');

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

Route::post('create_linen_detail', function(Request $request, DeliveryCreateService $service){
    $company = Company::find($request->linen_delivery_company_id);

    $grouping = GroupingDetail::whereIn(GroupingDetailFacades::mask_barcode(), $request->barcode)->get();
    $data = $grouping->pluck(GroupingDetailFacades::mask_rfid())->unique() ?? [];

    $sql = LinenFacades::whereIn(LinenFacades::mask_rfid(), $data)
    ->increment(LinenFacades::mask_counter(), 1, [
        LinenFacades::mask_latest() =>  LinenStatus::Bersih,
        LinenFacades::mask_qty() => 1,
    ]);

    $stock = $grouping->mapToGroups(function($item){
        return [$item->mask_product_id => $item];
    });

    $driver = User::find($request->linen_delivery_driver_id);

    $startDate = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d').' 13:00');
    $endDate = Carbon::createFromFormat('Y-m-d H:i', date('Y-m-d').' 23:59');

    $check = Carbon::now()->between($startDate, $endDate);
    $report_date = Carbon::now();
    if($check){
        $report_date = Carbon::now()->addDay(1);
    }

    $check = [
        'detail' => $data,
        'stock' => $stock,
        'linen_delivery_company_name' => $company->company_name ?? '',
        'linen_delivery_driver_name' => $driver->name ?? '',
        'linen_delivery_total' => count($grouping),
        'linen_delivery_total_detail' => count($data),
        'linen_delivery_reported_date' => $report_date->format('Y-m-d'),
    ];

    $request = $request->merge($check);
    $kirim = $service->save(new DeliveryRepository(), $request);
    return Notes::create($kirim);
});

Route::post('newregister', function(Request $request){
    DB::beginTransaction();
    try {
        if (is_array($request->item_linen_rfid)) {

            foreach($request->item_linen_rfid as $rfid){
                $data = [
                    'item_linen_rfid' => $rfid,
                    'item_linen_location_id' => $request->item_linen_location_id,
                    'item_linen_company_id' => $request->item_linen_company_id,
                    'item_linen_product_id' => $request->item_linen_product_id,
                    'item_linen_rent' => $request->item_linen_rent,
                    'item_linen_status' => $request->item_linen_status,
                    'item_linen_session' => $request->item_linen_session,
                ];
                Linen::create($data);
            }

            DB::commit();

            return Notes::create($data);

        } else {
            Linen::create(
                $request->all()
            );

            return Notes::create($request->all());
        }

    } catch (\Throwable $th) {
        //throw $th;
        $message = $th->getMessage();

        $store = explode("for key 'PRIMARY",$message);

        DB::rollBack();
        return Notes::error($store[0]);
    }
});