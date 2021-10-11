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

class Opname extends Model
{
    use SoftDeletes, Userstamps;

    protected $table = 'linen_opname';
    protected $primaryKey = 'linen_opname_key';
    protected $keyType = 'string';

    protected $fillable = [
        'linen_opname_id',
        'linen_opname_created_at',
        'linen_opname_updated_at',
        'linen_opname_deleted_at',
        'linen_opname_updated_by',
        'linen_opname_created_by',
        'linen_opname_deleted_by',
        'linen_opname_key',
        'linen_opname_status',
        'linen_opname_company_id',
        'linen_opname_company_name',
        'linen_opname_date',
        'linen_opname_petugas_id',
        'linen_opname_petugas_name',
        'linen_opname_item_product_id',
        'linen_opname_item_product_name',
    ];

    // public $with = ['module'];

    public $timestamps = true;
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
        'linen_opname_status' => 'string',
    ];

    protected $dates = [
        'linen_opname_created_at',
        'linen_opname_updated_at',
        'linen_opname_deleted_at',
    ];

    public $searching = 'linen_opname_key';
    public $datatable = [
        'linen_opname_id' => [false => 'Code', 'width' => 50],
        'linen_opname_key' => [true => 'No. Opname'],
        'linen_opname_company_id' => [false => 'Company'],
        'linen_opname_company_name' => [true => 'Company'],
        'linen_opname_petugas_id' => [false => 'Company'],
        'linen_opname_petugas_name' => [true => 'Petugas'],
        'linen_opname_item_product_id' => [false => 'Product'],
        'linen_opname_item_product_name' => [false => 'Product'],
        'linen_opname_created_by' => [false => 'Created At'],
        'linen_opname_date' => [true => 'Tanggal Opname'],
        'linen_opname_created_at' => [true => 'Created At'],
        'linen_opname_status' => [true => 'Status', 'width' => 80, 'class' => 'text-center'],
    ];

    public $status = [
        '1' => ['Register', 'primary'],
        '2' => ['Opname', 'warning'],
        '3' => ['Done', 'success'],
    ];

    public function status(){
        return $this->status;
    }

    public function user(){

		return $this->hasOne(User::class, TeamFacades::getKeyName(), self::CREATED_BY);
    }

    public function summary(){

		return $this->hasMany(OpnameSummary::class, 'linen_opname_summary_master_id', 'linen_opname_key');
    }

    public function detail(){

		return $this->hasMany(OpnameDetail::class, 'linen_opname_detail_key', 'linen_opname_key');
    }
    
    public static function boot()
    {
        parent::boot();

        parent::saving(function($model){

            $company = $model->linen_opname_company_id;
            $model->linen_opname_company_name = CompanyFacades::find($company)->company_name ?? '';
            
            if($model->linen_opname_item_product_id){
                
                $model->linen_opname_item_product_name = ProductFacades::find($model->linen_opname_item_product_id)->item_product_name ?? '';
            }

            if($model->linen_opname_petugas_id){
                
                $model->linen_opname_petugas_name = TeamFacades::find($model->linen_opname_petugas_id)->name ?? '';
            }

        });

        parent::creating(function($model){

            $model->linen_opname_status = 1;
            $model->linen_opname_key = Helper::autoNumber($model->getTable(), $model->getKeyName(),'OPN', env('WEBSITE_AUTONUMBER', 10));
        });
    }    
}
