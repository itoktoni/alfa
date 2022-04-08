<?php

namespace Modules\System\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Item\Dao\Facades\CompanyProductFacades;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Item\Dao\Facades\SizeFacades;
use Modules\Item\Dao\Facades\UnitFacades;
use Modules\Item\Dao\Models\Product;
use Modules\Item\Dao\Models\Size;
use Modules\Item\Dao\Models\Unit;
use Modules\Item\Dao\Repositories\CompanyProductRepository;
use Modules\Linen\Dao\Facades\StockFacades;
use Modules\System\Dao\Facades\CompanyFacades;

class CompanyConnectionItemProduct extends Model
{
	protected $table = 'system_company_connection_item_product';
	protected $primaryKey = 'company_item_id';

	protected $fillable = [
		'company_id',
		'item_product_id',
		'location_id',
		'company_item_id',
		'company_item_target',
		'company_item_realisasi',
		'company_item_maximal',
		'company_item_minimal',
		'company_item_unit_id',
		'company_item_size_id',
		'company_item_weight',
		'company_item_price',
		'company_item_description',
		'company_item_counter',
	];

	public $incrementing = true;
	public $timestamps = false;	

	public $searching = 'system_company.company_id';
    public $datatable = [
        'company_item_id' => [false => 'ID'],
        'system_company.company_id' => [false => 'Code'],
        'company_name' => [true => 'Company Name'],
        'system_location.location_id' => [false => 'Code'],
        'location_name' => [true => 'Location Name'],
        'item_product.item_product_id' => [false => 'Product Id'],
        'item_product_name' => [true => 'Product Name'],
        'company_item_unit_id' => [false => 'Unit Id'],
        'item_size_code' => [false => 'Size Id'],
        'item_size_name' => [true => 'Size Name'],
        'company_item_price' => [true => 'Price', 'width' => '50'],
        'company_item_target' => [true => 'Parstok', 'width' => '50'],
        'company_item_realisasi' => [true => 'Real', 'width' => '50'],
        'company_item_minimal' => [true => 'Kekurangan', 'width' => '80'],
        'company_item_weight' => [true => 'Kg', 'width' => '50'],
        'item_unit_name' => [false => 'Unit Name', 'width' => '80'],
        'company_item_maximal' => [false => 'Max', 'width' => '50'],
	];
	
	public $rules = [
        'company_id' => 'required|exists:system_company',
        'product_id' => 'required|exists:item_product',
	];

	public function mask_company_id()
    {
        return 'company_id';
    }

    public function setMaskCompanyIdAttribute($value)
    {
        $this->attributes[$this->mask_company_id()] = $value;
    }

    public function getMaskCompanyIdAttribute()
    {
        return $this->{$this->mask_company_id()};
    }

	public function mask_product_id()
    {
        return 'item_product_id';
    }

    public function setMaskProductIdAttribute($value)
    {
        $this->attributes[$this->mask_product_id()] = $value;
    }

    public function getMaskProductIdAttribute()
    {
        return $this->{$this->mask_product_id()};
    }

	public function mask_unit_id()
    {
        return 'company_item_unit_id';
    }

    public function setMaskUnitIdAttribute($value)
    {
        $this->attributes[$this->mask_unit_id()] = $value;
    }

    public function getMaskUnitIdAttribute()
    {
        return $this->{$this->mask_unit_id()};
    }

	public function mask_size_id()
    {
        return 'company_item_size_id';
    }

    public function setMaskSizeIdAttribute($value)
    {
        $this->attributes[$this->mask_size_id()] = $value;
    }

    public function getMaskSizeIdAttribute()
    {
        return $this->{$this->mask_size_id()};
    }

    public function mask_realisasi()
    {
        return 'company_item_realisasi';
    }

    public function setMaskRealisasiAttribute($value)
    {
        $this->attributes[$this->mask_realisasi()] = $value;
    }

    public function getMaskRealisasiAttribute()
    {
        return $this->{$this->mask_realisasi()};
    }
	
	public function has_company()
    {
        return $this->hasOne(Company::class, CompanyFacades::getKeyName(), CompanyFacades::getKeyName());
	}	

	public function has_location()
    {
        return $this->hasOne(Location::class, CompanyFacades::getKeyName(), CompanyFacades::getKeyName());
	}
	
	public function has_product()
    {
        return $this->hasOne(Product::class, ProductFacades::getKeyName(), $this->mask_product_id());
	}
	
	public function has_size()
    {
        return $this->hasOne(Size::class, SizeFacades::getKeyName(), $this->mask_size_id());
	}
	
	public function has_unit()
    {
        return $this->hasOne(Unit::class, UnitFacades::getKeyName(), $this->mask_unit_id());
    }
}
