<?php

namespace Modules\Item\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\CompanyProductRepository;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Item\Dao\Repositories\SizeRepository;
use Modules\Item\Dao\Repositories\UnitRepository;
use Modules\Item\Http\Requests\CompanyProductRequest;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;

class CompanyProductController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(CompanyProductRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $company = Views::option(new CompanyRepository());
        $location = Views::option(new LocationRepository());
        $product = Views::option(new ProductRepository());
        $unit = Views::option(new UnitRepository());
        $size = Views::option(new SizeRepository());
        $master = request()->all();

        if (request()->get('company_id') || isset($data['model'])) {

            $id = request()->get('company_id') ?? $data['model']->item_linen_company_id;

            $data_company = CompanyFacades::where(CompanyFacades::getKeyName(), $id)->first();
            if (isset($data_company->has_product)) {
                $product = $data_company->has_product->pluck('item_product_name', 'item_product_id');
            }
            if (isset($data_company->has_location)) {
                $location = $data_company->has_location->pluck('location_name', 'location_id');
            }
        }

        $view = [
            'company' => $company,
            'location' => $location,
            'product' => $product,
            'size' => $size,
            'unit' => $unit,
            'master' => $master,
        ];
        return array_merge($view, $data);
    }

    public function index()
    {
        return view(Views::index())->with([
            'fields' => Helper::listData(self::$model->datatable),
        ]);
    }

    public function create()
    {
        return view(Views::create())->with($this->share());
    }

    public function save(CompanyProductRequest $request, CreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function data(DataService $service)
    {
        return $service
            ->setModel(self::$model)
            ->EditColumn([
                'company_item_minimal' => 'company_item_outstanding',
            ])
            ->make();
    }

    public function edit($code)
    {
        return view(Views::update())->with($this->share([
            'model' => $this->get($code),
        ]));
    }

    public function update($code, CompanyProductRequest $request, UpdateService $service)
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
