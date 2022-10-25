<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Facades\KotorFacades;
use Modules\Linen\Dao\Repositories\DeliveryRepository;
use Modules\Report\Dao\Repositories\ReportLinenBersihHarianRepository;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Http\Services\PreviewService;
use Modules\System\Http\Services\ReportService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Plugins\Views;
use Modules\Report\Http\Requests\LinenRequest;
use Modules\System\Http\Requests\GeneralRequest;

class LinenBersihController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $summary;

    public function __construct(ReportLinenBersihHarianRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $company = Views::option(new CompanyRepository());
        $delivery = Views::option(new DeliveryRepository());

        $view = [

            'company' => $company,
            'delivery' => $delivery,
        ];

        return array_merge($view, $data);
    }

    public function harian(GeneralRequest $request, PreviewService $service)
    {
        $linen = LinenFacades::dataRepository();

        $master = $location = $preview = $product = $detail = $date_from = $date_to = $kotor = $company = null;

        if (request()->all()) {
            $preview = $service->data($linen, $request);
            $query = self::$model->dataRepository()->with('has_detail');

            if ($company_id = request()->get('company_id')) {
                $query->where('linen_delivery_company_id', $company_id);
            }

            if ($key = request()->get('key')) {
                $query->where('linen_delivery_key', $key);
            }

            if ($from = request()->get('from')) {
                $query->whereDate('linen_delivery_created_at', '>=', $from);
            }
            if ($to = request()->get('to')) {
                $query->whereDate('linen_delivery_created_at', '<=', $to);
            }

            $query->whereNull('linen_delivery_deleted_at');

            // kotor

            $query2 = KotorFacades::dataRepository()->with('has_detail');

            if ($company_id = request()->get('company_id')) {
                $query2->where('linen_kotor_company_id', $company_id);
            }

            if ($key = request()->get('key')) {
                $query2->where('linen_kotor_key', $key);
            }

            $kotor_from = Carbon::createFromFormat('Y-m-d', request()->get('from'));
            $kotor_to = Carbon::createFromFormat('Y-m-d', request()->get('to'));

            if ($from = request()->get('from')) {
                $query2->whereDate('linen_kotor_created_at', '>=', $kotor_from->addDay(-1)->format('Y-m-d'));
            }
            if ($to = request()->get('to')) {
                $query2->whereDate('linen_kotor_created_at', '<=', $kotor_to->addDay(-1)->format('Y-m-d'));
            }

            $query2->whereNull('linen_kotor_deleted_at');

            //end kotor

            $kotor = $query2->first();

            $company = CompanyFacades::find(request()->get('company_id'));
            $location = $company->has_location ?? [];
            $product = $company->has_product ?? [];

            $master = $query->first();
            $detail = [];
            if ($master) {

                $detail = $master->has_detail()->get();
            }

            $date_from = Carbon::createFromFormat('Y-m-d', request()->get('from'));
            $date_to = Carbon::createFromFormat('Y-m-d', request()->get('to'));
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))->with($this->share([
            'preview' => $preview,
            'model' => $linen->getModel(),
            'master' => $master,
            'kotor' => $kotor ?? [],
            'location' => $location,
            'product' => $product,
            'detail' => $detail,
            'date_from' => $date_from,
            'date_to' => $date_to,
        ]));
    }

    public function harianExport(LinenRequest $request, ReportService $service)
    {
        if ($request->get('action') == 'preview') {
            $data = $request->except('_token');
            return redirect()->route('report_linen_bersih_harian', $data)->withInput();
        }
        return $service->generate(self::$model, $request, 'excel_linen_bersih_harian');
    }
}
