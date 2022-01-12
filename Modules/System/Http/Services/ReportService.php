<?php

namespace Modules\System\Http\Services;

use Maatwebsite\Excel\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Modules\System\Plugins\Views;

class ReportService
{
    public $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function generate($repository, $data, $name)
    {
        if(isset($data['action']) && $data['action'] == 'excel'){
            
            $name = $name .'_'. date('Y_m_d') . '.xlsx';
            return $this->excel->download($repository, $name);
        }
        else if($data->action == 'excel'){
            
            $name = $name .'_'. date('Y_m_d') . '.xlsx';
            return $this->excel->download($repository, $name);
        }
        else if($data->action == 'pdf'){
            $pdf = PDF::loadView(Views::pdf(config('page'), config('folder'), $name), $repository)->setPaper('A4', 'potrait');
            return $pdf->download(); // return $pdf->stream();
        }
    } 
}
