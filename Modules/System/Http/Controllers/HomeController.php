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
use Modules\System\Http\Charts\KotorBersihChart;
use Modules\System\Http\Charts\StockChart;
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

        // =========================== STOCK LINEN ====================

        $stock_linen = DB::table('view_stock_linen')->orderBy('stock_total')->get()->take(15);
        $stock_label = $stock_linen->pluck('loc_name');
        $stock = array_map('intval', $stock_linen->pluck('stock_total')->toArray());
        $bersih = array_map('intval', $stock_linen->pluck('stock_bersih')->toArray());

        $stock_chart = new HomeChart();
        $stock_chart->labels($stock_label);
        $stock_chart->dataset('Pemakaian Linen per Ruangan', 'bar', $bersih)->backgroundColor('#0088cc')->fill(true);
        $stock_chart->dataset('Setup Stock Linen', 'bar', $stock)->backgroundColor('#F78A01')->fill(true);
        $stock_chart->options([
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ]
        ]);

        // =========================== PEMAKAIAN LINEN ====================

        $pemakaian_linen = DB::table('view_pemakaian_linen')->get();
        $pemakaian_label = $pemakaian_linen->pluck('product_name');
        $pakai = $pemakaian_linen->pluck('total');

        $pemakaian_chart = new HomeChart();
        $pemakaian_chart->labels($pemakaian_label);
        $pemakaian_chart->dataset('Pemakaian Linen', 'bar', $pakai)->backgroundColor('#0088cc')->fill(true);
        $pemakaian_chart->options([
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ]
        ]);

        // ============================== KOTOR BERSIH =======================

        $kotor_bersih = DB::table('view_kotor_bersih')->get();
        $kotor_bersih_label = $kotor_bersih->pluck('loc_name');
        $data_kotor = $kotor_bersih->pluck('total_kotor');
        $data_bersih = $kotor_bersih->pluck('total_bersih');

        $kotor_bersih_chart = new HomeChart();
        $kotor_bersih_chart->labels($kotor_bersih_label);
        $kotor_bersih_chart->dataset('Kotor', 'bar', $data_kotor)->backgroundColor('#0088cc')->fill(true);
        $kotor_bersih_chart->dataset('Bersih', 'bar', $data_bersih)->backgroundColor('#F78A01')->fill(true);
        $kotor_bersih_chart->options([
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ]
        ]);

        // ============================== MIN MAX =======================

        $min_max = DB::table('view_min_max')->get();
        $min_max_label = $min_max->pluck('linen_name');
        $data_min = $min_max->pluck('min_kotor');
        $data_max = $min_max->pluck('max_kotor');

        $min_max_chart = new HomeChart();
        $min_max_chart->labels($min_max_label);
        $min_max_chart->dataset('Pemakaian Maksimum', 'bar', $data_max)->backgroundColor('#0088cc')->fill(true);
        $min_max_chart->dataset('Pemakaian Minimum', 'bar', $data_min)->backgroundColor('#F78A01')->fill(true);
        $min_max_chart->options([
            'tooltip' => [
                'show' => true // or false, depending on what you want.
            ]
        ]);


        return view(Views::form('dashboard', 'home'))->with([
            'pemakaian_chart' => $pemakaian_chart,
            'stock_chart' => $stock_chart,
            'kotor_bersih_chart' => $kotor_bersih_chart,
            'min_max_chart' => $min_max_chart,
        ]);
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
