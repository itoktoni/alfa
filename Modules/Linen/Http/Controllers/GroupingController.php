<?php

namespace Modules\Linen\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Linen\Dao\Models\GroupingDetail;
use Modules\Linen\Dao\Repositories\GroupingRepository;
use Modules\Linen\Http\Requests\GroupBatchRequest;
use Modules\Linen\Http\Requests\GroupingRequest;
use Modules\Linen\Http\Requests\OutstandingBatchRequest;
use Modules\Linen\Http\Requests\OutstandingMasterRequest;
use Modules\Linen\Http\Services\GroupingCreateService;
use Modules\Linen\Http\Services\GroupingSingleService;
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
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateService;
use Modules\System\Plugins\Alert;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;

class GroupingController extends Controller
{
    public static $template;
    public static $service;
    public static $model;

    public function __construct(GroupingRepository $model, SingleService $service)
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

    // public function index()
    // {
    //     return view(Views::index())->with([
    //         'fields' => Helper::listData(self::$model->datatable),
    //     ]);
    // }

    // public function create()
    // {
    //     return view(Views::create())->with($this->share());
    // }

    public function save(GroupingRequest $request, GroupingCreateService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function master(OutstandingMasterRequest $request, OutstandingMasterService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function batch(OutstandingBatchRequest $request, OutstandingBatchService $service)
    {
        if(request()->get('type') == 'update'){

            $data = $service->update(self::$model, $request);

        }
        else{

            $data = $service->save(self::$model, $request);
        }

        return Response::redirectBack($data);
    }

    public function data(DataService $service)
    {
        return $service
            ->setModel(self::$model)->make();
    }

    public function deleteDetail($code){

        GroupingDetail::findOrFail($code)->delete();
        Alert::delete($code);
        return Response::redirectBack($code);
    }

    public function edit($code)
    {
        $data = $this->get($code,['detail']);
        return view(Views::update())->with($this->share([
            'model' => $data,
            'detail' => $data->detail ?? [],
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

    public function get($code = null, $relation = ['detail'])
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
