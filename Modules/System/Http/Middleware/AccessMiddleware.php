<?php

namespace Modules\System\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Modules\System\Dao\Facades\GroupUserConnectionGroupModuleFacades;
use Modules\System\Dao\Facades\GroupUserFacades;
use Modules\System\Dao\Models\Action;
use Modules\System\Dao\Models\GroupModuleConnectionModule;
use Modules\System\Dao\Models\Module;
use Modules\System\Dao\Models\ModuleConnectionAction;
use Modules\System\Dao\Repositories\GroupModuleRepository;
use Modules\System\Plugins\Helper;

class AccessMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public static $groupUser;
    public static $groupAccess;
    public static $username;
    public static $action;
    public static $module;
    public static $module_connection_action;
    public static $group_module_connection_module;
    public static $group_module;
    public static $list_group_module;

    public $white_list = [
        'home', 'beranda', 'dashboard', 'console', 'configuration', 'route', 'file', 'livewire', 'user', 'profile', 'language',
    ];

    public function __construct(Action $action, Module $module, ModuleConnectionAction $module_connection_action, GroupModuleConnectionModule $group_module_connection_module, GroupModuleRepository $group_module)
    {
        self::$action = $action;
        self::$module = $module;
        self::$group_module = $group_module;
        self::$module_connection_action = $module_connection_action;
        self::$group_module_connection_module = $group_module_connection_module;

        if (self::$username == null && auth()->check()) {
            self::$username = Auth::user()->username ?? null;
            self::$groupUser = Auth::user()->group_user ?? null;
            self::$groupAccess = session()->get(Auth::User()->username . '_group_access') ?? null;
        }


        if (self::$list_group_module == null && auth()->check()) {
            if (Cache::has(self::$username . '_group_list')) {
                self::$list_group_module = Cache::get(self::$username . '_group_list');
            } else {
                $group_list = DB::table(GroupUserConnectionGroupModuleFacades::getTable())
                    ->join(self::$group_module->getTable(), self::$group_module->getTable() . '.' . self::$group_module->getKeyName(), GroupUserConnectionGroupModuleFacades::getTable() . '.' . self::$group_module->getKeyName())
                    ->where(GroupUserFacades::getKeyName(), auth()->user()->group_user)->get();
                // $group_list = GroupUserConnectionGroupModuleFacades::find(self::$groupUser);
                self::$list_group_module = $group_list;
                Cache::rememberForever(self::$username . '_group_list', function () use ($group_list) {
                    return $group_list;
                });
            }
        }
    }

    public function handle($request, Closure $next)
    {
        if (auth()->user()->group_user == 'customer' && auth()->check()) {
            return redirect()->to('/');
        }
        $access = $this->gate($this->data());
        if (!$access) {
            abort(403);
        }
        $route = request()->route() ?? false;
        $module = request()->segment(2) ?? false;
        $action_code = $route->getName() ?? 'home';
        $data_action = $access->where('system_action_code', $action_code)->first();
        $action_function = $route->getActionMethod() ?? false;
        $template = null;
        if (isset($route->getAction()['controller'])) {

            $arrayController = explode('@', $route->getAction()['controller']) ?? [];
            $template = Helper::getTemplate($arrayController[0]);
        }

        $group = null;

        if ($action_code == 'access_group' || in_array($action_code, $this->white_list)) {
            if (self::$groupAccess && self::$list_group_module->where('system_group_module_code', self::$groupAccess)->first()) {
                $data_group = self::$list_group_module->where('system_group_module_code', self::$groupAccess)->first();
            } else {
                $data_group = self::$list_group_module->first();
            }
            if ($data_group) {
                $folder = $data_group->system_group_module_folder;
                $group = $data_group->system_group_module_code;
            }
        } else {
            if (!$data_action && $action_code != 'home') {
                abort(403);
            }

            $groupping = $access->where('system_action_code', $action_code)->where('system_group_module_code', self::$groupAccess)->first();
            if ($groupping) {
                $folder = $groupping->system_module_folder;
                $group = $groupping->system_group_module_code;
            } else {
                $folder = $data_action->system_module_folder;
                $group = $data_action->system_group_module_code;
            }
        }
        session()->put(self::$username . '_group_access', $group);
        $action_list = $access->where('system_group_module_code', $group)->unique('system_action_code');
        $menu_list = $action_list->unique('system_module_code')->SortByDesc('system_module_sort');
        $action = $action_list->where('system_module_code', $module)->pluck('system_module_folder', 'system_action_function');
        // $model = $route->getController()::$model ?? false;
        // $datatable = Helper::listData($model->datatable);
        view()->share([
            // 'module_model'           => $model,
            // 'module_datatable'       => $datatable['fields'] ?? [],
            // 'module_width'           => $datatable['width'] ?? [],
            // 'primaryKey'      => $model->getKeyName(),
            'module' => $module,
            'actions' => $action,
            'action_code' => $action_code,
            'action_list' => $action_list,
            'action_function' => $action_function,
            'group_list' => self::$list_group_module,
            'menu_list' => $menu_list,
            'folder' => !empty($folder) ? ucfirst($folder) : null,
            'form' => !empty($folder) ? Str::snake($folder) . '_' . $template . '_' : '',
            'template' => $template,
            'search_code' => $template . '_code',
            'form_name' => ucwords(str_replace('_', ' ', $template == 'module' ? 'modules' : $template)),
            'template_action' => 'System::page.master.crud',
            'route_data' => $module . '_data',
            'route_index' => $module . '_index',
            'route_update' => $module . '_update',
            'route_edit' => $module . '_edit',
            'route_create' => $module . '_create',
            'route_save' => $module . '_save',
            'route_show' => $module . '_show',
            'route_delete' => $module . '_delete',
            'route_source' => $module . '_source',
        ]);
        config()->set('page', strtolower($template));
        config()->set('module', $module);
        config()->set('folder', !empty($folder) ? ucfirst($folder) : null);
        config()->set('action', $action->toArray());
        return $next($request);
    }

    public function data()
    {
        if (Cache::has(self::$username . '_access_menu')) {
            return Cache::get(self::$username . '_access_menu');
        }

        return Cache::rememberForever(self::$username . '_access_menu', function () {

            $routing = DB::table(self::$action->getTable())->select(['system_action.*', 'system_module.*', 'system_group_module_code'])
                ->leftJoin(self::$module_connection_action->getTable(), self::$module_connection_action->getTable() . '.' . self::$action->getKeyName(), '=', self::$action->getTable() . '.' . self::$action->getKeyName())
                ->leftJoin(self::$module->getTable(), self::$module->getTable() . '.' . self::$module->getKeyName(), '=', self::$module_connection_action->getTable() . '.' . self::$module->getKeyName())
                ->leftJoin(self::$group_module_connection_module->getTable(), self::$group_module_connection_module->getTable() . '.' . self::$module->getKeyName(), '=', self::$module->getTable() . '.' . self::$module->getKeyName())
                ->where('system_module_enable', 1)
                ->orderBy('system_module_sort', 'asc')
                ->orderBy('system_action_path', 'asc')
                ->orderBy('system_action_function', 'asc')
                ->orderBy('system_action_sort', 'asc');

            return $routing->get();
        });
    }

    public function gate($access)
    {
        $segment = request()->segment(1) ?? '';
        $policy = $access->contains('system_action_code', Route::currentRouteName());
        if (!$policy && !in_array($segment, $this->white_list)) {
            return false;
        }
        return $access;
    }
}
