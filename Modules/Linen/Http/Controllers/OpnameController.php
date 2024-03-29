<?php

namespace Modules\Linen\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\OpnameStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\OpnameFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Models\OpnameDetail;
use Modules\Linen\Dao\Repositories\OpnameRepository;
use Modules\Linen\Dao\Repositories\ReportOpnameRepository;
use Modules\Linen\Http\Requests\OpnameRequest;
use Modules\Linen\Http\Requests\OpnameSaveRequest;
use Modules\Linen\Http\Services\OpnameCreateService;
use Modules\Linen\Http\Services\OpnameDataService;
use Modules\Linen\Http\Services\OpnameDeleteService;
use Modules\Linen\Http\Services\OpnameSyncService;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Requests\GeneralRequest;
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

    public function save(OpnameSaveRequest $request, OpnameCreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function sync(OpnameRequest $request, OpnameSyncService $service)
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

    public function show($code, ReportService $service, ReportOpnameRepository $repository)
    {
        $model = $this->get($code, ['has_detail']);
        $detail = $model->has_detail ?? false;

        $hilang = OutstandingFacades::where(OutstandingFacades::mask_company_ori(), $model->mask_company_id)->where(function ($model) {
            $model->where(OutstandingFacades::mask_status(), TransactionStatus::Hilang);
        })->get();

        $pending = OutstandingFacades::where(OutstandingFacades::mask_company_ori(), $model->mask_company_id)->where(function ($model) {
            $model->where(OutstandingFacades::mask_status(), TransactionStatus::Pending);
        })->get();

        $kotor = OutstandingFacades::where(OutstandingFacades::mask_company_ori(), $model->mask_company_id)->where(function ($model) {
            $model
            ->where(OutstandingFacades::mask_status(), '!=', TransactionStatus::Hilang)
            ->where(OutstandingFacades::mask_status(), '!=', TransactionStatus::Pending);
        })->get();

        $outstanding = OutstandingFacades::where(OutstandingFacades::mask_company_ori(), $model->mask_company_id)
            ->where(OutstandingFacades::mask_status(), '!=', TransactionStatus::Hilang)
            ->where(OutstandingFacades::mask_status(), '!=', TransactionStatus::Pending)
            ->get();

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
            'hilang' => $hilang,
            'pending' => $pending,
            'kotor' => $kotor,
            'outstanding' => $outstanding,
        ];

        if (request()->get('action')) {

            $share['action'] = 'excel';
            return $service->generate([$repository, 'share' => $share], 'excel_report_opname');
        }

        return view(Views::show(config('page'), config('folder')))->with($this->share($share));
    }

    public function location($code = null, ReportService $service, ReportOpnameRepository $repository)
    {
        $model = $this->get($code, ['has_detail']);
        $detail = $model->has_detail ?? false;
        if ($detail) {
            $detail = $detail->mapToGroups(function ($item) {
                return [$item->linen_opname_detail_scan_location_name => $item];
            });
        }

        $share = [
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $model,
            'detail' => $detail,
        ];

        if (request()->get('action')) {

            $share['action'] = 'excel';
            return $service->generate([$repository, 'share' => $share], 'excel_report_location');
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))->with($this->share($share));
    }

    public function kotor($code = null, ReportService $service, ReportOpnameRepository $repository)
    {
        $model = $this->get($code);

        $outstanding = OutstandingFacades::where(OutstandingFacades::mask_company_ori(), $model->mask_company_id)
            ->where(OutstandingFacades::mask_status(), TransactionStatus::Kotor)->get();

        $register = LinenFacades::where(LinenFacades::mask_company_id(), $model->mask_company_id)->get();
        if ($register) {
            $register = $register->mapWithKeys(function ($item) {
                return [$item->mask_rfid => $item];
            });
        }

        $share = [
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $model,
            'register' => $register,
            'outstanding' => $outstanding,
        ];

        if (request()->get('action')) {
            $share['action'] = 'excel';
            return $service->generate([$repository, 'share' => $share], 'excel_report_kotor');
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))->with($this->share($share));
    }

    public function pending($code = null, ReportService $service, ReportOpnameRepository $repository)
    {
        $model = $this->get($code);

        $outstanding = OutstandingFacades::where(OutstandingFacades::mask_company_ori(), $model->mask_company_id)
            ->where(OutstandingFacades::mask_status(), TransactionStatus::Pending)->get();

        $register = LinenFacades::where(LinenFacades::mask_company_id(), $model->mask_company_id)->get();
        if ($register) {
            $register = $register->mapWithKeys(function ($item) {
                return [$item->mask_rfid => $item];
            });
        }

        $share = [
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $model,
            'register' => $register,
            'outstanding' => $outstanding,
        ];

        if (request()->get('action')) {
            $share['action'] = 'excel';
            return $service->generate([$repository, 'share' => $share], 'excel_report_pending');
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))->with($this->share($share));
    }

    public function hilang($code = null, ReportService $service, ReportOpnameRepository $repository)
    {
        $model = $this->get($code);
        $outstanding = OutstandingFacades::where(OutstandingFacades::mask_company_ori(), $model->mask_company_id)
            ->where(OutstandingFacades::mask_status(), TransactionStatus::Hilang)->get();

        $register = LinenFacades::where(LinenFacades::mask_company_id(), $model->mask_company_id)->get();
        if ($register) {
            $register = $register->mapWithKeys(function ($item) {
                return [$item->mask_rfid => $item];
            });
        }

        $share = [
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $model,
            'register' => $register,
            'outstanding' => $outstanding,
        ];

        if (request()->get('action')) {

            $share['action'] = 'excel';
            return $service->generate([$repository, 'share' => $share], 'excel_report_hilang');
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))->with($this->share($share));
    }

    public function rs($code = null, ReportService $service, ReportOpnameRepository $repository)
    {
        $model = $this->get($code, ['has_detail']);
        $detail = $model->has_detail ?? false; // hasil opname 8
        $outstanding = OutstandingFacades::where(OutstandingFacades::mask_company_ori(), $model->mask_company_id)
            ->get();

        $rfid = [];
        if($outstanding){
            $rfid = $outstanding->pluck('linen_outstanding_rfid')->toArray();
            // dd($rfid); 39
        }

        if ($detail) {
            $rfid = array_merge($rfid, $detail->pluck('linen_opname_detail_rfid')->toArray());
            // dd($detail->pluck('linen_opname_detail_rfid')->toArray()); 3817 + 39 = 56
        }


        $register = LinenFacades::where(LinenFacades::mask_company_id(), $model->mask_company_id)
        ->WhereNotIn('item_linen_rfid', $rfid)
        ->get(); //11

        $share = [
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $model,
            'detail' => $detail,
            'register' => $register,
        ];

        if (request()->get('action')) {

            $share['action'] = 'excel';
            return $service->generate([$repository, 'share' => $share], 'excel_report_rs');
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))->with($this->share($share));
    }

    public function get($code = null, $relation = ['has_detail'])
    {
        $relation = $relation ?? request()->get('relation');
        if ($relation) {
            return self::$service->get(self::$model, $code, $relation);
        }
        return self::$service->get(self::$model, $code);
    }

    public function delete(DeleteRequest $request, OpnameDeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$model, $code);

        return Response::redirectBack($data);
    }
}
