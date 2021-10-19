<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Item\Dao\Models\Product;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Dao\Models\Company;
use Modules\System\Dao\Models\Location;
use Wildside\Userstamps\Userstamps;

class Stock extends Model
{
    protected $table = 'view_stock';
    protected $primaryKey = 'view_company_id';
    // protected $keyType = 'string';

    // public $with = ['company', 'location', 'product'];

    public $timestamps = false;
    public $incrementing = false;

    public $searching = 'view_product_name';
    public $datatable = [
        'view_company_id' => [false => 'Company'],
        'view_company_name' => [true => 'Company Name'],
        'view_location_id' => [false => 'Location'],
        'view_location_name' => [true => 'Location Name'],
        'view_product_id' => [false => 'Company'],
        'view_product_name' => [true => 'Product Name'],
        'view_register' => [true => 'Register', 'width' => '80'],
        'view_qty' => [true => 'Qty', 'width' => '80'],
        'view_cuci' => [true => 'cuci', 'width' => '80'],
    ];

    public function mask_company_id()
    {
        return 'view_company_id';
    }

    public function mask_location_id()
    {
        return 'view_location_id';
    }

    public function mask_product_id()
    {
        return 'view_product_id';
    }

    public function mask_qty()
    {
        return 'view_qty';
    }

    public function setMaskQtyAttribute($value)
    {
        $this->attributes[$this->mask_qty()] = $value;
    }

    public function getMaskQtyAttribute()
    {
        return $this->{$this->mask_qty()};
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
   
}
