<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Wildside\Userstamps\Userstamps;

class OpnameDetail extends Model
{
    protected $table = 'linen_opname_detail';
    protected $primaryKey = 'linen_opname_detail_id';

    protected $fillable = [
        'linen_opname_detail_id',
        'linen_opname_detail_rfid',
        'linen_opname_detail_key',
        'linen_opname_detail_product_id',
        'linen_opname_detail_product_name',
        'linen_opname_detail_company_id',
        'linen_opname_detail_company_name',
        'linen_opname_detail_location_id',
        'linen_opname_detail_location_name',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'linen_opname_detail_rfid' => 'required|unique:linen_outstanding,linen_outstanding_rfid',
    ];

    const CREATED_AT = 'linen_opname_detail_created_at';
    const UPDATED_AT = 'linen_opname_detail_updated_at';
    const DELETED_AT = 'linen_opname_detail_deleted_at';

    const CREATED_BY = 'linen_opname_detail_created_by';
    const UPDATED_BY = 'linen_opname_detail_updated_by';
    const DELETED_BY = 'linen_opname_detail_deleted_by';

    protected $casts = [
        'linen_opname_detail_created_at' => 'datetime:Y-m-d H:i:s',
        'linen_opname_detail_updated_at' => 'datetime:Y-m-d H:i:s',
        'linen_opname_detail_deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $dates = [
        'linen_opname_detail_created_at',
        'linen_opname_detail_updated_at',
        'linen_opname_detail_deleted_at',
    ];

    public $searching = 'linen_opname_detail_key';
    public $datatable = [
        'linen_opname_detail_id' => [false => 'Code', 'width' => 50],
        'linen_opname_detail_company_name' => [true => 'Company'],
        'linen_opname_detail_location_name' => [true => 'Location'],
    ];

    public $status = [
        '1' => ['Initial', 'success'],
        '2' => ['Completed', 'primary'],
    ];

    public function status(){
        return $this->status;
    }

    public function user(){

		return $this->hasOne(User::class, TeamFacades::getKeyName(), self::CREATED_BY);
    }
    
    public static function boot()
    {
        parent::boot();

        parent::saving(function($model){

            $company = $model->linen_opname_detail_company_id;
            $model->linen_opname_detail_company_name = CompanyFacades::find($company)->company_name ?? '';

            $location = $model->linen_opname_detail_location_id;
            $model->linen_opname_detail_location_name = LocationFacades::find($location)->location_name ?? '';

        });

        parent::deleted(function($model){

            $detail = GroupingDetail::where('linen_opname_detail_barcode', $model->linen_opname_detail_barcode)->count();
            Grouping::where('linen_opname_barcode', $model->linen_opname_detail_barcode)->update([
                'linen_opname_total' => $detail
            ]);
        });
    }    
}
