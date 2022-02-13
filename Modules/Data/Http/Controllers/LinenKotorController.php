<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Facades\DeliveryFacades;
use Modules\Linen\Dao\Models\KotorDetail;
use Modules\Linen\Dao\Repositories\KotorRepository;
use Modules\Report\Dao\Repositories\ReportLinenKotorHarianRepository;
use Modules\Report\Http\Requests\LinenKotorRequest;
use Modules\Report\Http\Requests\LinenRequest;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Http\Services\PreviewService;
use Modules\System\Http\Services\ReportService;
use Modules\System\Http\Services\SingleService;
use Modules\System\Plugins\Views;

class LinenKotorController extends Controller
{
    public static $template;
    public static $service;
    public static $model;
    public static $summary;

    public function __construct(ReportLinenKotorHarianRepository $model, SingleService $service)
    {
        self::$model = self::$model ?? $model;
        self::$service = self::$service ?? $service;
    }

    private function share($data = [])
    {
        $company = Views::option(new CompanyRepository());
        $key = Views::option(new KotorRepository());

        $view = [

            'company' => $company,
            'key' => $key,
        ];

        return array_merge($view, $data);
    }

    public function harian(Request $request, PreviewService $service)
    {
        $linen = LinenFacades::dataRepository();
        $master = $preview = $location = $product = $detail = $date_from = $date_to = $bersih = null;
        
        if(request()->all()){
            $preview = $service->data($linen, $request);
            $query = KotorDetail::query();

            if ($company_id = request()->get('company_id')) {
                $query->where('linen_kotor_detail_scan_company_id', $company_id);
            }

            if ($key = request()->get('key')) {
                $query->where('linen_kotor_detail_key', $key);
            }

            if ($from = request()->get('from')) {
                $query->whereDate('linen_kotor_detail_created_at', '>=', $from);
            }
            if ($to = request()->get('to')) {
                $query->whereDate('linen_kotor_detail_created_at', '<=', $to);
            }

            $query->whereNull('linen_kotor_detail_deleted_at');

            $query2 = DeliveryFacades::dataRepository()->with('has_detail');

            if ($company_id = request()->get('company_id')) {
                $query2->where('linen_delivery_company_id', $company_id);
            }

            $bersih_from = Carbon::createFromFormat('Y-m-d', request()->get('from'));
            $bersih_to = Carbon::createFromFormat('Y-m-d', request()->get('to'));

            if ($from = request()->get('from')) {
                $query2->whereDate('linen_delivery_reported_date', '>=', $bersih_from->format('Y-m-d'));
            }
            if ($to = request()->get('to')) {
                $query2->whereDate('linen_delivery_reported_date', '<=', $bersih_to->format('Y-m-d'));
            }

            //end kotor

            $bersih = $query2->first();
            
            $company = CompanyFacades::find(request()->get('company_id'));
            $location = $company->has_location ?? [];
            $product = $company->has_product ?? [];
            
            $detail = [];
            if ($query->count() > 0) {
                
                $detail = $query->get();
            }
            
            $master = $query->first();

            $date_from = Carbon::createFromFormat('Y-m-d', request()->get('from'));
            $date_to = Carbon::createFromFormat('Y-m-d', request()->get('to'));
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))->with($this->share([
            'preview' => $preview,
            'model' => $linen->getModel(),
            'master' => $master,
            'location' => $location,
            'product' => $product,
            'detail' => $detail,
            'date_from' => $date_from,
            'date_to' => $date_to,
            'bersih' => $bersih,
        ]));
    }

    public function harianExport(LinenRequest $request, ReportService $service)
    {
        if ($request->get('action') == 'preview') {
            $data = $request->except('_token');
            
            return redirect()->route('report_linen_kotor_harian', $data)->withInput();
        }
        return $service->generate(self::$model, $request, 'excel_report_invoice');
    }
}
