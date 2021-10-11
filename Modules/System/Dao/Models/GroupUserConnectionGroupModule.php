<?php

namespace Modules\System\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\System\Dao\Facades\GroupModuleFacades;
use Modules\System\Dao\Facades\ModuleFacades;

class GroupUserConnectionGroupModule extends Model
{
	protected $table = 'system_group_user_connection_group_module';
	protected $primaryKey = 'system_group_user_code';
	public $foreignKey = 'system_group_module_code';
	protected $fillable = [
		'system_group_user_code',
		'system_group_module_code',

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

	public function group_module(){

		return $this->hasMany(GroupModule::class, GroupModuleFacades::getKeyName(), GroupModuleFacades::getKeyName());
	}
}
