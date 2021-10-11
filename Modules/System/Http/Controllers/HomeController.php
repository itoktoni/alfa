<?php

namespace Modules\System\Http\Controllers;

use App\Http\Controllers\Controller;
use Closure;
use Alkhachatryan\LaravelWebConsole\LaravelWebConsole;
use Illuminate\Support\Facades\Cache;
use Config;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Modules\System\Dao\Facades\GroupUserFacades;
use Modules\System\Http\Charts\HomeChart;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Response;
use Modules\System\Plugins\Views;

class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'access', 'verified']);
    }

    public function route()
    {
        $middlewareClosure = function ($middleware) {
            return $middleware instanceof Closure ? 'Closure' : $middleware;
        };

        $routes = collect(Route::getRoutes());

        foreach (config('pretty-routes.hide_matching') as $regex) {
            $routes = $routes->filter(function ($value, $key) use ($regex) {
                return !preg_match($regex, $value->uri());
            });
        }

        return view(Views::form('route', 'home'), [
            'routes' => $routes,
            'middlewareClosure' => $middlewareClosure,
        ]);
    }

    public function console()
    {
        return LaravelWebConsole::show();
    }

    public function session_group($code)
    {
        session()->put(Auth::User()->username . '_group_access', $code);
        return redirect()->to(route('home'));
    }

    public function dashboard()
    {
        if (!config('website.application') && auth()->user()->group_user == 'customer') {
            return redirect('/');
        }

        $username = auth()->user()->username;
        
        $chart = new HomeChart();
        $chart->labels(['One', 'Two', 'Three', 'Four']);
        $chart->dataset('My dataset', 'line', [1, 2, 3, 4])->backgroundColor('#0088cc')->fill(true);
        $chart->dataset('My dataset 2', 'line', [4, 3, 2, 1])->backgroundColor('#ddf1fa')->fill(true);
        $chart->options([
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ]
        ]);

        return view(Views::form('dashboard', 'home'))->with(['chart' => $chart]);
    }

    public function configuration()
    {
        return redirect('/setting');
    }

    public function language()
    {
        return redirect('/languages');
    }

}
