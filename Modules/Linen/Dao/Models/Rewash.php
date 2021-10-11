<?php

namespace Modules\Linen\Dao\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\System\Dao\Facades\CompanyFacades;
use Modules\System\Dao\Facades\LocationFacades;
use Modules\System\Dao\Facades\TeamFacades;
use Wildside\Userstamps\Userstamps;

class Rewash extends Model
{
    use SoftDeletes, Userstamps;

    protected $table = 'linen_rewash';
    protected $primaryKey = 'linen_rewash_key';
    protected $keyType = 'string';

    protected $fillable = [
        'linen_rewash_id',
        'linen_rewash_total',
        'linen_rewash_status',
        'linen_rewash_created_at',
        'linen_rewash_updated_at',
        'linen_rewash_deleted_at',
        'linen_rewash_updated_by',
        'linen_rewash_created_by',
        'linen_rewash_deleted_by',
        'linen_rewash_key',
        'linen_rewash_company_id',
        'linen_rewash_company_name',
        'linen_rewash_location_id',
        'linen_rewash_location_name',
    ];

    // public $with = ['module'];

    public $timestamps = true;
    public $incrementing = false;
    public $rules = [
        'linen_rewash_key' => 'required|unique:linen_rewash',
        'linen_rewash_company_id' => 'required|unique:system_company',
        'linen_rewash_status' => 'required|in:1,2',
        'rfid' => 'required',
    ];

    const CREATED_AT = 'linen_rewash_created_at';
    const UPDATED_AT = 'linen_rewash_updated_at';
    const DELETED_AT = 'linen_rewash_deleted_at';

    const CREATED_BY = 'linen_rewash_created_by';
    const UPDATED_BY = 'linen_rewash_updated_by';
    const DELETED_BY = 'linen_rewash_deleted_by';

    protected $casts = [
        'linen_rewash_created_at' => 'datetime:Y-m-d H:i:s',
        'linen_rewash_updated_at' => 'datetime:Y-m-d H:i:s',
        'linen_rewash_deleted_at' => 'datetime:Y-m-d H:i:s',
        'linen_rewash_status' => 'string',
        'linen_rewash_total' => 'integer',
    ];

    protected $dates = [
        'linen_rewash_created_at',
        'linen_rewash_updated_at',
        'linen_rewash_deleted_at',
    ];

    public $searching = 'linen_rewash_key';
    public $datatable = [
        'linen_rewash_id' => [false => 'Code', 'width' => 50],
        'linen_rewash_key' => [true => 'No. Rewash'],
        'linen_rewash_company_name' => [true => 'Company'],
        'linen_rewash_location_name' => [true => 'Location'],
        'linen_rewash_total' => [true => 'Total'],
        'linen_rewash_created_by' => [false => 'Created At'],
        'linen_rewash_created_at' => [true => 'Created At'],
        'name' => [true => 'Created By'],
        'linen_rewash_status' => [true => 'Status', 'width' => 80, 'class' => 'text-center'],
    ];

    public $status = [
        '7' => ['Bernoda', 'success'],
        '8' => ['Bahan Usang', 'primary'],
    ];

    public function status(){
        return $this->status;
    }

    public function user(){

		return $this->hasOne(User::class, TeamFacades::getKeyName(), self::CREATED_BY);
    }

    public function detail(){

		return $this->hasMany(RewashDetail::class, 'linen_rewash_detail_key', 'linen_rewash_key');
    }
    
    public static function boot()
    {
        parent::boot();

        parent::saving(function($model){

            $company = $model->linen_rewash_company_id;
            $model->linen_rewash_company_name = CompanyFacades::find($company)->company_name ?? '';
            
        });
    }    
}
