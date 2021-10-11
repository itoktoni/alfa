<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController {

	use AuthorizesRequests,
	DispatchesJobs,
		ValidatesRequests;

	function __construct() {

		$this->menu();

	}

	public function getModule() {

		// $array = Cache::get('routing');
		// $name = Route::currentRouteName();
		// // dd(Route::currentRouteName());
		// $route = $array->where('action_code', $name)->first();
		// // dd($array->where('action'));
		// return $route;
		$split = explode('/', Route::current()->uri);
		return $split[1];
	}

	public function split() {

		if (Route::getCurrentRoute()->getActionName() == 'Closure') {
			return null;
		} else {

			$colek = Cache::get(Auth::user()->username . '_access_menu')
				->where('action_code', Route::currentRouteName())
				->first();

			if (empty($colek->module_filters)) {
				return $colek->module_filters;
			} else {
				return collect(explode(',', rtrim($colek->module_filters, ',')));
			}
		}
	}

	public function filter($model) {
		$filter = null;
		if (Auth::check()) {
			$filter = $this->split();
		}
		if (!empty($filter)) {
			if (!empty(trim($filter->first()))) {
				foreach ($filter as $d) {
					$cari = array_search($d, $this->field);
					$model->whereIn($cari == false ? 'users.' . $d : $this->table . '.' . $d, function ($query) use ($d) {
						$query->select('value')->from('filters')
							->Where('key', '=', Auth::user()->$d);
					});
				}
			}
		}

		return $model;
	}

	public function getAction() {

		$routeArray = app('request')->route()->getAction();
		$controllerAction = class_basename($routeArray['controller']);
		list($controller, $action) = explode('@', $controllerAction);
		return $action;
	}

	public function getTemplate() {

		return Str::snake(str_replace_last('Controller', '', $this->getController()));
	}

	public function getController() {

		return (new \ReflectionClass($this))->getShortName();
	}

	public function validasi($model) {
		$filter = $this->split();
		if (!empty($filter)) {
			if (!empty(trim($filter->first()))) {
				foreach ($filter as $d) {
					$cari = array_search($d, $this->field);
					$model->whereIn($cari == false ? 'users.' . $d : $this->table . '.' . $d, function ($query) use ($d) {
						$query->select('value')->from('filters')
							->Where('key', '=', Auth::user()->$d);
					});
				}
			}
		}

		$cek = $model;
		if (!empty($cek)) {
			return $model;
		} else {
			abort(403, 'Unauthorized Action for This Pages !');
		}

	}

	public function getMethod($class, $module = true) {

		if ($module) {
			return [];
		} else {
			$className = 'App\\Http\\Controllers\\' . ucfirst(Str::camel($class . '_controller'));
			$reflector = new \ReflectionClass($className);
			$methodNames = array();
			foreach ($reflector->getMethods(\ReflectionMethod::IS_PUBLIC) as $method) {
				if ($method->class == $reflector->getName() && $method->name != '__construct' && $method->name != 'index') {
					$methodNames[] = $method->name;
				}

			}

			return $methodNames;
		}

	}

	function menu() {

		View::share('test', url('/public/assets/'));

//        $redis = Redis::connection();
		//        $key = 'itoktoni_redis';
		//        if (!$redis->exists($key)) {
		//
		//            $redis->hmset($key, array(
		//                'group_module:' => 'sales#link#0;warehouse#link#0;master#link#0;home#link#1;branch#link#0',
		//                'module:' => 'sales#Create SO#create_so;master#Data Master#create_so;branch#Data Branch#create',
		//                'access:' => 'create_so#save;create_so#filter'
		//                    )
		//            );
		//        }
		//
		//        $data_groups = Redis::hget('itoktoni_redis', 'group_module:');
		//        $groups = collect(explode(';', $data_groups));
		//        View::share('groups', $groups);
		//
		//        $data_modules = Redis::hget('itoktoni_redis', 'module:');
		//        $modules = collect(explode(';', $data_modules));
		//        View::share('modules', $modules);
		//dd($modules);
	}

}
