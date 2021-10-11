<?php

namespace Modules\System\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\System\Dao\Facades\ActionFacades;
use Modules\System\Dao\Facades\GroupModuleFacades;
use Modules\System\Dao\Repositories\ModuleRepository;
use Modules\System\Http\Requests\DeleteRequest;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\CreateModuleService;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateModuleService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;

class ModuleController extends Controller
{
    public static $page;
    public static $service;
    public static $model;
    public static $module;

    public function __construct(ModuleRepository $model, SingleService $service)
    {
        self::$module = self::$module ?? 'System';
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
        self::$page = self::$page ?? Helper::getTemplate(__CLASS__);
    }

    public function index()
    {
        return view(Views::index())->with([
            'fields' => Helper::listData(self::$model->datatable),
            'template' => self::$page,
        ]);
    }

    private function share($data = [])
    {
        $view = [
            'key' => self::$model->getKeyName(),
            'template' => self::$page,
        ];

        return array_merge($view, $data);
    }

    public function create()
    {
        return view(Views::create())->with($this->share());
    }

    public function save(GeneralRequest $request, CreateModuleService $service)
    {
        $data = $service->save(self::$model, $request);
        return Response::redirectBack($data);
    }

    public function data(DataService $service)
    {
        return $service
            ->setModel(self::$model)
            ->EditStatus([
                'system_module_enable' => self::$model->status,
                'system_module_show' => self::$model->status,
            ])
            ->make();
    }

    public function edit($code)
    {
        $data = $this->get($code);
        $list_action = Helper::getMethod($data->system_module_controller, $data->system_module_folder);
        $data_action = $data->connection_action->pluck(ActionFacades::getFunctionName());

        return view(Views::update(self::$page, self::$module))->with($this->share([
            'model' => $data,
            'data_group' => $data->connection_group_module->pluck('system_group_module_code')->toArray() ?? [],
            'list_group' => GroupModuleFacades::all()->pluck('system_group_module_name', 'system_group_module_code'),
            'list_action' => $list_action,
            'data_action' => $data_action->toArray(),
        ]));
    }

    public function update($code, GeneralRequest $request, UpdateModuleService $service)
    {
        $data = $service->update(self::$model, $request, $code);
        return Response::redirectBack($data);
    }

    public function show($code)
    {
        $data = $this->get($code);
        return view(Views::show())->with($this->share([
            'fields' => Helper::listData(self::$model->datatable),
            'model' => $data,
        ]));
    }

    public function get($code, $relation = null)
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
