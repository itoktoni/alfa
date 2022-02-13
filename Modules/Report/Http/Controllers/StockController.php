<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Report\Dao\Repositories\ReportStockRepository;
use Modules\Report\Http\Requests\CompanyRequest;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Http\Services\ReportService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Views;

class StockController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $history;
    public static $summary;

    private function share($data = [])
    {
        $product = Views::option(new ProductRepository());
        $location = Views::option(new LocationRepository());
        $company = Views::option(new CompanyRepository());

        $view = [
            'product' => $product,
            'location' => $location,
            'company' => $company,
        ];

        return array_merge($view, $data);
    }

    public function summary(ReportStockRepository $repository)
    {
        $preview = false;
        if ($name = request()->get('name')) {
            $preview = $repository->generate($name, $this->share())->data();
        }
        return view(Views::form(__FUNCTION__, config('page'), config('folder')))
            ->with($this->share([
                'model' => $repository,
                'preview' => $preview,
                'include' => __FUNCTION__
            ]));
    }

    public function summaryExport(CompanyRequest $request, ReportService $service, ReportStockRepository $repository)
    {
        return $service->generate([$repository, 'share' => $this->share()], Helper::snake(__FUNCTION__));
    }
}
