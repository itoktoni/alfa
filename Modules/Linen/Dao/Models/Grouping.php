<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Linen\Events\CreateGroupingEvent;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Wildside\Userstamps\Userstamps;

class Grouping extends Model
{
    use Userstamps;

    protected $table = 'linen_grouping';
    protected $primaryKey = 'linen_grouping_barcode';
    protected $keyType = 'string';

    protected $fillable = [
        'linen_grouping_id',
        'linen_grouping_status',
        'linen_grouping_total',
        'linen_grouping_created_at',
        'linen_grouping_updated_at',
        'linen_grouping_deleted_at',
        'linen_grouping_updated_by',
        'linen_grouping_created_by',
        'linen_grouping_deleted_by',
        'linen_grouping_barcode',
        'linen_grouping_delivery',
        'linen_grouping_company_id',
        'linen_grouping_company_name',
        'linen_grouping_location_id',
        'linen_grouping_location_name',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'linen_grouping_barcode' => 'required|unique:linen_grouping',
        'linen_grouping_location_id' => 'required|unique:system_location',
        'linen_grouping_company_id' => 'required|unique:system_company',
        'rfid' => 'required',
    ];

    const CREATED_AT = 'linen_grouping_created_at';
    const UPDATED_AT = 'linen_grouping_updated_at';
    const DELETED_AT = 'linen_grouping_deleted_at';

    const CREATED_BY = 'linen_grouping_created_by';
    const UPDATED_BY = 'linen_grouping_updated_by';
    const DELETED_BY = 'linen_grouping_deleted_by';

    protected $casts = [
        'linen_grouping_created_at' => 'datetime:Y-m-d H:i:s',
        'linen_grouping_updated_at' => 'datetime:Y-m-d H:i:s',
        'linen_grouping_deleted_at' => 'datetime:Y-m-d H:i:s',
        'linen_grouping_status' => 'string',
        'linen_grouping_total' => 'integer',
    ];

    protected $dates = [
        'linen_grouping_created_at',
        'linen_grouping_updated_at',
        'linen_grouping_deleted_at',
    ];

    public $searching = 'linen_grouping_barcode';
    public $datatable = [
        'linen_grouping_id' => [false => 'Code', 'width' => 50],
        'linen_grouping_delivery' => [true => 'Delivery'],
        'linen_grouping_barcode' => [true => 'Barcode'],
        'linen_grouping_company_name' => [true => 'Company'],
        'linen_grouping_location_name' => [true => 'Location'],
        'linen_grouping_total' => [true => 'Total'],
        'linen_grouping_created_at' => [true => 'Created At'],
        'name' => [true => 'Created By'],
        'linen_grouping_status' => [false => 'Status', 'width' => 50, 'class' => 'text-center', 'status' => 'status'],
    ];

    public $status = [
        '1' => ['Initial', 'success'],
        '2' => ['Completed', 'primary'],
    ];

    public function status(){
        return $this->status;
    }

    public function has_user(){

		return $this->hasOne(User::class, TeamFacades::getKeyName(), self::CREATED_BY);
    }

    public function has_detail(){

		return $this->hasMany(GroupingDetail::class, 'linen_grouping_detail_barcode', 'linen_grouping_barcode');
    }
    
    public static function boot()
    {
        parent::boot();

        // parent::saving(function($model){

        //     $company = $model->linen_grouping_company_id;
        //     $model->linen_grouping_company_name = CompanyFacades::find($company)->company_name ?? '';

        //     $location = $model->linen_grouping_location_id;
        //     $model->linen_grouping_location_name = LocationFacades::find($location)->location_name ?? '';

        // });

        parent::saved(function($model){

            CreateGroupingEvent::dispatch($model->{$model->getKeyName()});

        });
    }    
}
