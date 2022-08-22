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
            $query = $query->whereDate('linen_kotor_detail_created_at', '>=', $from);
        }

        if ($to = request()->get('to')) {
            $query = $query->whereDate('linen_kotor_detail_created_at', '<=', $to);
        }

        if ($company = request()->get('view_company_id')) {
            $query = $query->where('linen_kotor_detail_scan_company_id', $company);
        }

        return $query->get();
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
        $send = $this->share['share'];
        $send['preview'] = $this->data();
        return view('Report::page.' . config('page') . '.' . $this->name, $send);
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
        ];
    }
}
