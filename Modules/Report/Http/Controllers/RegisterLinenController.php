<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Report\Dao\Repositories\HistoryLinenRepository;
use Modules\Report\Dao\Repositories\ReportLinenRepository;
use Modules\Report\Http\Requests\StockRequest;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Requests\GeneralRequest;
use Modules\System\Http\Services\ReportService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Views;

class RegisterLinenController extends Controller
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

        $user = Views::option(new TeamRepository());
        $status = LinenStatus::getOptions([
            LinenStatus::StatusLinen,
            LinenStatus::Register,
            LinenStatus::GantiChip
        ]);
        $rent = LinenStatus::getOptions([
            LinenStatus::StatusLinen,
            LinenStatus::Rental,
            LinenStatus::Cuci
        ]);
        $description = LinenStatus::getOptions();

        $view = [
            'product' => $product,
            'location' => $location,
            'user' => $user,
            'company' => $company,
            'status' => $status,
            'rental' => $rent,
            'description' => $description,
        ];

        return array_merge($view, $data);
    }

    public function summary(ReportLinenRepository $repository)
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

    public function summaryExport(ReportService $service, ReportLinenRepository $repository)
    {
        return $service->generate([$repository, 'share' => $this->share()], Helper::snake(__FUNCTION__));
    }

    public function detail(ReportLinenRepository $repository)
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

    public function detailExport(ReportService $service, ReportLinenRepository $repository)
    {
        return $service->generate([$repository, 'share' => $this->share()], Helper::snake(__FUNCTION__));
    }

    public function history(HistoryLinenRepository $repository)
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

    public function historyExport(ReportService $service, HistoryLinenRepository $repository)
    {
        return $service->generate([$repository, 'share' => $this->share()], Helper::snake(__FUNCTION__));
    }
}
