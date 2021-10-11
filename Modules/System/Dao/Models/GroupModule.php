<?php

namespace Modules\System\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\System\Dao\Facades\GroupModuleConnectionModuleFacades;
use Modules\System\Dao\Facades\GroupModuleFacades;
use Modules\System\Dao\Facades\GroupUserConnectionGroupModuleFacades;
use Modules\System\Dao\Facades\GroupUserFacades;
use Modules\System\Dao\Facades\ModuleFacades;

class GroupModule extends Model
{
    protected $table = 'system_group_module';
    protected $primaryKey = 'system_group_module_code';
    protected $GroupModuleKey = 'system_group_module_folder';
    protected $fillable = [
        'system_group_module_code',
        'system_group_module_name',
        'system_group_module_link',
        'system_group_module_sort',
        'system_group_module_visible',
        'system_group_module_enable',
        'system_group_module_modular',
        'system_group_module_folder',
        'system_group_module_description',
    ];

    public function getGroupModuleKeyName(){
        return $this->GroupModuleKey;
    }
    public $timestamps = false;
    public $incrementing = true;
    public $rules = [
        'system_group_module_code' => 'required|min:3|unique:system_group_module',
        'system_group_module_name' => 'required|min:3',
    ];

    public $searching = 'system_group_module_name';
    public $status    = [
        '1' => ['Enable', 'primary'],
        '0' => ['Disable', 'danger'],
    ];

    protected $casts = [
        'system_group_module_code' => 'string',
        'system_group_module_sort' => 'integer'
    ];

    public $datatable = [
        'system_group_module_code'        => [true => 'Code'],
        'system_group_module_name'        => [true => 'Name'],
        'system_group_module_link'        => [false => 'Link'],
        'system_group_module_description' => [true => 'Description'],
        'system_group_module_folder'      => [true => 'Folder'],
        'system_group_module_enable'      => [true => 'Active', 'width' => '100', 'class' => 'text-center'],
    ];

    public function connection_module()
	{
		return $this->belongsToMany(Module::class, GroupModuleConnectionModuleFacades::getTable(), GroupModuleFacades::getKeyName(), ModuleFacades::getKeyName());
    }
    
    public function connection_group_user()
	{
		return $this->belongsToMany(GroupUser::class, GroupUserConnectionGroupModuleFacades::getTable(), GroupModuleFacades::getKeyName(), GroupUserFacades::getKeyName());
	}

    public function module()
    {
        return $this->hasMany(Module::class, ModuleFacades::getGroupModuleKeyName(), $this->getGroupModuleKeyName());
    }

    public function scopeActive()
    {
        return $this->modules()->where('system_module_enable', 1);
    }

    public static function boot()
    {
        parent::boot();
        parent::saving(function ($model) {

            if(request()->get('system_group_module_code')){
                $model->system_group_module_code = request()->get('system_group_module_code');
            }
            if (empty($model->system_group_module_sort)) {
                $model->system_group_module_sort = 0;
            }
            if ($model->system_group_module_folder) {
                $model->system_group_module_modular = 1;
            }
            $model->system_group_module_folder = ucfirst($model->system_group_module_folder);
            $model->system_group_module_name = strtoupper($model->system_group_module_name);
            $model->system_group_module_link = $model->system_group_module_code;
        });
    }
    
}
