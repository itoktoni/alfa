<?php

namespace Modules\Linen\Dao\Repositories;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Modules\Linen\Dao\Repositories\OpnameRepository;
use Modules\System\Plugins\Views;

class ReportOpnameRepository extends OpnameRepository implements FromView, ShouldAutoSize, WithStyles, WithEvents
{
    public $request;
    public $name;

    public function __construct($request, $name)
    {
        $this->name = $name;
        $this->request = $request;
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
                $event->sheet->getDelegate()->getStyle($cellRange)->getAlignment()->applyFromArray([
                    'horizontal' => 'center'
                ]);
            },
        ];
    }

    public function view(): View
    {
        return view(Views::form($this->name, config('page'), config('folder')))->with($this->request);
    }
}
