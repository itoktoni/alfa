<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Wildside\Userstamps\Userstamps;

class KotorDetail extends Model
{
    use SoftDeletes, Userstamps;

    protected $table = 'linen_kotor_detail';
    protected $primaryKey = 'linen_kotor_detail_rfid';

    protected $fillable = [
        'linen_kotor_detail_rfid',
        'linen_kotor_detail_created_at',
        'linen_kotor_detail_downloaded_at',
        'linen_kotor_detail_uploaded_at',
        'linen_kotor_detail_updated_at',
        'linen_kotor_detail_deleted_at',
        'linen_kotor_detail_updated_by',
        'linen_kotor_detail_created_name',
        'linen_kotor_detail_created_by',
        'linen_kotor_detail_deleted_by',
        'linen_kotor_detail_session',
        'linen_kotor_detail_scan_location_id',
        'linen_kotor_detail_scan_location_name',
        'linen_kotor_detail_scan_company_id',
        'linen_kotor_detail_scan_company_name',
        'linen_kotor_detail_product_id',
        'linen_kotor_detail_product_name',
        'linen_kotor_detail_ori_location_id',
        'linen_kotor_detail_ori_location_name',
        'linen_kotor_detail_ori_company_id',
        'linen_kotor_detail_ori_company_name',
        'linen_kotor_detail_description',
        'linen_kotor_detail_form',
        'linen_kotor_detail_key',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = true;
    public $rules = [
        'linen_kotor_detail_rfid' => 'required|unique:linen_outstanding,linen_outstanding_rfid',
    ];

    const CREATED_AT = 'linen_kotor_detail_created_at';
    const UPDATED_AT = 'linen_kotor_detail_updated_at';
    const DELETED_AT = 'linen_kotor_detail_deleted_at';

    const CREATED_BY = 'linen_kotor_detail_created_by';
    const UPDATED_BY = 'linen_kotor_detail_updated_by';
    const DELETED_BY = 'linen_kotor_detail_deleted_by';

    protected $casts = [
        'linen_kotor_detail_created_at' => 'datetime:Y-m-d H:i:s',
        'linen_kotor_detail_updated_at' => 'datetime:Y-m-d H:i:s',
        'linen_kotor_detail_deleted_at' => 'datetime:Y-m-d H:i:s',
        'linen_kotor_detail_total' => 'integer',
    ];

    protected $dates = [
        'linen_kotor_detail_created_at',
        'linen_kotor_detail_updated_at',
        'linen_kotor_detail_deleted_at',
    ];

    public $searching = 'linen_kotor_detail_retur';
    public $datatable = [
        'linen_kotor_detail_rfid' => [false => 'Code', 'width' => 50],
        'linen_kotor_detail_company_name' => [true => 'Company'],
        'linen_kotor_detail_location_name' => [true => 'Location'],
        'linen_kotor_detail_total' => [true => 'Total'],
        'linen_kotor_detail_created_at' => [true => 'Created At'],
        'name' => [true => 'Created By'],
    ];

    public function mask_rfid()
    {
        return 'linen_kotor_detail_rfid';
    }

    public function setMaskRfidAttribute($value)
    {
        $this->attributes[$this->mask_rfid()] = $value;
    }

    public function getMaskRfidAttribute()
    {
        return $this->{$this->mask_rfid()};
    }

    // start location
    
    public function mask_location_scan()
    {
        return 'linen_kotor_detail_scan_location_id';
    }

    public function setMaskLocationScanAttribute($value)
    {
        $this->attributes[$this->mask_location_scan()] = $value;
    }

    public function getMaskLocationScanAttribute()
    {
        return $this->{$this->mask_location_scan()};
    }

    public function getMaskLocationScanNameAttribute()
    {
        return $this->linen_kotor_detail_scan_location_name;
    }

    public function mask_location_ori()
    {
        return 'linen_kotor_detail_ori_location_id';
    }

    public function setMaskLocationOriAttribute($value)
    {
        $this->attributes[$this->mask_location_ori()] = $value;
    }

    public function getMaskLocationOriAttribute()
    {
        return $this->{$this->mask_location_ori()};
    }

    public function getMaskLocationOriNameAttribute()
    {
        return $this->linen_kotor_detail_ori_location_name;
    }

    // end location

    public function mask_company_scan()
    {
        return 'linen_kotor_detail_scan_company_id';
    }

    public function setMaskCompanyScanAttribute($value)
    {
        $this->attributes[$this->company_scan()] = $value;
    }

    public function getMaskCompanyScanAttribute()
    {
        return $this->{$this->mask_company_scan()};
    }

    public function getMaskCompanyScanNameAttribute()
    {
        return $this->linen_kotor_detail_scan_company_name;
    }
    
    public function mask_company_ori()
    {
        return 'linen_kotor_detail_ori_company_id';
    }

    public function setMaskCompanyOriAttribute($value)
    {
        $this->attributes[$this->mask_company_ori()] = $value;
    }

    public function getMaskCompanyOriAttribute()
    {
        return $this->{$this->mask_company_ori()};
    }
    
    public function getMaskCompanyOriNameAttribute()
    {
        return $this->linen_kotor_detail_ori_company_name;
    }
    
    /**
     * product id
     *
     * @return void
     */

    public function mask_product_id()
    {
        return 'linen_kotor_detail_product_id';
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
        return $this->linen_kotor_detail_product_name;
    }

    public function has_user(){

		return $this->hasOne(User::class, TeamFacades::getKeyName(), self::CREATED_BY);
    }
    
    public static function boot()
    {
        parent::boot();

        parent::saving(function($model){

            $company = $model->linen_kotor_detail_company_id;
            $model->linen_kotor_detail_company_name = CompanyFacades::find($company)->company_name ?? '';

            $location = $model->linen_kotor_detail_location_id;
            $model->linen_kotor_detail_location_name = LocationFacades::find($location)->location_name ?? '';

        });

        parent::deleted(function($model){

            $detail = GroupingDetail::where('linen_kotor_detail_barcode', $model->linen_kotor_detail_barcode)->count();
            Grouping::where('linen_kotor_barcode', $model->linen_kotor_detail_barcode)->update([
                'linen_kotor_total' => $detail
            ]);
        });
    }    
}
