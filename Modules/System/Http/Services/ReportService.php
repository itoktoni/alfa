<?php

namespace Modules\System\Http\Services;

use Maatwebsite\Excel\Excel;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Route;
use Maatwebsite\Excel\Facades\Excel as FacadesExcel;
use Modules\System\Plugins\Views;

class ReportService
{
    public $excel;

    public function __construct(Excel $excel)
    {
        $this->excel = $excel;
    }

    public function generate($repository, $name)
    {
        if (request()->get('action') == 'excel') {
            $filename = $name . '_' . date('Y_m_d') . '.xlsx';
            $data = $repository[0]->generate($name, $repository);
            return $this->excel->download($data, $filename);
        }
        if (request()->get('action') == 'preview') {

            $data = request()->except([
                '_token',
                'action'
            ]);
            $data['name'] = $name;

            return redirect()->route(str_replace('_export', '', Route::getCurrentRoute()->getName()), $data);
        } else if (request()->get('action') == 'pdf') {
            $layout = request()->get('layout') ?? 'potrait';
            $data = $repository['share'];
            $data['preview'] = $repository[0]->data();
            $pdf = PDF::loadView(Views::pdf(config('page'), config('folder'), $name), $data)
                ->setPaper('A4', $layout);
            return $pdf->stream(); // return $pdf->stream();
        }
    }
}
