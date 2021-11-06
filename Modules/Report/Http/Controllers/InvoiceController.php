<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Linen\Dao\Facades\DeliveryFacades;
use Modules\Linen\Dao\Repositories\DeliveryRepository;
use Modules\Report\Dao\Repositories\ReportInvoiceRumahSakitRepository;
use Modules\Report\Dao\Repositories\ReportLinenRegisterRepository;
use Modules\Report\Dao\Repositories\ReportLinenSummaryRepository;
use Modules\Report\Http\Services\ReportSummaryService;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Services\PreviewService;
use Modules\System\Http\Services\ReportService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Plugins\Views;

class InvoiceController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $summary;

    public function __construct(ReportInvoiceRumahSakitRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $company = Views::option(new CompanyRepository());
        $delivery = Views::option(new DeliveryRepository(), false, true);

        $data_delivery = $delivery->mapWithKeys(function ($data, $item) {
            return [$data->linen_delivery_key => $data->linen_delivery_key . ' - ' . $data->linen_delivery_company_name];
        });
        $view = [

            'company' => $company,
            'delivery' => $data_delivery,
        ];

        return array_merge($view, $data);
    }

    public function rumahSakit(Request $request, PreviewService $service)
    {
        $linen = DeliveryFacades::dataRepository()->with('has_detail');

        $master = $detail = $previw = [];
        if ($key = request()->get('key')) {
            $linen->where('linen_delivery_key', $key);
            $linen->whereNull('linen_delivery_deleted_at');
            $master = $linen->first();
        }

        if ($master) {

            $detail = $master->has_detail()->get()->groupBy('linen_grouping_detail_product_id');
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))->with($this->share([
            'preview' => $master,
            'model' => $linen->getModel(),
            'master' => $master,
            'detail' => $detail
        ]));
    }

    public function rumahSakitExport(Request $request, ReportService $service)
    {
        if ($request->get('action') == 'preview') {
            $data = $request->except('_token');
            return redirect()->route('report_invoice_rumah_sakit', $data)->withInput();
        }
        return $service->generate(self::$model, $request, 'excel_report_invoice');
    }
}
