<?php

namespace Modules\System\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\System\Dao\Facades\ActionFacades;
use Modules\System\Dao\Facades\GroupModuleConnectionModuleFacades;
use Modules\System\Dao\Facades\ModuleConnectionActionFacades;
use Modules\System\Dao\Facades\ModuleFacades;

class Module extends Model
{
	protected $table = 'system_module';
	protected $primaryKey = 'system_module_code';
	protected $groupModuleKey = 'system_module_folder';
	protected $fillable = [
		'system_module_code',
		'system_module_name',
		'system_module_description',
		'system_module_link',
		'system_module_controller',
		'system_module_filters',
		'system_module_sort',
		'system_module_show',
		'system_module_enable',
		'system_module_module',
		'system_module_folder',
		'system_module_path',
		'system_module_api',
	];
	public $incrementing = false;
	public $timestamps = false;
	public $rules = [
		'system_module_code' => 'required|unique:system_module|min:3',
		'system_module_name' => 'required|min:3',
		'system_module_controller' => 'required|min:3',
	];
	
	public function getGroupModuleKeyName(){
		return $this->groupModuleKey;
	}

	public $searching = 'system_module_name';

	public $datatable = [
		'system_module_code'           => [true => 'Code'],
		'system_module_name'           => [true => 'Name'],
		'system_module_link'           => [false => 'Link'],
		'system_module_controller'     => [true => 'Controller'],
		'system_module_folder'       => [true => 'Folder'],
		'system_module_show'       => [true => 'Show', 'width' => 100, 'class' => 'text-center'],
		'system_module_enable'       => [true => 'Active', 'width' => 100, 'class' => 'text-center'],
	];

	public $status = [
		'1' => ['Active', 'primary'],
		'0' => ['Not Active', 'danger'],
	];

	public function action(){

		return $this->hasMany(Action::class, ActionFacades::getModuleKeyName(), ModuleFacades::getKeyName());
	}

	public function connection_action()
	{
		return $this->belongsToMany(Action::class, ModuleConnectionActionFacades::getTable(), ModuleFacades::getKeyName(), ActionFacades::getKeyName());
	}

	public function connection_group_module()
	{
		return $this->belongsToMany(GroupModule::class, GroupModuleConnectionModuleFacades::getTable(), GroupModuleConnectionModuleFacades::getForeignKey(), GroupModuleConnectionModuleFacades::getPrimaryKey());
	}

	public static function boot()
	{
		parent::boot();
		parent::saving(function($model){
			if(empty($model->system_module_sort)){
				$model->system_module_sort = 0;
			}
		});
	}
}