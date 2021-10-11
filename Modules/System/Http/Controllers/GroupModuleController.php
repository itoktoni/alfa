<?php

namespace Modules\System\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Modules\System\Dao\Repositories\GroupModuleRepository;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Http\Services\UpdateGroupModuleService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;
use Modules\System\Http\Requests\DeleteRequest;

class GroupModuleController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $folder;

    public function __construct(GroupModuleRepository $model, SingleService $service)
    {
        self::$folder = self::$folder ?? 'System';
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
        self::$template = self::$template ?? Helper::getTemplate(__CLASS__);
    }

    public function index()
    {
        return view(Views::index())->with([
            'fields' => Helper::listData(self::$model->datatable),
        ]);
    }

    private function share($data = [])
    {
        $view = [
            'template' => self::$template,
        ];

        return array_merge($view, $data);
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

    public function data(DataService $service)
    {
        return $service
            ->setModel(self::$model)
            ->EditStatus(['system_group_module_enable' => self::$model->status])
            ->make();
    }

    private function getGroupModuleController($data)
    {
        $controller = [];
        $folder = ucfirst($data->system_group_module_folder);
        $directory = Storage::disk('modules')->files($folder . '/Http/Controllers');
        $remove = array_diff($directory, [$folder . '/Http/Controllers/.gitkeep']);

        $controllerName = collect($remove)->map(function ($item) use ($folder) {
            $deleteFolder = str_replace($folder . '/Http/Controllers/', '', $item);
            $deleteController = str_replace('Controller.php', '', $deleteFolder);
            return $deleteController;
        });
        $controller = $controllerName;

        return $controller;
    }

    public function edit($code)
    {
        $data = $this->get($code);
        $action = $data->connection_module()->get()->mapToGroups(function ($module) {

            return [$module->system_module_controller => $module->connection_action];

        })->map(function ($action) {
            $data = $action->first()->pluck('system_action_function');
            return $data;
        });

        $data_action = $action->toArray();

        return view(Views::update(self::$template, self::$folder))->with($this->share([
            'model' => $data,
            'controller' => $this->getGroupModuleController($data),
            'data_module' => $data->connection_module,
            'data_action' => $data_action,
        ]));
    }

    public function update($code, GeneralRequest $request, UpdateGroupModuleService $service)
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
            'key' => self::$model->getKeyName(),
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
