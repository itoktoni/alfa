<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Repositories\ProductRepository;
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

class RegisterLinenController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $summary;

    public function __construct(ReportLinenRegisterRepository $model, ReportLinenSummaryRepository $summary, SingleService $service)
    {
        self::$summary = self::$summary ?? $summary;
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $product = Views::option(new ProductRepository());
        $location = Views::option(new LocationRepository());
        $company = Views::option(new CompanyRepository());
        $user = Views::option(new TeamRepository());
        $status = Views::status(self::$model->status, true);
        $rent = Views::status(self::$model->rent, true);

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

    public function detail(Request $request, PreviewService $service)
    {
        $preview = null;
        $linen = LinenFacades::dataRepository();
        if(request()->all()){

            $preview = $service->data($linen, $request);
        }
        
        return view(Views::form(__FUNCTION__,config('page'), config('folder')))->with($this->share([
            'preview' => $preview,
            'model' => $linen->getModel(),
        ]));
    }

    public function detailExport(Request $request, ReportService $service)
    {
        if ($request->get('action') == 'preview') {
            $data = $request->except('_token');
            return redirect()->route('report_register_linen_detail', $data)->withInput();
        }
        return $service->generate(self::$model, $request, 'report_register_linen_detail');
    }

    public function summary(Request $request, PreviewService $service)
    {
        $preview = null;
        $linen = LinenFacades::dataRepository();
        if(request()->all()){

            $query = $linen->whereNull('item_linen_deleted_at');
            if ($item_linen_company_id = request()->get('item_linen_company_id')) {
                $query->where('item_linen_company_id', $item_linen_company_id);
            }
            if ($item_linen_location_id = request()->get('item_linen_location_id')) {
                $query->where('item_linen_location_id', $item_linen_location_id);
            }
            if ($item_linen_product_id = request()->get('item_linen_product_id')) {
                $query->where('item_linen_product_id', $item_linen_product_id);
            }
            if ($item_linen_created_by = request()->get('item_linen_created_by')) {
                $query->where('item_linen_created_by', $item_linen_created_by);
            }
            if ($item_linen_updated_by = request()->get('item_linen_updated_by')) {
                $query->where('item_linen_updated_by', $item_linen_updated_by);
            }
            if ($item_linen_rent = request()->get('item_linen_rent')) {
                $query->where('item_linen_rent', $item_linen_rent);
            }
            if ($item_linen_status = request()->get('item_linen_status')) {
                $query->where('item_linen_status', $item_linen_status);
            }
            if ($from = request()->get('from')) {
                $query->whereDate('item_linen_created_at', '>=', $from);
            }
            if ($to = request()->get('to')) {
                $query->whereDate('item_linen_created_at','<=', $to);
            }

            $preview =  $query->addSelect(DB::raw('count(item_linen_id) as qty'))
            ->groupBy('item_linen_company_id', 'item_linen_product_id')->get();
            
        }
        
        return view(Views::form(__FUNCTION__ ,config('page'), config('folder')))->with($this->share([
            'preview' => $preview,
            'model' => $linen->getModel(),
        ]));
    }

    public function summaryExport(Request $request, ReportService $service)
    {
        if ($request->get('action') == 'preview') {
            $data = $request->except('_token');
            return redirect()->route('report_register_linen_summary', $data)->withInput();
        }
        return $service->generate(self::$summary, $request, 'excel_report_summary');
    }
}
