<?php

namespace Modules\Item\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Response as FacadesResponse;
use Kirschbaum\PowerJoins\PowerJoins;
use Modules\Item\Dao\Enums\RegisterStatus;
use Modules\Item\Dao\Enums\RentStatus;
use Modules\Item\Dao\Facades\CompanyProductFacades;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Repositories\LinenRepository;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Item\Http\Services\DeleteLinenService;
use Modules\Item\Http\Services\LinenDataService;
use Modules\Item\Http\Services\UpdateLinenService;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\System\Dao\Facades\CompanyConnectionLocationFacades;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Models\Location;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Notes;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;

class LinenController extends Controller
{
    use PowerJoins;
    public static $template;
    public static $service;
    public static $model;

    public function __construct(LinenRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $product = Views::option(new ProductRepository());
        $location = Views::option(new LocationRepository());
        $company = Views::option(new CompanyRepository());
        $user = Views::option(new TeamRepository());
        $rent = LinenStatus::getOptions([LinenStatus::StatusLinen, LinenStatus::Cuci, LinenStatus::Rental]);
        $status = LinenStatus::getOptions([LinenStatus::StatusLinen, LinenStatus::Register, LinenStatus::GantiChip]);

        if (request()->get('company_id') || isset($data['model'])) {

            $id = request()->get('company_id') ?? $data['model']->item_linen_company_id;

            $data_company = CompanyFacades::where(CompanyFacades::getKeyName(), $id)->first();
            if (isset($data_company->has_location)) {
                $location = $data_company->has_location->pluck('location_name', 'location_id');
            }
            if (isset($data_company->has_product)) {
                $product = $data_company->has_product->pluck('item_product_name', 'item_product_id');
            }
        }

        $view = [
            'product' => $product,
            'location' => $location,
            'company' => $company,
            'status' => $status,
            'rent' => $rent,
            'user' => $user,
        ];

        return array_merge($view, $data);
    }

    public function index()
    {
        return view(Views::index(config('page'), config('folder')))->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'latest' => LinenStatus::getOptions(),
        ]));
    }

    public function create()
    {
        return view(Views::create())->with($this->share());
    }

    public function save(GeneralRequest $request, CreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBackWithInput($data);
    }

    public function patch(GeneralRequest $request)
    {
        $check = LinenFacades::where('item_linen_rfid', $request->item_linen_rfid)->first();
        if ($check) {

            if ($request->type == 'update') {

                $check->item_linen_location_id = $request->item_linen_location_id;
                $check->item_linen_location_id = $request->item_linen_location_id;
                $check->item_linen_rent = $request->item_linen_rent;
                $check->item_linen_status = $request->item_linen_status;
                $check->item_linen_company_id = $request->item_linen_company_id;
                $check->item_linen_product_id = $request->item_linen_product_id;
                $check->item_linen_session = $request->item_linen_session;
                $check->save();

                return Notes::update($check);
            }

            return Notes::single($check);
        }

        $data = LinenFacades::saveRepository($request->all());
        return Response::redirectBack($data);
    }

    public function data(LinenDataService $service)
    {
        return $service
            ->setModel(self::$model)
            ->EditAction([
                'page'      => config('page'),
                'folder'    => config('folder'),
            ])
            ->EditStatus([
                self::$model->mask_status() => LinenStatus::class,
                self::$model->mask_rent() => LinenStatus::class,
                self::$model->mask_latest() => LinenStatus::class,
            ])->make();
    }

    public function edit($code)
    {
        if(request()->get('activate')){
            LinenFacades::withTrashed()->find($code)->restore();

            LinenDetailFacades::create([
                LinenDetailFacades::mask_rfid() => $code,
                LinenDetailFacades::mask_status() => LinenStatus::Activated,
            ]);
            
            return redirect()->back();
        }
        return view(Views::update())->with($this->share([
            'model' => $this->get($code),
        ]));
    }

    public function update($code, GeneralRequest $request, UpdateLinenService $service)
    {
        $data = $service->update(self::$model, $request, $code);
        return Response::redirectBack($data);
    }

    public function show($code)
    {
        $model = $this->get($code);
        return view(Views::show(config('page'), config('folder')))->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $model,
            'detail' => $model->has_detail()->limit(10)->latest()->get()
        ]));
    }

    public function get($code = null, $relation = null)
    {
        $relation = $relation ?? request()->get('relation');
        if ($relation) {
            return self::$service->get(self::$model, $code, $relation);
        }
        return self::$service->get(self::$model, $code);
    }

    public function delete(DeleteRequest $request, DeleteLinenService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$model, $code);
        return Response::redirectBack($data);
    }

    public function download()
    {
        // $jsongFile = 'data_file.json';
        // File::put(public_path('/files/linen/'.$jsongFile), $json);

        // LinenFacades::whereIn('item_linen_id', $data->pluck('item_linen_id'))->update([
        //     'item_linen_sync_at' => date('Y-m-d')
        // ]);

        // return FacadesResponse::download(public_path('/files/linen/'.$jsongFile));
        $company = request()->get('item_linen_company_id');
        return response()->streamDownload(function () {
            $sql = LinenFacades::dataRepository();
            $data = $sql->select([
                'item_linen_rfid as rfid',
                'item_linen_product_name as name',
                'item_linen_company_id as cid',
                'item_linen_company_name as cname',
                'item_linen_location_id as lid',
                'item_linen_location_name as lname',
            ])->filter()->get();
            echo json_encode($data);
        }, $company . '_item_linen.json');
    }
}
