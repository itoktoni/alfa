<?php

namespace Modules\Linen\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Linen\Dao\Models\kotor;
use Modules\Linen\Dao\Models\kotorDetail;
use Modules\Linen\Dao\Repositories\KotorRepository;
use Modules\Linen\Http\Requests\KotorRequest;
use Modules\Linen\Http\Requests\OutstandingBatchRequest;
use Modules\Linen\Http\Requests\OutstandingMasterRequest;
use Modules\Linen\Http\Services\KotorCreateService;
use Modules\Linen\Http\Services\KotorDataService;
use Modules\Linen\Http\Services\KotorSingleService;
use Modules\Linen\Http\Services\OutstandingBatchService;
use Modules\Linen\Http\Services\OutstandingMasterService;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;

class KotorController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(KotorRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $status = Views::status(self::$model->status, true);
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

    // public function create()
    // {
    //     return view(Views::create())->with($this->share());
    // }

    public function save(KotorRequest $request, KotorCreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function data(KotorDataService $service)
    {
        return $service
            ->EditAction([
                'page' => config('page'),
                'folder' => config('folder'),
            ])
            ->setModel(self::$model)->make();
    }

    public function deleteDetail($code)
    {
        $data = Kotor::where('linen_kotor_barcode', $code)->delete();
        $data = kotorDetail::where('linen_kotor_detail_barcode', $code)->delete();
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

    public function show($code)
    {
        return view(Views::show())->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $this->get($code),
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

    public function delete(DeleteRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$model, $code);
        return Response::redirectBack($data);
    }
}
