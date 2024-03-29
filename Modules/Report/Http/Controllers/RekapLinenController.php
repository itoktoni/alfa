<?php

namespace Modules\Report\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Item\Dao\Repositories\ProductRepository;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Enums\TransactionStatus;
use Modules\Report\Dao\Repositories\ReportBersihRepository;
use Modules\Report\Dao\Repositories\ReportKotorRepository;
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
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Str;
use Modules\Report\Dao\Repositories\ReportDetailRepository;

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
        $list_status = TransactionStatus::getOptions([
            TransactionStatus::Transaction,
            TransactionStatus::Pending,
            TransactionStatus::Hilang,
        ]);

        $list_user = Views::option(new TeamRepository());
        if (isset($data['list_status']) && !empty($data['list_status'])) {

            $list_status = TransactionStatus::getOptions([
                TransactionStatus::Transaction,
                TransactionStatus::Pending,
                TransactionStatus::Hilang,
            ]);
        }
        $list_description = LinenStatus::getOptions([
            LinenStatus::StatusLinen,
            LinenStatus::Register,
            LinenStatus::GantiChip,
            LinenStatus::Rental,
            LinenStatus::Cuci,
            LinenStatus::LinenKotor,
            LinenStatus::KelebihanStock,
            LinenStatus::ChipRusak,
            LinenStatus::LinenRusak,
            LinenStatus::Bernoda,
            LinenStatus::BahanUsang,
        ]);

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
        $list_status = TransactionStatus::getOptions([
            TransactionStatus::Transaction,
            TransactionStatus::Kotor,
            TransactionStatus::Retur,
            TransactionStatus::Rewash,
        ]);

        if ($name = request()->get('name')) {
            $preview = $repository->generate($name, $this->share())->data();
        }
        return view(Views::form(__FUNCTION__, config('page'), config('folder')))
            ->with($this->share([
                'model' => $repository,
                'preview' => $preview,
                'list_status' => $list_status,
                'include' => __FUNCTION__,
            ]));
    }

    public function pendingExport(PendingRequest $request, ReportService $service, ReportOutstandingRepository $repository)
    {
        return $service->generate([$repository, 'share' => $this->share()], Helper::snake(__FUNCTION__));
    }

    public function hilang(ReportOutstandingRepository $repository)
    {
        $preview = false;
        $list_status = TransactionStatus::getOptions([
            TransactionStatus::Transaction,
            TransactionStatus::Pending,
            TransactionStatus::Hilang,
        ]);

        if ($name = request()->get('name')) {
            $preview = $repository->generate($name, $this->share())->data();
        }
        return view(Views::form(__FUNCTION__, config('page'), config('folder')))
            ->with($this->share([

                'model' => $repository,
                'preview' => $preview,
                'list_status' => $list_status,
                'include' => __FUNCTION__,
            ]));
    }

    public function hilangExport(PendingRequest $request, ReportService $service, ReportOutstandingRepository $repository)
    {
        return $service->generate([$repository, 'share' => $this->share()], Helper::snake(__FUNCTION__));
    }

    public function kotor(ReportKotorRepository $repository)
    {
        $preview = $kotor = false;
        if ($name = request()->get('name')) {
            $kotor = $repository->data2();
            $preview = $repository->data();
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))
            ->with($this->share([
                'model' => $repository,
                'kotor' => $kotor,
                'preview' => $preview,
                'include' => __FUNCTION__,
            ]));
    }

    public function kotorExport(CompanyRequest $request, ReportService $service, ReportKotorRepository $repository)
    {
        $preview = $repository->data();

        $data['model'] = $repository;
        $data['kotor'] = $repository->data2();
        $data['preview'] = $preview;
        $data['include'] = __FUNCTION__;

        if (request()->get('action') == 'excel') {
            $filename =  'report_harian_kotor_' . date('Y_m_d') . '.xlsx';
            return Excel::download(new ReportKotorRepository(),  $filename);
        }

        if(request()->get('action') == 'pdf'){

            $data = array_merge($this->share(), $data);
            return view(Views::pdf(config('page'), config('folder'), 'kotor_export'), $data);

        }

        return $service->generate([$repository, 'share' => $this->share([
            'model' => $repository,
            'kotor' => $repository->data2(),
            'preview' => $preview,
            'include' => __FUNCTION__,
        ])], Helper::snake(__FUNCTION__));
    }

    public function bersih(ReportBersihRepository $repository)
    {
        $repository = new ReportBersihRepository();
        $preview = $kotor = false;
        if ($name = request()->get('name')) {
            $preview = $repository->data()->get();
            $kotor = $repository->data2();
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))
            ->with($this->share([
                'model' => $repository,
                'kotor' => $kotor,
                'preview' => $preview,
                'include' => __FUNCTION__,
            ]));
    }

    public function bersihExport(ReportService $service, ReportBersihRepository $repository)
    {
        $preview = $repository->data()->get();

        $data['model'] = $repository;
        $data['kotor'] = $repository->data2();
        $data['preview'] = $preview;
        $data['include'] = __FUNCTION__;


        if (request()->get('action') == 'excel') {
            $filename =  'report_harian_bersih_' . date('Y_m_d') . '.xlsx';
            return Excel::download(new ReportBersihRepository(),  $filename);
        }

        if(request()->get('action') == 'pdf'){

            $data = array_merge($data, $this->share());
            return view(Views::pdf(config('page'), config('folder'), 'bersih_export'), $data);

        }

        return $service->generate([$repository, 'share' => $this->share()], Helper::snake(__FUNCTION__));
    }

    public function detail(ReportDetailRepository $repository)
    {
        $repository = new ReportDetailRepository();
        $preview = $kotor = false;
        if ($name = request()->get('name')) {
            $preview = $repository->data()->get();
            $kotor = $repository->data2();
        }

        return view(Views::form(__FUNCTION__, config('page'), config('folder')))
            ->with($this->share([
                'model' => $repository,
                'kotor' => $kotor,
                'preview' => $preview,
                'include' => __FUNCTION__,
            ]));
    }

    public function detailExport(ReportService $service, ReportDetailRepository $repository)
    {
        $preview = $repository->data()->get();

        $data['model'] = $repository;
        $data['kotor'] = $repository->data2();
        $data['preview'] = $preview;
        $data['include'] = __FUNCTION__;

        if (request()->get('action') == 'excel') {
            $filename =  'report_harian_detail_' . date('Y_m_d') . '.xlsx';
            return Excel::download(new ReportDetailRepository(),  $filename);
        }

        if(request()->get('action') == 'pdf'){

            $data = array_merge($data, $this->share());
            return view(Views::pdf(config('page'), config('folder'), 'detail_export'), $data);

        }

        return $service->generate([$repository, 'share' => $this->share()], Helper::snake(__FUNCTION__));
    }
}
