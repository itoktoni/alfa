<?php

namespace Modules\Linen\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Item\Dao\Facades\LinenFacades;
use Modules\Linen\Dao\Facades\OutstandingFacades;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Wildside\Userstamps\Userstamps;

class MasterOutstanding extends Model
{
    use SoftDeletes, Userstamps;

    protected $table = 'linen_master_outstanding';
    protected $primaryKey = 'linen_master_outstanding_id';

    protected $fillable = [
        'linen_master_outstanding_id',
        'linen_master_outstanding_status',
        'linen_master_outstanding_session',
        'linen_master_outstanding_total',
        'linen_master_outstanding_created_at',
        'linen_master_outstanding_updated_at',
        'linen_master_outstanding_deleted_at',
        'linen_master_outstanding_updated_by',
        'linen_master_outstanding_created_by',
        'linen_master_outstanding_deleted_by',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = true;
    public $rules = [
        'linen_master_outstanding_session' => 'required|unique:linen_master_outstanding',
        'linen_master_outstanding_total' => 'required',
    ];

    const CREATED_AT = 'linen_master_outstanding_created_at';
    const UPDATED_AT = 'linen_master_outstanding_updated_at';
    const DELETED_AT = 'linen_master_outstanding_deleted_at';

    const CREATED_BY = 'linen_master_outstanding_created_by';
    const UPDATED_BY = 'linen_master_outstanding_updated_by';
    const DELETED_BY = 'linen_master_outstanding_deleted_by';

    protected $casts = [
        'linen_master_outstanding_created_at' => 'datetime:Y-m-d H:i:s',
        'linen_master_outstanding_updated_at' => 'datetime:Y-m-d H:i:s',
        'linen_master_outstanding_deleted_at' => 'datetime:Y-m-d H:i:s',
        'linen_master_outstanding_status' => 'string',
        'linen_master_outstanding_total' => 'integer',
    ];

    protected $dates = [
        'linen_master_outstanding_created_at',
        'linen_master_outstanding_updated_at',
        'linen_master_outstanding_deleted_at',
    ];

    public $searching = 'linen_master_outstanding_session';
    public $datatable = [
        'linen_master_outstanding_id' => [true => 'Code', 'width' => 50],
        'linen_master_outstanding_session' => [true => 'Session'],
        'linen_master_outstanding_total' => [true => 'Total'],
        'linen_master_outstanding_created_at' => [true => 'Created At'],
        'linen_master_outstanding_created_by' => [true => 'Created By'],
        'linen_master_outstanding_status' => [true => 'Status', 'width' => 50, 'class' => 'text-center', 'status' => 'status'],
    ];

    public $status = [
        '1' => ['Initial', 'success'],
        '2' => ['Completed', 'primary'],
    ];

    public function status(){
        return $this->status;
    }

    public function getSessionKeyName(){
        return 'linen_master_outstanding_session';
    }

    public function outstanding()
	{
		return $this->hasMany(Outstanding::class, OutstandingFacades::getSessionKeyName(), $this->getSessionKeyName());
    }
    
    public static function boot()
    {
        parent::boot();

        parent::saving(function($model){

            if(empty($model->linen_master_outstanding_status)){
                $model->linen_master_outstanding_status = 1;
            }
        });
    }    
}
