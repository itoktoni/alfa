<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Report\Dao\Repositories\HistoryLinenRepository;
use Modules\Report\Dao\Repositories\ReportBersihRepository;
use Modules\Report\Dao\Repositories\ReportKotorRepository;
use Modules\Report\Dao\Repositories\ReportLinenRepository;
use Modules\Report\Dao\Repositories\ReportOutstandingRepository;
use Modules\Report\Http\Requests\CompanyRequest;
use Modules\Report\Http\Requests\PendingRequest;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Services\ReportService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Views;

class RekapLinenController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $history;
    public static $summary;

    private function share($data = [])
    {
        $list_product = Views::option(new ProductRepository());
        $list_location = Views::option(new LocationRepository());
        $list_company = Views::option(new CompanyRepository());

        $list_user = Views::option(new TeamRepository());
        $list_status = TransactionStatus::getOptions([
            TransactionStatus::Transaction,
            TransactionStatus::Kotor,
            TransactionStatus::Retur,
            TransactionStatus::Rewash,
        ]);
        $list_description = LinenStatus::getOptions();

        $company = CompanyFacades::find(request()->get('view_company_id'));
        $location = $company->has_location ?? [];
        $product = $company->has_product ?? [];

        $view = [
            'list_product' => $list_product,
            'list_location' => $list_location,
            'list_company' => $list_company,
            'list_user' => $list_user,
            'list_status' => $list_status,
            'list_description' => $list_description,
            'company' => $company,
            'location' => $location,
            'product' => $product,
        ];

        return array_merge($view, $data);
    }

    public function pending(ReportOutstandingRepository $repository)
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

    public function pendingExport(PendingRequest $request, ReportService $service, ReportOutstandingRepository $repository)
    {
        return $service->generate([$repository, 'share' => $this->share()], Helper::snake(__FUNCTION__));
    }

    public function kotor(ReportKotorRepository $repository)
    {
        $preview = $bersih = false;
        if ($name = request()->get('name')) {
            $preview = $repository->generate($name, $this->share([
            ]))->data();
            $bersih = $repository->data2();
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))
            ->with($this->share([
                'model' => $repository,
                'preview' => $preview,
                'bersih' => $bersih,
                'include' => __FUNCTION__,
            ]));
    }

    public function kotorExport(CompanyRequest $request, ReportService $service, ReportKotorRepository $repository)
    {
        return $service->generate([$repository, 'share' => $this->share([
            'bersih' => $repository->data2(),
        ])], Helper::snake(__FUNCTION__));
    }

    public function bersih(ReportBersihRepository $repository)
    {
        $preview = false;
        if ($name = request()->get('name')) {
            $preview = $repository->generate($name, $this->share())->data();
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))
            ->with($this->share([
                'model' => $repository,
                'kotor' => $repository->data2(),
                'preview' => $preview,
                'include' => __FUNCTION__
            ]));
    }

    public function bersihExport(ReportService $service, ReportBersihRepository $repository)
    {
        return $service->generate([$repository, 'share' => $this->share([
            'kotor' => $repository->data2(),
        ])], Helper::snake(__FUNCTION__));
    }
}
