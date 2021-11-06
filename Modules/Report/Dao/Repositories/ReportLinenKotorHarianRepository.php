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
use Maatwebsite\Excel\Concerns\WithDrawings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Modules\Item\Dao\Repositories\LinenRepository;
use Modules\Linen\Dao\Repositories\DeliveryRepository;
use Modules\Procurement\Dao\Repositories\PurchaseRepository;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Modules\Linen\Dao\Models\KotorDetail;
use Modules\Linen\Dao\Repositories\KotorRepository;
use Modules\System\Dao\Facades\CompanyConnectionLocationFacades;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Plugins\Helper;

class ReportLinenKotorHarianRepository extends KotorRepository implements FromView, WithStyles, WithEvents
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
        $location = $this->company->has_location ?? [];
        $product = $this->company->has_product ?? [];

        $this->location = $location;
        $this->product = $product;
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1')->getFont()->setBold(true);
    }

    public function registerEvents(): array
    {
        $total_location = count($this->location) + 4;
        $total_product = count($this->product) + 10;
        $alfa = Helper::getAlfabetByNumber($total_location);
        $cell = $alfa . $total_location;

        return [
            AfterSheet::class    => function (AfterSheet $event) use ($alfa, $total_product) {
                $event->sheet->getDelegate()->mergeCells('A1:' . $alfa . '1');
                $event->sheet->getDelegate()->mergeCells('A2:' . $alfa . '2');
                $event->sheet->getDelegate()->mergeCells('A3:' . $alfa . '3');

                $event->sheet->getDelegate()->getStyle('A1:' . $alfa . '3')->getAlignment()->applyFromArray([
                    'horizontal' => 'center'
                ]);

                $event->sheet->getDelegate()->getColumnDimension('A')->setWidth(5);
                $event->sheet->getDelegate()->getColumnDimension('B')->setAutoSize(true);
                foreach (range('C', $alfa) as $columnID) {
                    $event->sheet->getDelegate()->getColumnDimension($columnID)->setWidth(5);
                }

                $event->sheet->getDelegate()->getStyle('C8:' . $alfa . '8')->getAlignment()->setTextRotation(90);
            },
        ];
    }

    public function view(): View
    {
        $query = KotorDetail::query();

        if ($company_id = request()->get('company_id')) {
            $query->where('linen_kotor_detail_scan_company_id', $company_id);
        }

        if ($key = request()->get('key')) {
            $query->where('linen_kotor_detail_key', $key);
        }

        if ($from = request()->get('from')) {
            $query->whereDate('linen_kotor_detail_created_at', '>=', $from);
        }
        if ($to = request()->get('to')) {
            $query->whereDate('linen_kotor_detail_created_at', '<=', $to);
        }


        $detail = [];
        if ($query->count() > 0) {

            $detail = $query->get();
        }

        $master = $query->first();

        $date_from = Carbon::createFromFormat('Y-m-d', request()->get('from'));
        $date_to = Carbon::createFromFormat('Y-m-d', request()->get('to'));

        return view('Report::page.linen_kotor.excel_linen_kotor_harian', [
            'master' => $master,
            'location' => $this->location,
            'product' => $this->product,
            'detail' => $detail,
            'date_from' => $date_from,
            'date_to' => $date_to,
        ]);
    }
}
