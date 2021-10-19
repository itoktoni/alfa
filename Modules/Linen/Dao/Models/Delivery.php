<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Linen\Events\CreateDeliveryEvent;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Wildside\Userstamps\Userstamps;

class Delivery extends Model
{
    use SoftDeletes, Userstamps;

    protected $table = 'linen_delivery';
    protected $primaryKey = 'linen_delivery_key';
    protected $keyType = 'string';

    protected $fillable = [
        'linen_delivery_id',
        'linen_delivery_status',
        'linen_delivery_total',
        'linen_delivery_total_detail',
        'linen_delivery_created_at',
        'linen_delivery_updated_at',
        'linen_delivery_deleted_at',
        'linen_delivery_updated_by',
        'linen_delivery_created_by',
        'linen_delivery_deleted_by',
        'linen_delivery_reported_date',
        'linen_delivery_key',
        'linen_delivery_company_id',
        'linen_delivery_company_name',
        'linen_delivery_driver_id',
        'linen_delivery_driver_name',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'linen_delivery_driver_id' => 'required',
    ];

    const CREATED_AT = 'linen_delivery_created_at';
    const UPDATED_AT = 'linen_delivery_updated_at';
    const DELETED_AT = 'linen_delivery_deleted_at';

    const CREATED_BY = 'linen_delivery_created_by';
    const UPDATED_BY = 'linen_delivery_updated_by';
    const DELETED_BY = 'linen_delivery_deleted_by';

    protected $casts = [
        'linen_delivery_created_at' => 'datetime:Y-m-d',
        'linen_delivery_updated_at' => 'datetime:Y-m-d H:i:s',
        'linen_delivery_deleted_at' => 'datetime:Y-m-d H:i:s',
        'linen_delivery_status' => 'integer',
        'linen_delivery_total' => 'integer',
    ];

    protected $dates = [
        'linen_delivery_created_at',
        'linen_delivery_updated_at',
        'linen_delivery_deleted_at',
    ];

    public $searching = 'linen_delivery_key';
    public $datatable = [
        'linen_delivery_id' => [false => 'Code', 'width' => 50],
        'linen_delivery_key' => [true => 'No. DO'],
        'linen_delivery_company_id' => [false => 'Company'],
        'linen_delivery_company_name' => [true => 'Company'],
        'linen_delivery_total' => [true => 'Total'],
        'linen_delivery_total_detail' => [false => 'Detail'],
        'linen_delivery_reported_date' => [true => 'Report Date'],
        'linen_delivery_created_by' => [false => 'Created At'],
        'linen_delivery_created_at' => [true => 'Created At'],
        'name' => [true => 'Created By'],
        'linen_delivery_status' => [true => 'Status', 'width' => 50, 'class' => 'text-center', 'status' => 'status'],
    ];

    public function mask_status()
    {
        return 'linen_delivery_status';
    }

    public function setMaskStatusAttribute($value)
    {
        $this->attributes[$this->mask_status()] = $value;
    }

    public function getMaskStatusAttribute()
    {
        return $this->{$this->mask_status()};
    }

    public function mask_company_id()
    {
        return 'linen_delivery_company_id';
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
        return $this->linen_delivery_company_name;
    }

    
    public function mask_driver_id()
    {
        return 'linen_delivery_company_id';
    }

    public function setMaskDriverIdAttribute($value)
    {
        $this->attributes[$this->mask_driver_id()] = $value;
    }

    public function getMaskDriverIdAttribute()
    {
        return $this->{$this->mask_driver_id()};
    }

    public function getMaskDriverNameAttribute()
    {
        return $this->linen_delivery_driver_name;
    }

    public function has_user(){

		return $this->hasOne(User::class, TeamFacades::getKeyName(), self::CREATED_BY);
    }

    public function has_grouping(){

		return $this->hasMany(Grouping::class, 'linen_grouping_delivery', 'linen_delivery_key');
    }

    public function has_detail(){

		return $this->hasMany(GroupingDetail::class, 'linen_grouping_detail_delivery', 'linen_delivery_key');
    }
    
    public static function boot()
    {
        parent::boot();

        parent::saving(function($model){

            $model->linen_delivery_company_name = CompanyFacades::find($model->mask_company_id)->company_name ?? '';
            $model->linen_delivery_driver_name = TeamFacades::find($model->mask_driver_id)->name ?? '';
            
        });

        parent::created(function($model){

            CreateDeliveryEvent::dispatch($model->{$model->getKeyName()});

        });
    }    
}
