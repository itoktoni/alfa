<?php

namespace Modules\System\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\System\Dao\Facades\CompanyConnectionLocationFacades;

class Location extends Model
{
    protected $table = 'system_location';
    protected $primaryKey = 'location_id';

    protected $fillable = [
        'location_id',
        'location_name',
        'location_description',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = false;
    public $rules = [
        'location_name' => 'required|min:3',
    ];

    const CREATED_AT = 'location_created_at';
    const UPDATED_AT = 'location_created_by';

    public $searching = 'location_name';
    public $datatable = [
        'location_id' => [false => 'Code'],
        'location_name' => [true => 'Location Name'],
        'location_description' => [true => 'Description'],
    ];
    
    public $show    = [
        '1' => ['Show', 'info'],
        '0' => ['Hide', 'warning'],
    ];

    public function company()
	{
		return $this->belongsToMany(Company::class, CompanyConnectionLocationFacades::getTable(), CompanyConnectionLocationFacades::getForeignKey(), CompanyConnectionLocationFacades::getKeyName());
	}
}

