<?php

namespace Modules\Report\Dao\Repositories;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Carbon;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Modules\Linen\Dao\Facades\DeliveryFacades;
use Modules\Linen\Dao\Facades\KotorFacades;
use Modules\Linen\Dao\Models\GroupingDetail;
use Modules\Linen\Dao\Models\KotorDetail;
use Modules\Linen\Dao\Repositories\DeliveryRepository;
use Modules\Report\Dao\Interfaces\GenerateReport;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ReportInvoiceRepository extends GroupingDetail implements FromView, WithColumnFormatting, WithColumnWidths, GenerateReport
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
        $query = $this->with(['has_delivery' => function($query){

            if ($from = request()->get('from')) {
                $query->whereDate('linen_delivery_created_at', '>=', $from);
            }
    
            if ($to = request()->get('to')) {
                $query->whereDate('linen_delivery_created_at', '<=', $to);
            }
    
            if ($company = request()->get('view_company_id')) {
                $query->where('linen_delivery_company_id', $company);
            }

            return $query;

        }]);

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
