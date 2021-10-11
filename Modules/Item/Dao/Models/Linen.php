<?php

namespace Modules\Item\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Dao\Models\Location;
use Wildside\Userstamps\Userstamps;
use Modules\System\Dao\Facades\CompanyFacades;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Item\Events\RegisterLinenEvent;
use Modules\System\Dao\Models\Company;

class Linen extends Model
{
    use Userstamps, FilterQueryString, HasFactory;
    protected $table = 'item_linen';
    protected $primaryKey = 'item_linen_rfid';
    protected $keyType = 'string';

    protected $filters = [
        'item_linen_company_id',
        'item_linen_location_id',
        'item_linen_company_id',
        'item_linen_product_id',
        'item_linen_status',
        'item_linen_created_by',
        'item_linen_updated_at',
    ];

    protected $fillable = [
        'item_linen_rfid',
        'item_linen_description',
        'item_linen_status',
        'item_linen_rent',
        'item_linen_session',
        'item_linen_location_id',
        'item_linen_location_name',
        'item_linen_company_id',
        'item_linen_company_name',
        'item_linen_product_id',
        'item_linen_product_name',
        'item_linen_created_at',
        'item_linen_updated_at',
        'item_linen_counter',
        'item_linen_update_by',
        'item_linen_created_by',
        'item_linen_created_name',
        'item_linen_deleted_by',
        'item_linen_latest',
        'item_linen_qty',
    ];

    // public $with = ['location', 'product', 'user'];

    public $timestamps = true;
    public $incrementing = false;

    public $rules = [
        'item_linen_location_id' => 'required|exists:system_location,location_id',
        'item_linen_company_id' => 'required|exists:system_company,company_id',
        'item_linen_product_id' => 'required|exists:item_product,item_product_id',
        'item_linen_rfid' => 'required|unique:item_linen',
    ];

    const CREATED_AT = 'item_linen_created_at';
    const UPDATED_AT = 'item_linen_updated_at';
    const DELETED_AT = 'item_linen_deleted_at';

    const CREATED_BY = 'item_linen_created_by';
    const UPDATED_BY = 'item_linen_updated_by';
    const DELETED_BY = 'item_linen_deleted_by';

    public $searching = 'item_linen_rfid';
    public $datatable = [
        'item_linen_rfid' => [true => 'No. Seri RFID', 'width' => 200],
        'item_linen_product_id' => [false => 'Product Id'],
        'item_linen_product_name' => [true => 'Product Name'],
        'item_linen_company_id' => [false => 'Company Id'],
        'item_linen_company_name' => [true => 'Company Name'],
        'item_linen_location_id' => [false => 'Location Id'],
        'item_linen_location_name' => [true => 'Location Name'],
        'item_linen_session' => [false => 'Key'],
        'item_linen_created_name' => [false => 'Key'],
        'item_linen_counter' => [true => 'Cuci', 'width' => 30],
        'item_linen_created_at' => [false => 'Created At'],
        'item_linen_rent' => [true => 'Rental', 'width' => 50, 'class' => 'text-center', 'status' => 'rent'],
        'item_linen_status' => [true => 'Status', 'width' => 150, 'class' => 'text-center', 'status' => 'status'],
        'item_linen_latest' => [true => 'Latest', 'width' => 80, 'class' => 'text-center', 'latest' => 'latest'],
    ];

    protected $casts = [
        'item_linen_created_at' => 'datetime:Y-m-d H:i:s',
        'item_linen_updated_at' => 'datetime:Y-m-d H:i:s',
        'item_linen_deleted_at' => 'datetime:Y-m-d H:i:s',
        'item_linen_rent' => 'integer',
        'item_linen_status' => 'integer',
        'item_linen_latest' => 'integer',
        'item_linen_counter' => 'integer',
    ];

    protected $dates = [
        'item_linen_created_at',
        'item_linen_updated_at',
        'item_linen_deleted_at',
    ];

    public function mask_rfid()
    {
        return 'item_linen_rfid';
    }

