<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Repositories\DeliveryRepository;
use Modules\Report\Dao\Repositories\ReportLinenKotorHarianRepository;
use Modules\Report\Dao\Repositories\ReportLinenKotorRumahSakitRepository;
use Modules\Report\Dao\Repositories\ReportLinenPendingHarianRepository;
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

class LinenPendingController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $summary;

    public function __construct(ReportLinenPendingHarianRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $company = Views::option(new CompanyRepository());
        $product = Views::option(new ProductRepository());
        $location = Views::option(new LocationRepository());
        $user = Views::option(new TeamRepository());
        $status = Views::status(self::$model->status, true);
        $description = Views::status(self::$model->description, true);

        $view = [
            'product' => $product,
            'location' => $location,
            'user' => $user,
            'company' => $company,
            'status' => $status,
            'description' => $description,
        ];

        return array_merge($view, $data);
    }

    public function harian(Request $request, PreviewService $service)
    {
        $preview = null;
        $linen = OutstandingFacades::dataRepository();
        if(request()->all()){

            $preview = $service->data($linen, $request);
        }

        return view(Views::form(__FUNCTION__,config('page'), config('folder')))->with($this->share([
            'preview' => $preview,
            'model' => $linen->getModel(),
        ]));
    }

    public function harianExport(Request $request, ReportService $service)
    {
        if ($request->get('action') == 'preview') {
            $data = $request->except('_token');
            return redirect()->route('report_linen_pending_harian', $data)->withInput();
        }
        return $service->generate(self::$model, $request, 'excel_linen_pending_harian');
    }
}
