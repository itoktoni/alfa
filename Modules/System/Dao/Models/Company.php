<?php

namespace Modules\System\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Item\Dao\Models\Product;
use Modules\System\Dao\Facades\CompanyConnectionItemProductFacades;
use Modules\System\Dao\Facades\CompanyConnectionLocationFacades;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Plugins\Helper;

class Company extends Model
{
    protected $table = 'system_company';
    protected $primaryKey = 'company_id';

    protected $fillable = [
        'company_id',
        'company_name',
        'company_description',
        'company_address',
        'company_email',
        'company_phone',
        'company_person',
        'company_logo',
        'company_sign',
        // 'company_holding_id'
    ];

    public $with = ['has_location', 'has_product'];

    public $timestamps = false;
    public $incrementing = false;
    public $rules = [
        'company_name' => 'required|min:3|unique:system_company',
    ];

    const CREATED_AT = 'company_created_at';
    const UPDATED_AT = 'company_created_by';

    public $searching = 'company_name';
    public $datatable = [
        'company_id' => [false => 'Code'],
        'company_name' => [true => 'Company Name'],
        'company_person' => [true => 'Contact Person'],
        'company_email' => [true => 'Email', 'width' => 350],
        'company_phone' => [true => 'Phone'],
    ];

    public $show    = [
        '1' => ['Show', 'info'],
        '0' => ['Hide', 'warning'],
    ];

    public function getMaskCompanyNameAttribute()
    {
        return $this->company_name;
    }

    public function has_location()
	{
		return $this->belongsToMany(Location::class, CompanyConnectionLocationFacades::getTable(), CompanyFacades::GetKeyName(), LocationFacades::getKeyName());
    }

    public function has_product()
	{
		return $this->belongsToMany(Product::class, CompanyConnectionItemProductFacades::getTable(), CompanyFacades::GetKeyName(), ProductFacades::getKeyName())->withPivot([
            'company_item_target',
            'company_item_maximal',
            'company_item_minimal',
            'company_item_unit_id',
            'company_item_size_id',
            'company_item_weight',
            'company_item_description',
            'company_item_realisasi',
            'company_item_price',
        ]);
    }

    public static function boot()
    {
        parent::saving(function ($model) {
            $file_name = 'file';
            if (request()->has($file_name)) {
                $file = request()->file($file_name);
                $name = Helper::uploadImage($file, Helper::getTemplate(__CLASS__));
                $model->company_logo = $name;
            }
        });

        parent::boot();
    }
}

