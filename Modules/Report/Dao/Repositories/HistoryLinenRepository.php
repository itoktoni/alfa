<?php

namespace Modules\Report\Dao\Repositories;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Modules\Report\Dao\Interfaces\GenerateReport;
use Modules\Report\Dao\Models\HistoryLinen;
use Modules\System\Dao\Repositories\CompanyRepository;
use Modules\System\Plugins\Views;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class HistoryLinenRepository extends HistoryLinen implements FromView, WithColumnFormatting, WithColumnWidths, GenerateReport
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
        $query = $this->filter();

        if ($from = request()->get('from')) {
            $query->whereDate('item_linen_detail_created_at', '>=', $from);
        }

        if ($to = request()->get('to')) {
            $query->whereDate('item_linen_detail_created_at', '<=', $to);
        }
        return $query->orderBy('item_linen_detail_created_at', 'desc')->get();
    }

    public function view(): View
    {
        $send = $this->share['share'];
        $send['preview'] = $this->data();
        $list_company = Views::option(new CompanyRepository());
        $send['list_company'] = $list_company;
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
