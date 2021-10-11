<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Wildside\Userstamps\Userstamps;

class Retur extends Model
{
    use SoftDeletes, Userstamps;

    protected $table = 'linen_retur';
    protected $primaryKey = 'linen_retur_key';
    protected $keyType = 'string';

    protected $fillable = [
        'linen_retur_id',
        'linen_retur_total',
        'linen_retur_status',
        'linen_retur_created_at',
        'linen_retur_updated_at',
        'linen_retur_deleted_at',
        'linen_retur_updated_by',
        'linen_retur_created_by',
        'linen_retur_deleted_by',
        'linen_retur_key',
        'linen_retur_company_id',
        'linen_retur_company_name',
        'linen_retur_location_id',
        'linen_retur_location_name',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'linen_retur_key' => 'required|unique:linen_retur',
        'linen_retur_company_id' => 'required|unique:system_company',
        'linen_retur_status' => 'required|in:1,2,3',
        'rfid' => 'required',
    ];

    const CREATED_AT = 'linen_retur_created_at';
    const UPDATED_AT = 'linen_retur_updated_at';
    const DELETED_AT = 'linen_retur_deleted_at';

    const CREATED_BY = 'linen_retur_created_by';
    const UPDATED_BY = 'linen_retur_updated_by';
    const DELETED_BY = 'linen_retur_deleted_by';

    protected $casts = [
        'linen_retur_created_at' => 'datetime:Y-m-d H:i:s',
        'linen_retur_updated_at' => 'datetime:Y-m-d H:i:s',
        'linen_retur_deleted_at' => 'datetime:Y-m-d H:i:s',
        'linen_retur_status' => 'string',
        'linen_retur_total' => 'integer',
    ];

    protected $dates = [
        'linen_retur_created_at',
        'linen_retur_updated_at',
        'linen_retur_deleted_at',
    ];

    public $searching = 'linen_retur_key';
    public $datatable = [
        'linen_retur_id' => [false => 'Code', 'width' => 50],
        'linen_retur_key' => [true => 'No. Retur'],
        'linen_retur_company_name' => [true => 'Company'],
        'linen_retur_location_name' => [true => 'Location'],
        'linen_retur_total' => [true => 'Total'],
        'linen_retur_created_by' => [false => 'Created At'],
        'linen_retur_created_at' => [true => 'Created At'],
        'name' => [true => 'Created By'],
        'linen_retur_status' => [true => 'Status', 'width' => 90, 'class' => 'text-center'],
    ];

    public $status = [
        '4' => ['Chip rusak', 'success'],
        '5' => ['Linen rusak', 'primary'],
        '6' => ['Kelebihan stock', 'danger'],
    ];

    public function status(){
        return $this->status;
    }

    public function user(){

		return $this->hasOne(User::class, TeamFacades::getKeyName(), self::CREATED_BY);
    }

    public function detail(){

		return $this->hasMany(ReturDetail::class, 'linen_retur_detail_key', 'linen_retur_key');
    }
    
    public static function boot()
    {
        parent::boot();

        parent::saving(function($model){

            $company = $model->linen_retur_company_id;
            $model->linen_retur_company_name = CompanyFacades::find($company)->company_name ?? '';
            
        });
    }    
}
