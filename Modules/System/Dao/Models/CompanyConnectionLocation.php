<?php

namespace Modules\System\Dao\Models;

use Illuminate\Database\Eloquent\Model;

class CompanyConnectionLocation extends Model
{
	protected $table = 'system_company_connection_location';
	protected $primaryKey = 'company_id';
	public $foreignKey = 'location_id';
	protected $fillable = [
		'company_id',
		'location_id',

	];
	public $incrementing = false;
	public $timestamps = false;	

	
	public function getForeignKey()
	{
		return $this->foreignKey;
	}

	public function getPrimaryKey()
	{
		return $this->primaryKey;
	}
}
