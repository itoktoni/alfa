<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Plugins\Helper;
use Wildside\Userstamps\Userstamps;

class OpnameSummary extends Model
{
    protected $table = 'linen_opname_summary';
    protected $primaryKey = 'linen_opname_summary_id';
    // protected $keyType = 'string';

    protected $fillable = [
        'linen_opname_summary_id',
        'linen_opname_summary_master_id',
        'linen_opname_summary_item_product_id',
        'linen_opname_summary_item_product_name',
        'linen_opname_summary_qty_stock',
        'linen_opname_summary_qty_opname',
        'linen_opname_summary_qty_realisasi',
        'linen_opname_summary_qty_target',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = false;
    public $rules = [
        'linen_opname_date' => 'required',
        'linen_opname_company_id' => 'required',
    ];

    const CREATED_AT = 'linen_opname_created_at';
    const UPDATED_AT = 'linen_opname_updated_at';
    const DELETED_AT = 'linen_opname_deleted_at';

    const CREATED_BY = 'linen_opname_created_by';
    const UPDATED_BY = 'linen_opname_updated_by';
    const DELETED_BY = 'linen_opname_deleted_by';

    protected $casts = [
        'linen_opname_created_at' => 'datetime:Y-m-d H:i:s',
        'linen_opname_updated_at' => 'datetime:Y-m-d H:i:s',
        'linen_opname_deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $dates = [
        'linen_opname_created_at',
        'linen_opname_updated_at',
        'linen_opname_deleted_at',
    ];

    public $searching = 'linen_opname_key';
    public $datatable = [
        'linen_opname_summary_id' => [false => 'Code', 'width' => 50],
        'linen_opname_summary_master_id' => [true => 'No. OpnameSummary'],
        'linen_opname_summary_item_product_id' => [false => 'Company'],
        'linen_opname_summary_item_product_name' => [true => 'Company'],
        'linen_opname_summary_qty_stock' => [false => 'Company'],
        'linen_opname_summary_qty_opname' => [true => 'Petugas'],
    ];

    public $status = [
        '1' => ['Register', 'primary'],
        '2' => ['OpnameSummary', 'warning'],
        '3' => ['Done', 'success'],
    ];

    public function status(){
        return $this->status;
    }   
}
