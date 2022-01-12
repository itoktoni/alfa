<?php

namespace Modules\Linen\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Linen\Dao\Enums\OpnameStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\BalanceFacades;
use Modules\Linen\Dao\Facades\OpnameFacades;
use Modules\Linen\Dao\Facades\OpnameSummaryFacades;
use Modules\Linen\Dao\Facades\OutstandingLockFacades;
use Modules\Linen\Dao\Models\OpnameDetail;
use Modules\Linen\Dao\Models\OutstandingLock;
use Modules\Linen\Dao\Repositories\OpnameRepository;
use Modules\Linen\Dao\Repositories\ReportOpnameRepository;
use Modules\Linen\Http\Requests\GroupBatchRequest;
use Modules\Linen\Http\Requests\OpnameRequest;
use Modules\Linen\Http\Requests\OutstandingBatchRequest;
use Modules\Linen\Http\Requests\OutstandingMasterRequest;
use Modules\Linen\Http\Services\OpnameCreateService;
use Modules\Linen\Http\Services\OpnameDataService;
use Modules\Linen\Http\Services\OpnameSingleService;
use Modules\Linen\Http\Services\OpnameSyncService;
use Modules\Linen\Http\Services\OutstandingBatchService;
use Modules\Linen\Http\Services\OutstandingMasterService;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\ReportService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;

class OpnameController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(OpnameRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $status = OpnameStatus::getOptions();
        $description = Views::status(self::$model->description, true);
        $product = Views::option(new ProductRepository());
        $location = Views::option(new LocationRepository());
        $company = Views::option(new CompanyRepository());
        $user = Views::option(new TeamRepository());

        $view = [
            'status' => $status,
            'description' => $description,
            'product' => $product,
            'location' => $location,
            'company' => $company,
            'user' => $user,
        ];

        return array_merge($view, $data);
    }

    public function index()
    {
        return view(Views::index(config('page'), config('folder')))->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
        ]));
    }

    public function create()
    {
        return view(Views::create())->with($this->share());
    }

    public function save(GeneralRequest $request, OpnameCreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function sync(OpnameRequest $request, OpnameSyncService $service, OpnameDetail $repository)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function data(OpnameDataService $service)
    {
        return $service
            ->EditAction([
                'page' => config('page'),
                'folder' => config('folder'),
            ])
            ->EditStatus([
                OpnameFacades::mask_status() => OpnameStatus::class,
            ])
            ->setModel(self::$model)->make();
    }

    public function deleteDetail($code)
    {
        OpnameDetail::findOrFail($code)->delete();
        Alert::delete($code);
        return Response::redirectBack($code);
    }

    public function edit($code)
    {
        $data = $this->get($code, ['has_detail']);
        return view(Views::update())->with($this->share([
            'model' => $data,
            'detail' => $data->has_detail ?? [],
        ]));
    }

    public function update($code, GeneralRequest $request, UpdateService $service)
    {
        $data = $service->update(self::$model, $request, $code);
        return Response::redirectBack($data);
    }

    public function show($code, ReportService $service)
    {
        $model = $this->get($code, ['has_detail']);
        $detail = $model->has_detail ?? false;
        $lock = $model->has_lock ?? false;
        $opname = false;
        if ($detail) {
            $opname = $detail->mapToGroups(function ($item) {
                return [$item->linen_opname_detail_product_id => $item];
            });
        }

        $register = DB::table('view_opname_register')->where('view_company_id', $model->mask_company_id)->get();

        $share = [
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $model,
            'detail' => $detail,
            'register' => $register,
            'opname' => $opname,
            'lock' => $lock,
        ];

        if (request()->get('action')) {

            $share['action'] = 'excel';
            return $service->generate(new ReportOpnameRepository($share,'excel_report_opname'), $share, 'excel_report_opname');
        }

        return view(Views::show(config('page'), config('folder')))->with($this->share($share));
    }

    public function location($code = null, $relation = ['has_detail'])
    {
        $model = $this->get($code, ['has_detail']);
        $detail = $model->has_detail ?? false;
        if ($detail) {
            $detail = $detail->mapToGroups(function ($item) {
                return [$item->linen_opname_detail_scan_location_name => $item];
            });
        }

        return view(Views::form(__function__, config('page'), config('folder')))->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $model,
            'detail' => $detail,
        ]));
    }

    public function pending($code = null, $relation = ['has_detail'])
    {
        $model = $this->get($code);
        $lock = $model->has_lock ?? false;
        $register = LinenFacades::where(LinenFacades::mask_company_id(), $model->mask_company_id)->get();
        if ($register) {
            $register = $register->mapWithKeys(function ($item) {
                return [$item->mask_rfid => $item];
            });
        }

        return view(Views::form(__function__, config('page'), config('folder')))->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $model,
            'register' => $register,
            'lock' => $lock,
        ]));
    }

    public function hilang($code = null, $relation = ['has_detail'])
    {
        $model = $this->get($code);
        $lock = $model->has_lock ?? false;
        $register = LinenFacades::where(LinenFacades::mask_company_id(), $model->mask_company_id)->get();
        if ($register) {
            $register = $register->mapWithKeys(function ($item) {
                return [$item->mask_rfid => $item];
            });
        }

        return view(Views::form(__function__, config('page'), config('folder')))->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $model,
            'register' => $register,
            'lock' => $lock,
        ]));
    }

    public function rs($code = null, $relation = ['has_detail'])
    {
        $model = $this->get($code, ['has_detail']);
        $detail = $model->has_detail ?? false;
        $lock = $model->has_lock ?? false;

        $register = LinenFacades::where(LinenFacades::mask_company_id(), $model->mask_company_id)->get();
        if ($detail) {
            $detail_rfid = $detail->pluck('linen_opname_detail_rfid')->toArray();
            $register = $register->whereNotIn(LinenFacades::mask_rfid(), $detail_rfid);
        }

        if ($lock) {
            $lock_rfid = $lock->pluck(OutstandingLockFacades::mask_rfid())->toArray();
            $register = $register->whereNotIn(LinenFacades::mask_rfid(), $lock_rfid);
        }

        // dd($lock_rfid);

        return view(Views::form(__function__, config('page'), config('folder')))->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $model,
            'detail' => $detail,
            'register' => $register,
        ]));
    }

    public function get($code = null, $relation = ['has_detail'])
    {
        $relation = $relation ?? request()->get('relation');
        if ($relation) {
            return self::$service->get(self::$model, $code, $relation);
        }
        return self::$service->get(self::$model, $code);
    }

    public function delete(DeleteRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$model, $code);
        return Response::redirectBack($data);
    }
}
