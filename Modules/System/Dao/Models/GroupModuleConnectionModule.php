<?php

namespace Modules\System\Dao\Models;

use Illuminate\Database\Eloquent\Model;

class GroupModuleConnectionModule extends Model
{
	protected $table = 'system_group_module_connection_module';
	protected $primaryKey = 'system_group_module_code';
	public $foreignKey = 'system_module_code';
	protected $fillable = [
		'system_group_module_code',
		'system_module_code',
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
