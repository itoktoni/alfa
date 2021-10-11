<?php

namespace Modules\System\Dao\Models;

use Illuminate\Database\Eloquent\Model;

class ModuleConnectionAction extends Model
{
	protected $table = 'system_module_connection_action';
	protected $primaryKey = 'system_module_code';
	protected $foreignKey = 'system_action_code';
	protected $fillable = [
		'system_module_code',
		'system_action_code',
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
