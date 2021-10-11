<?php

namespace Modules\Linen\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\CardFacades;
use Modules\Linen\Dao\Repositories\CardRepository;
use Modules\Linen\Http\Requests\CardBatchRequest;
use Modules\Linen\Http\Requests\CardMasterRequest;
use Modules\Linen\Http\Requests\CardPatchRequest;
use Modules\Linen\Http\Services\CardBatchService;
use Modules\Linen\Http\Services\CardDataService;
use Modules\Linen\Http\Services\CardMasterService;
use Modules\Linen\Http\Services\CardPatchService;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;

class CardController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(CardRepository $model, SingleService $service)
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

    // public function save(GeneralRequest $request, CreateService $service)
    // {
    //     $data = $service->save(self::$model, $request);
    //     return Response::redirectBack($data);
    // }

    public function data(DataService $service)
    {
        return $service
            ->setModel(self::$model)->EditStatus([
                CardFacades::mask_status() => TransactionStatus::class,
            ])->make();
    }

    // public function edit($code)
    // {
    //     return view(Views::update())->with($this->share([
    //         'model' => $this->get($code),
    //     ]));
    // }

    // public function update($code, GeneralRequest $request, UpdateService $service)
    // {
    //     $data = $service->update(self::$model, $request, $code);
    //     return Response::redirectBack($data);
    // }

    // public function show($code)
    // {
    //     return view(Views::show())->with($this->share([
    //         'fields' => Helper::listData(self::$model->datatable),
    //         'model' => $this->get($code),
    //     ]));
    // }

    // public function get($code = null, $relation = null)
    // {
    //     $relation = $relation ?? request()->get('relation');
    //     if ($relation) {
    //         return self::$service->get(self::$model, $code, $relation);
    //     }
    //     return self::$service->get(self::$model, $code);
    // }

    public function delete(DeleteRequest $request, DeleteService $service)
    {
        $code = $request->get('code');
        $data = $service->delete(self::$model, $code);
        return Response::redirectBack($data);
    }
}
