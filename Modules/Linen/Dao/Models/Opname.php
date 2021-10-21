<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Linen\Dao\Facades\OpnameDetailFacades;
use Modules\Linen\Dao\Facades\OpnameFacades;
use Modules\Linen\Dao\Facades\OpnameSummaryFacades;
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
        'linen_opname_location_id',
        'linen_opname_location_name',
        'linen_opname_total',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'linen_opname_key' => 'required',
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
        'linen_opname_key' => [true => 'No. Opname'],
        'linen_opname_company_id' => [false => 'Company'],
        'linen_opname_company_name' => [true => 'Company'],
        'linen_opname_location_id' => [false => 'Location'],
        'linen_opname_location_name' => [true => 'Location'],
        'linen_opname_created_by' => [false => 'Created At'],
        'linen_opname_created_at' => [true => 'Created At'],
        // 'linen_opname_status' => [true => 'Status', 'width' => 80, 'class' => 'text-center'],
    ];

    public function mask_company_id()
    {
        return 'linen_opname_company_id';
    }

    public function setMaskCompanyIdAttribute($value)
    {
        $this->attributes[$this->mask_company_id()] = $value;
    }

    public function getMaskCompanyIdAttribute()
    {
        return $this->{$this->mask_company_id()};
    }

    public function getMaskCompanyNameAttribute()
    {
        return $this->linen_opname_company_name;
    }

    public function mask_location_id()
    {
        return 'linen_opname_location_id';
    }

    public function setMaskLocationIdAttribute($value)
    {
        $this->attributes[$this->mask_location_id()] = $value;
    }

    public function getMaskLocationIdAttribute()
    {
        return $this->{$this->mask_location_id()};
    }

    public function getMaskLocationNameAttribute()
    {
        return $this->linen_opname_location_name;
    }

    public function mask_created_by()
    {
        return self::CREATED_BY;
    }

    public function setMaskCreatedByAttribute($value)
    {
        $this->attributes[$this->mask_created_by()] = $value;
    }

    public function getMaskCreatedByAttribute()
    {
        return $this->{$this->mask_created_by()};
    }

    public function getMaskCreatedNameAttribute()
    {
        return $this->linen_opname_location_name;
    }

    public function mask_total()
    {
        return 'linen_opname_total';
    }

    public function setMaskTotalAttribute($value)
    {
        $this->attributes[$this->mask_total()] = $value;
    }

    public function getMaskTotalAttribute()
    {
        return $this->{$this->mask_total()};
    }


    public function has_user(){

		return $this->hasOne(User::class, TeamFacades::getKeyName(), self::CREATED_BY);
    }

    public function has_summary(){

		return $this->hasMany(OpnameSummary::class, OpnameSummaryFacades::getKeyName(), $this->getKeyName());
    }

    public function has_detail(){

		return $this->hasMany(OpnameDetail::class, OpnameDetailFacades::mask_key(), OpnameFacades::getKeyName());
    }
    
    public static function boot()
    {
        parent::boot();

        parent::saving(function($model){

            $company = $model->linen_opname_company_id;
            $model->linen_opname_company_name = CompanyFacades::find($model->mask_company_id)->company_name ?? '';
            $model->linen_opname_location_name = LocationFacades::find($model->mask_location_id)->location_name ?? '';

        });
    }    
}