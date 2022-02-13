<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Report\Dao\Repositories\ReportInvoiceRepository;
use Modules\Report\Dao\Repositories\ReportStockRepository;
use Modules\Report\Http\Requests\CompanyRequest;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Http\Services\ReportService;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Views;

class InvoiceController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $history;
    public static $summary;

    private function share($data = [])
    {
        $list_company = Views::option(new CompanyRepository());
        $list_product = Views::option(new ProductRepository());

        $company = CompanyFacades::find(request()->get('view_company_id'));
        $product = $company->has_product ?? [];
        $view = [
            'company' => $company,
            'product' => $product,
            'list_product' => $list_product,
            'list_company' => $list_company,
        ];

        return array_merge($view, $data);
    }

    public function detail(ReportInvoiceRepository $repository)
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

    public function detailExport(CompanyRequest $request, ReportService $service, ReportInvoiceRepository $repository)
    {
        return $service->generate([$repository, 'share' => $this->share()], Helper::snake(__FUNCTION__));
    }
}
