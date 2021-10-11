<?php

namespace Modules\Report\Dao\Repositories;

use Plugin\Notes;
use Plugin\Helper;
use App\Dao\Models\Branch;
use Illuminate\Support\Facades\DB;
use Modules\Report\Dao\Models\Brand;
use Modules\Report\Dao\Models\Color;
use Modules\Report\Dao\Models\Stock;
use Illuminate\Contracts\View\View;
use Modules\Sales\Dao\Models\Order;
use Modules\Report\Dao\Models\Product;
use Modules\Report\Dao\Models\Category;
use App\Dao\Interfaces\MasterInterface;
use Illuminate\Database\QueryException;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Modules\Sales\Dao\Models\OrderDetail;
use Maatwebsite\Excel\Concerns\WithMapping;
use Modules\Rajaongkir\Dao\Models\Delivery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Modules\Report\Dao\Repositories\StockRepository;
use Modules\Procurement\Dao\Models\PurchaseDetail;
use Modules\Sales\Dao\Repositories\OrderRepository;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Modules\Item\Dao\Repositories\LinenRepository;
use Modules\Linen\Dao\Repositories\DeliveryRepository;
use Modules\Procurement\Dao\Repositories\PurchaseRepository;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class ReportInvoiceRumahSakitRepository extends DeliveryRepository implements FromView, ShouldAutoSize, WithStyles, WithEvents
{
    public $model;
    public $detail;
    public $product;
    public $branch;
    public $key = [];

    public function __construct()
    {
        // $this->model = new OrderRepository();
        // $this->detail = new OrderDetail();
        // $this->product = new Product();
        // $this->category = new Category();
        // $this->branch = new Branch();
        // $this->delivery = new Delivery();
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
        $query = $this->dataRepository()->with('detail');
        
        // if ($company_id = request()->get('company_id')) {
        //     $query->where('linen_delivery_company_id', $company_id);
        // }

       
        
        // if ($from = request()->get('from')) {
        //     $query->whereDate('linen_delivery_reported_date', '>=', $from);
        // }
        // if ($to = request()->get('to')) {
        //     $query->whereDate('linen_delivery_reported_date','<=', $to);
        // }
        
        if ($key = request()->get('key')) {
            $query->where('linen_delivery_key', $key);
        }
        $query->whereNull('linen_delivery_deleted_at');

        $master = $query->first();
        // dd($detail);
        // $query = $query->orderBy($this->model->getKeyName(), 'ASC');
        return view('Report::page.invoice.excel_report_invoice', [
            'master' => $master,
            'detail' => $master->detail()->get()->groupBy('linen_grouping_detail_product_id')
        ]);
    }
}