    public function setMaskRfidAttribute($value)
    {
        $this->attributes[$this->mask_rfid()] = $value;
    }

    public function getMaskRfidAttribute()
    {
        return $this->{$this->mask_rfid()};
    }

    public function mask_company_id()
    {
        return 'item_linen_company_id';
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
        return 'item_linen_product_id';
    }

    public function setMaskProductIdAttribute($value)
    {
        $this->attributes[$this->mask_product_id()] = $value;
    }

    public function getMaskProductIdAttribute()
    {
        return $this->{$this->mask_product_id()};
    }

    /**
     * product id
     *
     * @return void
     */

    public function mask_qty()
    {
        return 'item_linen_qty';
    }

    public function setMaskQtyAttribute($value)
    {
        $this->attributes[$this->mask_qty()] = $value;
    }

    public function getMaskQtyAttribute()
    {
        return $this->{$this->mask_qty()};
    }

    public function mask_counter()
    {
        return 'item_linen_counter';
    }

    public function setMaskCounterAttribute($value)
    {
        $this->attributes[$this->mask_counter()] = $value;
    }

    public function getMaskCounterAttribute()
    {
        return $this->{$this->mask_qty()};
    }


    /**
     * 
     * End Product ID
     */

     /**
     * latest
     *
     * @return void
     */

    public function mask_latest()
    {
        return 'item_linen_latest';
    }

    public function setMaskLatestAttribute($value)
    {
        $this->attributes[$this->mask_latest()] = $value;
    }

    public function getMaskLatestAttribute()
    {
        return $this->{$this->mask_latest()};
    }

        
    public function getMaskLatestName($value)
    {
        return $this->mask_latest()[$value][0];
    }

    /**
     * 
     * End latest
     */
    

     /**
     * latest
     *
     * @return void
     */

    public function mask_status()
    {
        return 'item_linen_status';
    }

    public function setMaskStatusAttribute($value)
    {
        $this->attributes[$this->mask_status()] = $value;
    }

    public function getMaskStatusAttribute()
    {
        return $this->{$this->mask_status()};
    }

    /**
     * 
     * End latest
     */

     /**
     * latest
     *
     * @return void
     */

    public function mask_rent()
    {
        return 'item_linen_rent';
    }

    public function setMaskRentAttribute($value)
    {
        $this->attributes[$this->mask_rent()] = $value;
    }

    public function getMaskRentAttribute()
    {
        return $this->{$this->mask_rent()};
    }

    /**
     * 
     * End latest
     */
    
    public function has_company()
    {
        return $this->hasOne(Company::class, CompanyFacades::getKeyName(), $this->mask_company_id());
    }

    public function has_location()
    {
        return $this->hasOne(Location::class, LocationFacades::getKeyName(), $this->mask_location_id());
    }

    public function has_product()
    {
        return $this->hasOne(Product::class, ProductFacades::getKeyName(), $this->mask_location_id());
    }

    public function has_user()
    {
        return $this->hasOne(User::class, TeamFacades::getKeyName(), self::CREATED_BY);
    }

    public function has_detail()
    {
        return $this->hasMany(LinenDetail::class,);   
    }

    public static function boot()
    {
        parent::boot();
        parent::saving(function ($model) {

            $model->item_linen_company_name = CompanyFacades::find($model->item_linen_company_id)->company_name ?? '';
            $model->item_linen_product_name = ProductFacades::find($model->item_linen_product_id)->item_product_name ?? '';
            $model->item_linen_location_name = LocationFacades::find($model->item_linen_location_id)->location_name ?? '';
            $model->item_linen_created_name = auth()->user()->name ?? '';
            $model->mask_counter = 0;
        });

        parent::created(function ($model) {
            if($model->mask_status == 1){

                RegisterLinenEvent::dispatch($model->mask_rfid, $model->mask_company_id, $model->mask_location_id, $model->mask_product_id);
            }

            // else if($model->mask_status == 2)
            // {
            //     RegisterLinenChangeEvent::dispatch($model->rfid, $model->company_id, $model->location_id, $model->product_id);
            // }
        });
    }
}
