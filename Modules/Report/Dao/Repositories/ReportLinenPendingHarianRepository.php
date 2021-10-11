<?php

namespace Modules\Report\Dao\Repositories;

use Plugin\Notes;
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
use Carbon\Carbon;
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
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\Linen\Dao\Repositories\KotorRepository;
use Modules\Linen\Dao\Repositories\OutstandingRepository;
use Modules\System\Dao\Facades\CompanyConnectionLocationFacades;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Plugins\Helper;
use Modules\System\Plugins\Views;

class ReportLinenPendingHarianRepository extends OutstandingRepository implements FromView, WithStyles, WithEvents
{
    public $model;
    public $detail;
    public $company;
    public $location;
    public $product;

    public function __construct()
    {
        // $this->model = new OrderRepository();
        // $this->detail = new OrderDetail();
        // $this->product = new Product();
        // $this->category = new Category();
        // $this->branch = new Branch();
        // $this->delivery = new Delivery();

        $this->company = CompanyFacades::find(request()->get('company_id'));
        $location = $this->company->locations ?? [];
        $product = $this->company->products ?? [];

        $this->location = $location;
        $this->product = $product;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true);
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 100,            
        ];
    }

    public function registerEvents(): array
    {
        // return [];
        // $total_location = count($this->location)+4;
        // $total_product = count($this->product)+10;
        $alfa = Helper::getAlfabetByNumber(5);
        // $cell = $alfa.$total_location;

        return [
            AfterSheet::class    => function(AfterSheet $event) use($alfa){
                $event->sheet->getDelegate()->mergeCells('A1:'.$alfa.'1');

                $event->sheet->getDelegate()->getStyle('A1:'.$alfa.'1')->getAlignment()->applyFromArray([
                    'horizontal' => 'center'
                ]);
                    
                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('B')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('C')->setWidth(20);
                $event->sheet->getDelegate()->getColumnDimension('D')->setWidth(30);
                $event->sheet->getDelegate()->getColumnDimension('E')->setWidth(10);
                // foreach(range('B', $alfa) as $columnID)
                // {
                //     // $event->sheet->getDelegate()->getColumnDimension($columnID)->setWidth(5);
                // }
                
                // $event->sheet->getDelegate()->getStyle('C8:'.$alfa.'8')->getAlignment()->setTextRotation(90);
            },
        ];
    }

    public function view(): View
    {
        $query = $this->dataRepository();
        
        if ($linen_outstanding_ori_company_id = request()->get('linen_outstanding_ori_company_id')) {
            $query->where('linen_outstanding_ori_company_id', $linen_outstanding_ori_company_id);
        }

        if ($linen_outstanding_scan_company_id = request()->get('linen_outstanding_scan_company_id')) {
            $query->where('linen_outstanding_scan_company_id', $linen_outstanding_scan_company_id);
        } 

        if ($linen_outstanding_ori_location_id = request()->get('linen_outstanding_ori_location_id')) {
            $query->where('linen_outstanding_ori_location_id', $linen_outstanding_ori_location_id);
        }  

        if ($linen_outstanding_product_id = request()->get('linen_outstanding_product_id')) {
            $query->where('linen_outstanding_product_id', $linen_outstanding_product_id);
        } 

        if ($report_linen_status = request()->get('report_linen_status')) {
            $query->where('report_linen_status', $report_linen_status);
        } 

        if ($linen_outstanding_description = request()->get('linen_outstanding_description')) {
            $query->where('linen_outstanding_description', $linen_outstanding_description);
        } 
        
        if ($key = request()->get('key')) {
            $query->where('linen_oustanding_key', $key);
        }
        
        // if ($from = request()->get('from')) {
        //     $query->whereDate('linen_oustanding_created_at', '>=', $from);
        // }
        // if ($to = request()->get('to')) {
        //     $query->whereDate('linen_oustanding_created_at','<=', $to);
        // }
        
        // $query->whereNull('linen_oustanding_deleted_at');

        $master = $query->get();

        $date_from = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        $date_to = Carbon::createFromFormat('Y-m-d', date('Y-m-d'));
        
        return view('Report::page.linen_pending.excel_linen_pending_harian', [
            'master' => $master,
            'status' => Views::status(OutstandingFacades::status())->toArray(),
            'date_from' => $date_from,
            'date_to' => $date_to,
        ]);
    }
}
