<?php

namespace Modules\Linen\Dao\Repositories;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Modules\Linen\Dao\Repositories\OpnameRepository;
use Modules\System\Plugins\Views;

class ReportOpnameRepository extends OpnameRepository implements FromView, ShouldAutoSize, WithColumnWidths, WithStyles, WithEvents
{
    public $name;
    public $share;

    public function generate($name, $share)
    {
        $this->name = $name;
        $this->share = $share;
        return $this;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A1:G2'; // All headers
                // $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->applyFromArray([
                //     'horizontal' => 'center'
                // ]);
            },
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 5,
            'B' => 50,            
        ];
    }

    public function data()
    {
        $query = $this->dataRepository()->filter();

        return $query->get();
    }

    public function view(): View
    {
        $send = $this->share['share'];
        $send['preview'] = $this->data();
        return view('Linen::page.' . config('page') . '.' . $this->name, $send);
    }
}
