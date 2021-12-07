<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Linen\Dao\Facades\DeliveryFacades;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\Linen\Dao\Repositories\DeliveryRepository;
use Modules\Linen\Dao\Repositories\StockRepository;
use Modules\Report\Dao\Repositories\ReportInvoiceRumahSakitRepository;
use Modules\Report\Dao\Repositories\ReportLinenRegisterRepository;
use Modules\Report\Dao\Repositories\ReportLinenSummaryRepository;
use Modules\Report\Dao\Repositories\ReportStock;
use Modules\Report\Dao\Repositories\ReportStockRepository;
use Modules\Report\Http\Services\ReportSummaryService;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Dao\Repositories\LocationRepository;
use Modules\System\Dao\Repositories\TeamRepository;
use Modules\System\Http\Services\PreviewService;
use Modules\System\Http\Services\ReportService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Plugins\Views;

class StockController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $summary;

    public function __construct(ReportStockRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $product = Views::option(new ProductRepository());
        $location = Views::option(new LocationRepository());
        $company = Views::option(new CompanyRepository());
        $user = Views::option(new TeamRepository());
        $rent = Views::status(self::$model->rent, true);

        $status = TransactionStatus::getOptions([
            TransactionStatus::Transaction,
            TransactionStatus::Kotor,
            TransactionStatus::Bersih,
            TransactionStatus::Pending,
            TransactionStatus::Retur,
            TransactionStatus::Rewash,
        ]);

        $view = [
            'product' => $product,
            'location' => $location,
            'user' => $user,
            'company' => $company,
            'status' => $status,
            'rental' => $rent,
        ];

        return array_merge($view, $data);
    }

    public function summary(Request $request, PreviewService $service)
    {
        $stock = StockFacades::dataRepository();

        $master = $detail = $previw = [];
        if ($view_company_id = request()->get('view_company_id')) {
            $stock->where('view_company_id', $view_company_id);
        }
        if ($view_location_id = request()->get('view_location_id')) {
            $stock->where('view_location_id', $view_location_id);
        }
        if ($view_product_id = request()->get('view_product_id')) {
            $stock->where('view_product_id', $view_product_id);
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))->with($this->share([
            'preview' => $stock->get(),
            'model' => $stock
        ]));
    }

    public function summaryExport(Request $request, ReportService $service)
    {
        if ($request->get('action') == 'preview') {
            $data = $request->except('_token');
            return redirect()->route('report_stock_summary', $data)->withInput();
        }
        return $service->generate(self::$model, $request, 'excel_report_summary');
    }
}
