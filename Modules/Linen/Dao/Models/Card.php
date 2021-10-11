<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Wildside\Userstamps\Userstamps;

class Card extends Model
{
    use Userstamps;

    protected $table = 'linen_card';
    protected $primaryKey = 'linen_card_id';
    // protected $keyType = 'string';

    protected $fillable = [
        'linen_card_id',
        'linen_card_status',
        'linen_card_company_id',
        'linen_card_company_name',
        'linen_card_product_id',
        'linen_card_product_name',
        'linen_card_location_id',
        'linen_card_location_name',
        'linen_card_stock_register',
        'linen_card_stock_kotor',
        'linen_card_stock_bersih',
        'linen_card_stock_pending',
        'linen_card_stock_hilang',
        'linen_card_stock_saldo',
        'linen_card_stock_notes',
        'linen_card_created_at',
        'linen_card_updated_at',
        'linen_card_deleted_at',
        'linen_card_updated_by',
        'linen_card_created_by',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = true;
    public $rules = [
        'linen_card_id' => 'required',
        'linen_card_company_id' => 'required|unique:system_company',
    ];

    const CREATED_AT = 'linen_card_created_at';
    const UPDATED_AT = 'linen_card_updated_at';
    const DELETED_AT = 'linen_card_deleted_at';

    const CREATED_BY = 'linen_card_created_by';
    const UPDATED_BY = 'linen_card_updated_by';
    const DELETED_BY = 'linen_card_deleted_by';

    protected $casts = [
        'linen_card_created_at' => 'datetime:Y-m-d H:i:s',
        'linen_card_updated_at' => 'datetime:Y-m-d H:i:s',
        'linen_card_deleted_at' => 'datetime:Y-m-d H:i:s',
    ];

    protected $dates = [
        'linen_card_created_at',
        'linen_card_updated_at',
        'linen_card_deleted_at',
    ];

    public $searching = 'linen_card_product_name';
    public $datatable = [
        'linen_card_id' => [false => 'Code', 'width' => 50],
        'linen_card_created_at' => [true => 'Tanggal', 'width' => 70],
        'linen_card_company_id' => [false => 'Company'],
        'linen_card_company_name' => [true => 'Company'], 
        'linen_card_location_id' => [false => 'Company'],
        'linen_card_location_name' => [true => 'Location'],          
        'linen_card_product_id' => [false => 'Company'],
        'linen_card_product_name' => [true => 'Product'],
        'linen_card_stock_register' => [true => 'Reg', 'width' => 30],
        'linen_card_stock_kotor' => [true => 'Kotor', 'width' => 40],
        'linen_card_stock_bersih' => [true => 'Bersih', 'width' => 40],
        'linen_card_stock_pending' => [true => 'Pending', 'width' => 50],
        'linen_card_stock_hilang' => [true => 'Hilang', 'width' => 40],
        'linen_card_stock_return' => [true => 'Return', 'width' => 40],
        'linen_card_stock_rewash' => [true => 'Rewash', 'width' => 50],
        'linen_card_stock_saldo' => [true => 'Saldo', 'width' => 40],
        'linen_card_status' => [true => 'Notes', 'width' => 50],
    ];
    
    public function mask_company_id()
    {
        return 'linen_card_company_id';
    }

    public function setMaskCompanyIdAttribute($value)
    {
        $this->attributes[$this->mask_company_id()] = $value;
    }

    public function getMaskCompanyIdAttribute()
    {
        return $this->{$this->mask_company_id()};
    }
      
    /**
     * product id
     *
     * @return void
     */

    public function mask_location_id()
    {
        return 'item_linen_location_id';
    }

    public function setMaskLocationIdAttribute($value)
    {
        $this->attributes[$this->mask_location_id()] = $value;
    }

    public function getMaskLocationIdAttribute()
    {
        return $this->{$this->mask_location_id()};
    }


    
    /**
     * product id
     *
     * @return void
     */

    public function mask_product_id()
    {
        return 'linen_card_product_id';
    }

    public function setMaskProductIdAttribute($value)
    {
        $this->attributes[$this->mask_product_id()] = $value;
    }

    public function getMaskProductIdAttribute()
    {
        return $this->{$this->mask_product_id()};
    }

    
    public function mask_status()
    {
        return 'linen_card_status';
    }

    public function setMaskStatusAttribute($value)
    {
        $this->attributes[$this->mask_status()] = $value;
    }

    public function getMaskStatusAttribute()
    {
        return $this->{$this->mask_status()};
    }


    public static function boot()
    {
        parent::boot();

        parent::creating(function($model){

            $model->linen_card_company_name = CompanyFacades::find($model->linen_card_company_id)->company_name ?? '';
            $model->linen_card_product_name = ProductFacades::find($model->linen_card_product_id)->item_product_name ?? '';
            $model->linen_card_location_name = LocationFacades::find($model->linen_card_location_id)->location_name ?? '';

        });
    }    
}
