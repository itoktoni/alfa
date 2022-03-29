<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Plugins\Helper;
use Wildside\Userstamps\Userstamps;

class Stock extends Model
{
    use FilterQueryString;
    protected $table = 'view_balance';
    protected $primaryKey = 'view_company_id';
    // protected $keyType = 'string';

    public $timestamps = false;
    public $incrementing = false;

    public $searching = 'view_product_name';

    protected $filters = [
        'view_company_id',
        'view_location_id',
        'view_product_id',
    ];

    public $rules = [
        'view_company_id' => 'required',
    ];

    public $datatable = [
        'view_company_id' => [false => 'Company'],
        'view_company_name' => [true => 'Company Name'],
        'view_location_id' => [false => 'Location'],
        'view_location_name' => [true => 'Location Name'],
        'view_product_id' => [false => 'Company'],
        'view_product_name' => [true => 'Product Name'],
        'view_register' => [true => 'Register Linen', 'width' => '40'],
        'view_qty' => [true => 'Stock RS', 'width' => '40'],
        'view_cuci' => [true => 'Obsesiman', 'width' => '60'],
        'view_kotor' => [true => 'Kotor', 'width' => '40'],
        'view_retur' => [true => 'Retur', 'width' => '50'],
        'view_rewash' => [true => 'Rewash', 'width' => '50'],
        'view_pending' => [true => 'Pending', 'width' => '50'],
        'view_hilang' => [true => 'Hilang', 'width' => '50'],
    ];

    public function mask_location_id()
    {
        return 'view_location_id';
    }

    public function getMaskLocationIdAttribute()
    {
        return $this->{$this->mask_location_id()};
    }

    public function getMaskLocationNameAttribute()
    {
        return $this->view_location_name;
    }

    // end location

    public function mask_company_id()
    {
        return 'view_company_id';
    }

    public function getMaskCompanyIdAttribute()
    {
        return $this->{$this->mask_company_id()};
    }

    public function getMaskCompanyNameAttribute()
    {
        return $this->view_company_name;
    }

    public function mask_product_id()
    {
        return 'view_product_id';
    }

    public function getMaskProductIdAttribute()
    {
        return $this->{$this->mask_product_id()};
    }

    public function getMaskProductNameAttribute()
    {
        return $this->view_product_name;
    }

    
    public function mask_register()
    {
        return 'view_register';
    }

    public function getMaskRegisterAttribute()
    {
        return $this->{$this->mask_register()};
    }

    public function mask_qty()
    {
        return 'view_qty';
    }

    public function getMaskQtyAttribute()
    {
        return $this->{$this->mask_qty()};
    }

    public function mask_cuci()
    {
        return 'view_cuci';
    }

    public function getMaskCuciAttribute()
    {
        return $this->{$this->mask_cuci()};
    }
    
    public function mask_kotor()
    {
        return 'view_kotor';
    }

    public function getMaskKotorAttribute()
    {
        return $this->{$this->mask_kotor()} ?? 0;
    }

    public function mask_retur()
    {
        return 'view_retur';
    }

    public function getMaskReturAttribute()
    {
        return $this->{$this->mask_retur()} ?? 0;
    }

    public function mask_rewash()
    {
        return 'view_rewash';
    }

    public function getMaskRewashAttribute()
    {
        return $this->{$this->mask_rewash()} ?? 0;
    }

    public function mask_pending()
    {
        return 'view_pending';
    }

    public function getMaskPendingAttribute()
    {
        return $this->{$this->mask_pending()} ?? 0;
    }

    public function mask_hilang()
    {
        return 'view_hilang';
    }

    public function getMaskHilangAttribute()
    {
        return $this->{$this->mask_hilang()} ?? 0;
    }

}
