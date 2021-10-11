<?php

namespace Modules\System\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\CreateService;
use Modules\System\Http\Services\DataService;
use Modules\System\Http\Services\DeleteService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Dao\Repositories\GroupModuleRepository;
use Modules\System\Dao\Repositories\GroupUserRepository;
use Modules\System\Http\Services\UpdateGroupUserService;
use Modules\System\Plugins\Views;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Http\Requests\DeleteRequest;

class GroupUserController extends Controller
{
    public static $template;
    public static $folder;
    public static $service;
    public static $model;

    public function __construct(GroupUserRepository $model, SingleService $service)
    {
        self::$folder = self::$folder ?? 'system';
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
        self::$template = self::$template ?? Helper::getTemplate(__CLASS__);
    }

    public function index()
    {
        return view(Views::index())->with([
            'template' => self::$template,
            'fields' => Helper::listData(self::$model->datatable),
        ]);
    }

    private function share($data = [])
    {
        $group = Helper::createOption((new GroupModuleRepository()), false, true, false)
            ->pluck('system_group_module_name', 'system_group_module_code')
            ->prepend('- Select Group -', '');

        $view = [
            'group' => $group,
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
            ->make();
    }

    public function edit($code)
    {
        $data = $this->get($code);
        return view(Views::update(self::$template, self::$folder))->with($this->share([
            'model' => $data,
            'group_module' => $data->connection_group_module ? $data->connection_group_module->pluck('system_group_module_code')->toArray() : [],
        ]));
    }

    public function update($code, GeneralRequest $request, UpdateGroupUserService $service)
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
