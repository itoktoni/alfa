<?php

namespace Modules\Report\Dao\Repositories;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Modules\Linen\Dao\Facades\DeliveryFacades;
use Modules\Linen\Dao\Facades\GroupingDetailFacades;
use Modules\Linen\Dao\Models\KotorDetail;
use Modules\Report\Dao\Interfaces\GenerateReport;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Plugins\Views;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ReportKotorRepository extends KotorDetail implements FromView, WithColumnFormatting, WithColumnWidths, GenerateReport
{
    public $name;
    public $share;

    public function generate($name, $share)
    {
        $this->name = $name;
        $this->share = $share;
        return $this;
    }

    public function data()
    {
        $query = KotorDetail::query();

        if ($from = request()->get('from')) {
            $query->whereDate('linen_kotor_detail_created_at', ">=", $from);
        }

        if ($to = request()->get('to')) {
            $query->whereDate('linen_kotor_detail_created_at', '<=', $to);
        }

        if ($company = request()->get('view_company_id')) {
            $query->where('linen_kotor_detail_ori_company_id', $company);
        }

        return $query->orderBy('linen_kotor_detail_product_id', 'DESC')->get();
    }

    public function data2()
    {
        $query = GroupingDetailFacades::query();

        if ($company_id = request()->get('view_company_id')) {
            $query = $query->where('linen_grouping_detail_ori_company_id', $company_id);
        }

        if ($from = request()->get('from')) {
            $kotor_from = Carbon::createFromFormat('Y-m-d', request()->get('from')) ?? null;
            $query = $query->whereDate('linen_grouping_detail_reported_date', '>=', $kotor_from->addDay(1)->format('Y-m-d'));
        }

        if ($to = request()->get('to')) {
            $kotor_to = Carbon::createFromFormat('Y-m-d', request()->get('to')) ?? null;
            $query = $query->whereDate('linen_grouping_detail_reported_date', '<=', $kotor_to->addDay(1)->format('Y-m-d'));
        }

        return $query->get();
    }

    public function view(): View
    {
        $company = CompanyFacades::find(request()->get('view_company_id'));
        $location = $company->has_location ?? [];
        $product = $company->has_product ?? [];
        $list_company = Views::option(new CompanyRepository());
        $send['list_company'] = $list_company;

        $send['product'] = $product;
        $send['location'] = $location;
        $send['kotor'] = $this->data2();
        $send['preview'] = $this->data();
        return view('Report::page.' . config('page') . '.kotor_export', $send);
    }

    public function columnFormats(): array
    {
        return [
            'E' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 30,
            'C' => 30,
            'D' => 15,
            'E' => 15,
            'F' => 15,
            'G' => 15,
            'H' => 15,
            'I' => 15,
            'J' => 15,
            'K' => 15,
            'L' => 15,
            'M' => 15,
            'N' => 15,
            'O' => 15,
            'P' => 15,
            'Q' => 15,
            'R' => 15,
            'S' => 15,
            'T' => 15,
            'U' => 15,
            'V' => 15,
            'W' => 15,
            'X' => 15,
            'Y' => 15,
            'Z' => 15,
            'AA' => 15,
            'AB' => 15,
            'AC' => 15,
            'AD' => 15,
            'AE' => 15,
            'AF' => 15,
            'AG' => 15,
            'AI' => 15,
        ];
    }
}
