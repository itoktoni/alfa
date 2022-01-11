<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Item\Dao\Models\Linen;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\Linen\Dao\Facades\MasterOutstandingFacades;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Wildside\Userstamps\Userstamps;

class OutstandingLock extends Model
{
    use Userstamps, FilterQueryString;

    protected $table = 'linen_outstanding_lock';
    protected $primaryKey = 'linen_outstanding_rfid';
    protected $keyType = 'string';

    protected $filters = [
        'linen_outstanding_scan_company_id',
        'linen_outstanding_ori_company_id',
        'linen_outstanding_ori_location_id',
        'linen_outstanding_product_id',
        'linen_outstanding_status',
        'linen_outstanding_description',
        'linen_outstanding_created_by',
    ];

    protected $fillable = [
        'linen_outstanding_rfid',
        'linen_outstanding_status',
        'linen_outstanding_created_at',
        'linen_outstanding_updated_at',
        'linen_outstanding_downloaded_at',
        'linen_outstanding_uploaded_at',
        'linen_outstanding_deleted_at',
        'linen_outstanding_updated_by',
        'linen_outstanding_created_by',
        'linen_outstanding_deleted_by',
        'linen_outstanding_session',
        'linen_outstanding_key',
        'linen_outstanding_process',
        'linen_outstanding_scan_location_id',
        'linen_outstanding_scan_location_name',
        'linen_outstanding_scan_company_id',
        'linen_outstanding_scan_company_name',
        'linen_outstanding_product_id',
        'linen_outstanding_product_name',
        'linen_outstanding_ori_location_id',
        'linen_outstanding_ori_location_name',
        'linen_outstanding_ori_company_id',
        'linen_outstanding_ori_company_name',
        'linen_outstanding_description',
        'linen_outstanding_opname',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = true;
    public $rules = [
        'linen_outstanding_scan_company_id' => 'required|exists:system_company,company_id',
        'linen_outstanding_scan_location_id' => 'required|exists:system_location,location_id',
        'linen_outstanding_rfid' => 'required|exists:item_linen,item_linen_rfid'
    ];

    const CREATED_AT = 'linen_outstanding_created_at';
    const UPDATED_AT = 'linen_outstanding_updated_at';
    const DELETED_AT = 'linen_outstanding_deleted_at';

    const CREATED_BY = 'linen_outstanding_created_by';
    const UPDATED_BY = 'linen_outstanding_updated_by';
    const DELETED_BY = 'linen_outstanding_deleted_by';

    protected $casts = [
        'linen_outstanding_created_at' => 'datetime:Y-m-d H:i:s',
        'linen_outstanding_updated_at' => 'datetime:Y-m-d H:i:s',
        'linen_outstanding_deleted_at' => 'datetime:Y-m-d H:i:s',
        'linen_outstanding_status' => 'integer',
        'linen_outstanding_description' => 'integer',
        'linen_outstanding_process' => 'integer',
    ];

    protected $dates = [
        'linen_outstanding_created_at',
        'linen_outstanding_updated_at',
        'linen_outstanding_deleted_at',
    ];

    public $searching = 'linen_outstanding_rfid';
    public $datatable = [
        'linen_outstanding_session' => [false => 'No. Transaksi', 'width' => 100],
        'linen_outstanding_key' => [true => 'No. Transaksi', 'width' => 100],
        'linen_outstanding_rfid' => [true => 'No. Seri RFID', 'width' => 150],
        'linen_outstanding_product_id' => [false => 'Product'],
        'linen_outstanding_product_name' => [true => 'Product'],
        'linen_outstanding_scan_company_id' => [false => 'Scan R.S'],
        'linen_outstanding_scan_company_name' => [false => 'Scan R.S'],
        'linen_outstanding_scan_location_id' => [false => 'Scan R.S'],
        'linen_outstanding_scan_location_name' => [false => 'Scan R.S'],
        'linen_outstanding_ori_company_id' => [false => 'Rumah Sakit'],
        'linen_outstanding_ori_company_name' => [true => 'Rumah Sakit'],
        'linen_outstanding_ori_location_id' => [false => 'Location'],
        'linen_outstanding_opname' => [false => 'Location'],
        'linen_outstanding_ori_location_name' => [true => 'Ruangan'],
        'linen_outstanding_created_at' => [true => 'Tanggal Masuk', 'width' => 50],
        'name' => [true => 'Operator'],
        'linen_outstanding_status' => [true => 'Status', 'width' => 50, 'class' => 'text-center', 'status' => 'status'],
        'linen_outstanding_process' => [true => 'Process', 'width' => 50, 'class' => 'text-center', 'status' => 'status'],
        'linen_outstanding_description' => [true => 'Description', 'width' => 100, 'class' => 'text-center', 'status' => 'description'],
    ];

    public function mask_created_at(){
        return self::CREATED_AT;
    }

    public function mask_session(){
        return 'linen_outstanding_session';
    }

    // start location
    
    public function mask_location_scan()
    {
        return 'linen_outstanding_scan_location_id';
    }

    public function setMaskLocationScanAttribute($value)
    {
        $this->attributes[$this->mask_location_scan()] = $value;
    }

    public function getMaskLocationScanAttribute()
    {
        return $this->{$this->mask_location_scan()};
    }

    public function mask_opname()
    {
        return 'linen_outstanding_opname';
    }

    public function setMaskOpnameAttribute($value)
    {
        $this->attributes[$this->mask_opname()] = $value;
    }

    public function getMaskOpnameAttribute()
    {
        return $this->{$this->mask_opname()};
    }

    public function mask_location_ori()
    {
        return 'linen_outstanding_ori_location_id';
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
        return $this->linen_outstanding_ori_location_name;
    }

    // end location

    public function mask_company_scan()
    {
        return 'linen_outstanding_scan_company_id';
    }

    public function setMaskCompanyScanAttribute($value)
    {
        $this->attributes[$this->mask_company_scan()] = $value;
    }

    public function getMaskCompanyScanAttribute()
    {
        return $this->{$this->mask_mask_company_scan()};
    }
    
    public function mask_company_ori()
    {
        return 'linen_outstanding_ori_company_id';
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
        return $this->linen_outstanding_ori_company_name;
    }

    public function mask_pending()
    {
        return 'linen_outstanding_pending_at';
    }

    public function setMaskPendingAttribute($value)
    {
        $this->attributes[$this->mask_pending()] = $value;
    }

    public function getMaskPendingAttribute()
    {
        return $this->{$this->mask_pending()};
    }

    public function mask_hilang()
    {
        return 'linen_outstanding_hilang_at';
    }

    public function setMaskHilangAttribute($value)
    {
        $this->attributes[$this->mask_hilang()] = $value;
    }

    public function getMaskHilangAttribute()
    {
        return $this->{$this->mask_hilang()};
    }

    /**
     * product id
     *
     * @return void
     */

    public function mask_product_id()
    {
        return 'linen_outstanding_product_id';
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
        return $this->linen_outstanding_product_name;
    }

    public function mask_status()
    {
        return 'linen_outstanding_status';
    }

    public function setMaskStatusAttribute($value)
    {
        $this->attributes[$this->mask_status()] = $value;
    }

    public function getMaskStatusAttribute()
    {
        return $this->{$this->mask_status()};
    }

    public function mask_process()
    {
        return 'linen_outstanding_process';
    }

    public function setMaskProcessAttribute($value)
    {
        $this->attributes[$this->mask_process()] = $value;
    }

    public function getMaskProcessAttribute()
    {
        return $this->{$this->mask_process()};
    }

    public function mask_description()
    {
        return 'linen_outstanding_description';
    }

    public function setMaskDescriptionAttribute($value)
    {
        $this->attributes[$this->mask_description()] = $value;
    }

    public function getMaskDescriptionAttribute()
    {
        return $this->{$this->mask_description()};
    }

    public function mask_rfid()
    {
        return 'linen_outstanding_rfid';
    }

    public function setMaskRfidAttribute($value)
    {
        $this->attributes[$this->mask_rfid()] = $value;
    }

    public function getMaskRfidAttribute()
    {
        return $this->{$this->mask_rfid()};
    }

    public function has_master()
	{
		return $this->hasOne(MasterOutstanding::class, MasterOutstandingFacades::getSessionKeyName(), $this->getSessionKeyName());
    }

    public function has_rfid()
    {
        return $this->hasOne(Linen::class, 'item_linen_rfid', 'linen_outstanding_rfid');
    }

    public function has_user(){

		return $this->hasOne(User::class, TeamFacades::getKeyName(), self::CREATED_BY);
    }
    
    public static function boot()
    {
        parent::boot();
        
        parent::saving(function ($model) {
            // $linen = LinenFacades::where('item_linen_rfid', $model->linen_outstanding_rfid)->first();
            // if ($linen) {

            //     $model->linen_outstanding_product_id = $linen->item_linen_product_id;
            //     $model->linen_outstanding_product_name = $linen->product->item_product_name ?? '';

            //     $model->linen_outstanding_ori_company_id = $linen->item_linen_company_id;
            //     $model->linen_outstanding_ori_company_name = $linen->company->company_name ?? '';

            //     $model->linen_outstanding_ori_location_id = $linen->item_linen_location_id;
            //     $model->linen_outstanding_ori_location_name = $linen->location->location_name ?? '';
            // }

            // $model->linen_outstanding_created_name = auth()->user()->name ?? '';

            // $company = CompanyFacades::find($model->linen_outstanding_scan_company_id);
            // $model->linen_outstanding_scan_company_name = $company->company_name ?? '';

            // $location = LocationFacades::find($model->linen_outstanding_scan_location_id);
            // $model->linen_outstanding_scan_location_name = $location->location_name ?? '';

            // $model->linen_outstanding_description = LinenStatus::Sesuai;
            // if($model->linen_outstanding_scan_company_id != $linen->item_linen_company_id){

            //     $model->linen_outstanding_description = LinenStatus::BedaRs;
            // }
        });
    }

}
