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
use Modules\Item\Dao\Repositories\LinenRepository;
use Modules\Procurement\Dao\Repositories\PurchaseRepository;

class ReportLinenSummaryRepository extends LinenRepository implements FromView, WithColumnFormatting
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

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
            'C' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 30,
            'B' => 100,            
            'C' => 100,            
            'D' => 30,            
            'E' => 30,            
        ];
    }

    public function view(): View
    {
        // $query = $this->model
        // ->leftJoin($this->branch->getTable(), 'sales_order_from_id', $this->branch->getKeyName())
        // ->leftJoin($this->detail->getTable(), $this->model->getKeyName(), 'sales_order_detail_order_id')
        // ->leftJoin($this->product->getTable(), 'sales_order_detail_report_product_id', $this->product->getKeyName())
        // ->leftJoin($this->category->getTable(), 'report_product_report_category_id', $this->category->getKeyName())
        //     ->select([
        //         'sales_order_id',
        //         'sales_order_created_at',
        //         'sales_order_created_by',
        //         'sales_order_updated_at',
        //         'sales_order_updated_by',
        //         'sales_order_deleted_at',
        //         'sales_order_deleted_by',
        //         'sales_order_date_order',
        //         'sales_order_from_id',
        //         'sales_order_from_name',
        //         'sales_order_from_phone',
        //         'sales_order_from_email',
        //         'sales_order_from_address',
        //         'sales_order_from_area',
        //         'sales_order_to_id',
        //         'sales_order_to_name',
        //         'sales_order_to_phone',
        //         'sales_order_to_email',
        //         'sales_order_to_address',
        //         'sales_order_to_area',
        //         'sales_order_status',
        //         'sales_order_discount_name',
        //         'sales_order_discount_value',
        //         'sales_order_sum_product',
        //         'sales_order_sum_discount',
        //         'sales_order_sum_ongkir',
        //         'sales_order_sum_total',
        //         'sales_order_sum_bayar',
        //         'sales_order_sum_kembalian',
        //         'sales_order_payment_date',
        //         'sales_order_payment_bank_from',
        //         'sales_order_payment_bank_to_id',
        //         'sales_order_payment_person',
        //         'sales_order_payment_phone',
        //         'sales_order_payment_email',
        //         'sales_order_payment_file',
        //         'sales_order_payment_value',
        //         'sales_order_payment_notes',
        //         'sales_order_core_user_id',
        //         'branch_name',
        //         'report_category_name',
        //         'report_product.*',
        //         'sales_order_detail.*',
        //     ]);

        $query = $this->dataRepository();
        
        if ($item_linen_company_id = request()->get('item_linen_company_id')) {
            $query->where('item_linen_company_id', $item_linen_company_id);
        }
        if ($item_linen_location_id = request()->get('item_linen_location_id')) {
            $query->where('item_linen_location_id', $item_linen_location_id);
        }
        if ($item_linen_product_id = request()->get('item_linen_product_id')) {
            $query->where('item_linen_product_id', $item_linen_product_id);
        }
        if ($item_linen_created_by = request()->get('item_linen_created_by')) {
            $query->where('item_linen_created_by', $item_linen_created_by);
        }
        if ($item_linen_updated_by = request()->get('item_linen_updated_by')) {
            $query->where('item_linen_updated_by', $item_linen_updated_by);
        }
        if ($item_linen_rent = request()->get('item_linen_rent')) {
            $query->where('item_linen_rent', $item_linen_rent);
        }
        if ($item_linen_status = request()->get('item_linen_status')) {
            $query->where('item_linen_status', $item_linen_status);
        }
        if ($from = request()->get('from')) {
            $query->whereDate('item_linen_created_at', '>=', $from);
        }
        if ($to = request()->get('to')) {
            $query->whereDate('item_linen_created_at','<=', $to);
        }
        
        $query->whereNull('item_linen_deleted_at')
        ->addSelect(DB::raw('count(item_linen_id) as qty'))
        ->groupBy('item_linen_company_id', 'item_linen_product_id');

        
        // if(auth()->user()->company){
            
        //     $list_branch = Branch::where('branch_company_id', auth()->user()->company)->get()->pluck('branch_id');
        //     $query->whereIn('sales_order_from_id', $list_branch);
        // }
        // else if(auth()->user()->branch){
            
        //     $query->where('sales_order_from_id', auth()->user()->branch);
        // }

        // $query = $query->orderBy($this->model->getKeyName(), 'ASC');
        return view('Report::page.register_linen.excel_report_summary', [
            'preview' => $query->get()
        ]);
    }
}
