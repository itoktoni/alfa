<?php

namespace Modules\Item\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Modules\Item\Dao\Facades\ProductFacades;
use Modules\Item\Dao\Observers\LinenDetailObserver;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Modules\System\Dao\Models\Location;
use Wildside\Userstamps\Userstamps;
use Illuminate\Validation\Rule;
use Modules\System\Dao\Facades\CompanyFacades;
use Mehradsadeghi\FilterQueryString\FilterQueryString;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Item\Dao\Facades\CompanyProductFacades;
use Modules\Item\Dao\Facades\LinenDetailFacades;
use Modules\Linen\Dao\Enums\LinenStatus;
use Modules\LinenDetail\Dao\Facades\CardFacades;
use Modules\System\Dao\Models\Company;
use Modules\System\Plugins\Cards;

class LinenDetail extends Model
{
    use Userstamps, HasFactory;
    protected $table = 'item_linen_detail';
    protected $primaryKey = 'item_linen_detail_id';

    protected $fillable = [
        'item_linen_detail_id',
        'item_linen_detail_rfid',
        'item_linen_detail_description',
        'item_linen_detail_status',
        'item_linen_detail_created_at',
        'item_linen_detail_updated_at',
        'item_linen_detail_update_by',
        'item_linen_detail_created_by',
        'item_linen_detail_deleted_by',
    ];

    // public $with = ['location', 'product', 'user'];

    public $timestamps = true;
    public $incrementing = true;

    public $rules = [
        'item_linen_detail_status' => 'required',
        'item_linen_detail_rfid' => 'required|unique:item_linen_detail',
    ];

    const CREATED_AT = 'item_linen_detail_created_at';
    const UPDATED_AT = 'item_linen_detail_updated_at';
    const DELETED_AT = 'item_linen_detail_deleted_at';

    const CREATED_BY = 'item_linen_detail_created_by';
    const UPDATED_BY = 'item_linen_detail_updated_by';
    const DELETED_BY = 'item_linen_detail_deleted_by';

    protected $casts = [
        'item_linen_detail_created_at' => 'datetime:Y-m-d H:i:s',
        'item_linen_detail_updated_at' => 'datetime:Y-m-d H:i:s',
        'item_linen_detail_deleted_at' => 'datetime:Y-m-d H:i:s',
        'item_linen_detail_status' => 'integer',
    ];

    protected $dates = [
        'item_linen_detail_created_at',
        'item_linen_detail_updated_at',
        'item_linen_detail_deleted_at',
    ];

    public function mask_status()
    {
        return 'item_linen_detail_status';
    }

    public function setMaskStatusAttribute($value)
    {
        $this->attributes[$this->mask_status()] = $value;
    }

    public function getMaskStatusAttribute()
    {
        return $this->{$this->mask_status()};
    }

    public function mask_description()
    {
        return 'item_linen_detail_description';
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
        return 'item_linen_detail_rfid';
    }

    public function setMaskRfidAttribute($value)
    {
        $this->attributes[$this->mask_rfid()] = $value;
    }

    public function getMaskRfidAttribute()
    {
        return $this->{$this->mask_rfid()};
    }

    public function mask_created_at()
    {
        return 'item_linen_detail_created_at';
    }

    public function setMaskCreatedAtAttribute($value)
    {
        $this->attributes[$this->mask_created_at()] = $value;
    }

    public function getMaskCreatedAtAttribute()
    {
        return $this->{$this->mask_created_at()};
    }

    public static function boot()
    {
        parent::boot();
        parent::saving(function ($model) {
            if(empty($model->item_linen_detail_description)){
                
                $model->item_linen_detail_description = LinenStatus::getDescription($model->mask_status);
            }
        });
    }
}
