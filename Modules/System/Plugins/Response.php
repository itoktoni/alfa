<?php

namespace Modules\System\Plugins;

use Illuminate\Support\Facades\Route;

class Response
{
    public static function sentJson($data)
    {
        return response()->json($data);
    }

    public static function redirectBack($data = null)
    {
        if(request()->wantsJson()){
            return self::sentJson($data);
        }
        if(isset($data['name']) && $data['name'] == 'Update'){
            return redirect()->route(config('module').'_index');
        }
        
        return redirect()->back();
    }

    public static function redirectBackWithInput($data = null)
    {
        if (request()->wantsJson()) {
            return self::sentJson($data);
        }
        if(isset($data['name']) && $data['name'] == 'Update'){
            return redirect()->route(config('module').'_index');
        }
        return redirect()->back()->withInput();
    }

    public static function redirectRefresh($data = null)
    {
        if (request()->wantsJson()) {
            return self::sentJson($data);
        }
        return redirect()->refresh();
    }

    public static function redirect($path, $data = null)
    {
        if (request()->wantsJson()) {
            return self::sentJson($data);
        }
        return redirect()->away($path);
    }

    public static function redirectTo($path, $params = false, $data)
    {
        if ($params) {
            return redirect()->to($path, $params);
        }
        return redirect()->to($path);
    }

    public static function redirectToRoute($data, $route, $params = false)
    {
        if(request()->wantsJson()){
            return self::sentJson($data);
        }
        if ($params) {
            return redirect()->route($route, $params);
        }
        return redirect()->route($route);
    }

    public static function redirectToAction($action, $params = false)
    {
        if ($params) {
            return redirect()->to($action, $params);
        }
        return redirect()->route($action);
    }
}
