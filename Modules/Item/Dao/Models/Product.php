<?php

namespace Modules\Item\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Facades\CategoryFacades;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Item\Dao\Facades\UnitFacades;
use Modules\System\Plugins\Helper;
use Wildside\Userstamps\Userstamps;

class Product extends Model
{
    use SoftDeletes, Userstamps;
    protected $table = 'item_product';
    protected $primaryKey = 'item_product_id';

    protected $fillable = [
        'item_product_id',
        'item_product_name',
        'item_product_sku',
        'item_product_image',
        'item_product_category_id',
        'item_product_unit_code',
        'item_product_description',
        'item_product_updated_at',
        'item_product_created_at',
        'item_product_deleted_at',
        'item_product_updated_by',
        'item_product_created_by',
        'item_product_deleted_by',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = true;
    public $rules = [
        'item_product_name' => 'required',
        'item_product_sku' => 'unique:item_product',
    ];

    const CREATED_AT = 'item_product_created_at';
    const UPDATED_AT = 'item_product_updated_at';
    const DELETED_AT = 'item_product_deleted_at';

    const CREATED_BY = 'item_product_created_by';
    const UPDATED_BY = 'item_product_updated_by';
    const DELETED_BY = 'item_product_deleted_by';

    public $searching = 'item_product_name';
    public $datatable = [
        'item_product_image' => [false => 'Image', 'width' => 100, 'class' => 'text-center'],
        'item_product_id' => [false => 'Code', 'width' => 50],
        'item_product_sku' => [false => 'SKU', 'width' => 100],
        'item_category_name' => [true => 'Category'],
        'item_product_name' => [true => 'Name'],
    ];

    protected $casts = [
        'item_product_created_at' => 'datetime:Y-m-d',
        'item_product_updated_at' => 'datetime:Y-m-d',
        'item_product_deleted_at' => 'datetime:Y-m-d',
    ];

    public function mask_category_id()
    {
        return 'item_product_category_id';
    }

    public function setMaskCategoryIdAttribute($value)
    {
        $this->attributes[$this->mask_category_id()] = $value;
    }

    public function getMaskCategoryIdAttribute()
    {
        return $this->{$this->mask_category_id()};
    }

    public function mask_unit_id()
    {
        return 'item_product_unit_id';
    }

    public function setMaskUnitIdAttribute($value)
    {
        $this->attributes[$this->mask_unit_id()] = $value;
    }

    public function getMaskProductNameAttribute()
    {
        return $this->item_product_name;
    }

    public static function boot()
    {
        parent::saving(function ($model) {
            $file_name = 'file';
            if (request()->has($file_name)) {
                $file = request()->file($file_name);
                $name = Helper::uploadImage($file, Helper::getTemplate(__CLASS__));
                $model->item_product_image = $name;
            }
        });

        parent::boot();
    }

    public function has_category()
    {
        return $this->hasOne(Category::class, CategoryFacades::getKeyName(), $this->mask_category_id());
    }

    public function has_unit()
    {
        return $this->hasOne(Unit::class, UnitFacades::getKeyName(), $this->mask_unit_id());
    }
}
