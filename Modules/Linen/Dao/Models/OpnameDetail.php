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

    public $searching = 'linen_opname_detail_key';
    public $datatable = [
        'linen_opname_detail_key' => [false => 'Code', 'width' => 50],
        'linen_opname_detail_product_name' => [true => 'Product'],
        'linen_opname_detail_company_name' => [true => 'Company'],
        'linen_opname_detail_location_name' => [true => 'Location'],
    ];

    public function mask_key()
    {
        return 'linen_opname_detail_key';
    }

    public function setMaskKeyAttribute($value)
    {
        $this->attributes[$this->mask_key()] = $value;
    }

    public function getMaskKeyAttribute()
    {
        return $this->{$this->mask_key()};
    }

    public function mask_rfid()
    {
        return 'linen_opname_detail_rfid';
    }

    public function setMaskRfidAttribute($value)
    {
        $this->attributes[$this->mask_rfid()] = $value;
    }

    public function getMaskRfidAttribute()
    {
        return $this->{$this->mask_rfid()};
    }

    public function mask_location_id()
    {
        return 'linen_opname_detail_location_id';
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
        return $this->linen_opname_detail_location_name;
    }

    // end location

    public function mask_company_id()
    {
        return 'linen_opname_detail_company_id';
    }

    public function setMaskCompanyIdAttribute($value)
    {
        $this->attributes[$this->company_id()] = $value;
    }

    public function getMaskCompanyIdAttribute()
    {
        return $this->{$this->mask_company_id()};
    }

    public function getMaskCompanyNameAttribute()
    {
        return $this->linen_opname_detail_company_name;
    }

    public function mask_product_id()
    {
        return 'linen_opname_detail_product_id';
    }

    public function setMaskProductIdAttribute($value)
    {
        $this->attributes[$this->mask_product_id()] = $value;
    }

    public function getMaskProductIdAttribute()
    {
        return $this->{$this->mask_product_id()};
    }

    public function getMaskProductNameAttribute()
    {
        return $this->linen_opname_detail_product_name;
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
