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
use Modules\Procurement\Dao\Models\PurchaseDetail;
use Modules\Sales\Dao\Repositories\OrderRepository;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Modules\Item\Dao\Repositories\LinenRepository;
use Modules\Linen\Dao\Repositories\DeliveryRepository;
use Modules\Procurement\Dao\Repositories\PurchaseRepository;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Modules\Linen\Dao\Repositories\StockRepository;

class ReportStockRepository extends StockRepository implements FromView, WithColumnWidths
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

    public function columnWidths(): array
    {
        return [
            'A' => 50,
            'B' => 50,            
            'C' => 50,            
            'D' => 30,            
            'E' => 30,            
            'F' => 30,            
            'G' => 30,            
            'H' => 30,            
            'I' => 30,            
            'J' => 30,            
            'K' => 30,            
        ];
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
        $query = $this->dataRepository();
        
        if ($view_company_id = request()->get('view_company_id')) {
            $query->where('view_company_id', $view_company_id);
        }
        if ($view_location_id = request()->get('view_location_id')) {
            $query->where('view_location_id', $view_location_id);
        }
        if ($view_product_id = request()->get('view_product_id')) {
            $query->where('view_product_id', $view_product_id);
        }

        return view('Report::page.stock.excel_report_summary', [
            'preview' => $query->get(),
        ]);
    }
}
