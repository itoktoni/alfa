<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Linen\Dao\Facades\StockDetailFacades;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Wildside\Userstamps\Userstamps;

class StockDetail extends Model
{
    protected $table = 'linen_stock_detail';
    protected $primaryKey = 'linen_stock_detail_rfid';
    protected $keyType = 'string';

    protected $fillable = [
        'linen_stock_detail_rfid',
        'linen_stock_detail_location_id',
        'linen_stock_detail_location_name',
        'linen_stock_detail_company_id',
        'linen_stock_detail_company_name',
        'linen_stock_detail_product_name',
        'linen_stock_detail_product_id',
        'linen_stock_detail_location_ori',
        'linen_stock_detail_company_ori',
        'linen_stock_detail_qty',
    ];

    public $timestamps = false;
    public $incrementing = false;
    public $rules = [
        'linen_stock_detail_rfid' => 'required|unique:linen_stock_detail',
        'linen_stock_detail_company_id' => 'required|unique:system_company',
        'linen_stock_detail_location_id' => 'required|unique:system_location',
        'linen_stock_detail_product_id' => 'required|unique:item_product_id',
    ];

    const CREATED_AT = 'linen_stock_detail_created_at';
    const UPDATED_AT = 'linen_stock_detail_updated_at';
    const DELETED_AT = 'linen_stock_detail_deleted_at';

    const CREATED_BY = 'linen_stock_detail_created_by';
    const UPDATED_BY = 'linen_stock_detail_updated_by';
    const DELETED_BY = 'linen_stock_detail_deleted_by';

    public $searching = 'linen_stock_detail_id';
    public $datatable = [
        'linen_stock_detail_id' => [false => 'Code', 'width' => 50],
        'linen_stock_detail_company_id' => [false => 'Company'],
        'linen_stock_detail_location_id' => [false => 'Location'],
        'linen_stock_detail_product_id' => [false => 'Company'],
        'linen_stock_detail_company_name' => [true => 'Company'],
        'linen_stock_detail_location_name' => [true => 'Location'],
        'linen_stock_detail_product_name' => [true => 'Company'],
        'linen_stock_detail_qty' => [true => 'Qty'],
    ];

    public function mask_rfid()
    {
        return 'linen_stock_detail_rfid';
    }

    public function setMaskRfidAttribute($value)
    {
        $this->attributes[$this->rfid()] = $value;
    }

    public function getMaskRfidAttribute()
    {
        return $this->{$this->rfid()};
    }

    public function mask_qty()
    {
        return 'linen_stock_detail_qty';
    }

    public function setMaskQtyAttribute($value)
    {
        $this->attributes[$this->qty()] = $value;
    }

    public function getMaskQtyAttribute()
    {
        return $this->{$this->qty()};
    }

    public function mask_company_scan()
    {
        return 'linen_stock_detail_company_id';
    }

    public function setMaskCompanyIdAttribute($value)
    {
        $this->attributes[$this->mask_company_scan()] = $value;
    }

    public function getMaskCompanyIdAttribute()
    {
        return $this->{$this->mask_company_scan()};
    }

    public function mask_company_ori()
    {
        return 'linen_stock_detail_company_ori';
    }

    public function setMaskCompanyOriAttribute($value)
    {
        $this->attributes[$this->company_ori()] = $value;
    }

    public function getMaskCompanyOriAttribute()
    {
        return $this->{$this->company_ori()};
    }
  
    public function mask_location_scan()
    {
        return 'linen_stock_detail_location_id';
    }

    public function setMaskLocationScanAttribute($value)
    {
        $this->attributes[$this->mask_location_scan()] = $value;
    }

    public function getMaskLocationScanAttribute()
    {
        return $this->{$this->mask_location_scan()};
    }

    public function mask_location_ori()
    {
        return 'linen_stock_detail_location_ori';
    }

    public function setMaskLocationOriAttribute($value)
    {
        $this->attributes[$this->mask_location_ori()] = $value;
    }

    public function getMaskLocationOriAttribute()
    {
        return $this->{$this->mask_location_ori()};
    }
    
    public function mask_product_id()
    {
        return 'linen_stock_detail_product_id';
    }

    public function setMaskProductIdAttribute($value)
    {
        $this->attributes[$this->product_id()] = $value;
    }

    public function getMaskProductIdAttribute()
    {
        return $this->{$this->product_id()};
    }
    
    public function has_company()
    {
        return $this->hasOne(Company::class, CompanyFacades::getKeyName(), $this->company_id());
    }

    public function has_location()
    {
        return $this->hasOne(Location::class, LocationFacades::getKeyName(), $this->location_id());
    }

    public function has_product()
    {
        return $this->hasOne(Product::class, ProductFacades::getKeyName(), $this->product_id());
    }    

    public static function boot()
    {
        parent::boot();

        parent::creating(function($model){

            $model->linen_stock_detail_company_name = CompanyFacades::find($model->linen_stock_detail_company_id)->company_name ?? '';
            $model->linen_stock_detail_product_name = ProductFacades::find($model->linen_stock_detail_product_id)->item_product_name ?? '';
            $model->linen_stock_detail_location_name = LocationFacades::find($model->linen_stock_detail_location_id)->location_name ?? '';

        });
    }    
}
