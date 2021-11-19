<?php

namespace Modules\System\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Item\Dao\Repositories\SizeRepository;
use Modules\Item\Dao\Repositories\UnitRepository;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\HoldingRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\CompanyDataService;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateCompanyService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;
use Modules\System\Http\Requests\DeleteRequest;

class CompanyController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(CompanyRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $holding = Views::option(new HoldingRepository());
        $location = Views::option(new LocationRepository(), false);
        // $product = Views::option(new ProductRepository());
        $unit = Views::option(new UnitRepository());
        $size = Views::option(new SizeRepository());

        $view = [
            'holding' => $holding,
            // 'product' => $product,
            'location' => $location,
            // 'size' => $size,
            // 'unit' => $unit,
        ];
        return array_merge($view, $data);
    }

    public function index()
    {
        return view(Views::index(config('page'), config('folder')))->with([
            'fields' => Helper::listData(self::$model->datatable),
        ]);
    }

    public function create()
    {
        return view(Views::create())->with($this->share());
    }

    public function save(GeneralRequest $request, CreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function data(CompanyDataService $service)
    {
        return $service->setModel(self::$model)->make();
    }

    public function edit($code)
    {
        $data = $this->get($code);
        $connection_location = $data->has_location ? $data->has_location->pluck('location_id')->toArray() : [];
        $connection_product = $data->has_product ? $data->has_product->pluck('item_product_id')->toArray() : [];
        return view(Views::update(config('page'),config('folder')))->with($this->share([
            'model' => $this->get($code),
            'connection_location' => $connection_location,
            'connection_product' => $connection_product,
        ]));
    }

    public function update($code, GeneralRequest $request, UpdateCompanyService $service)
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
