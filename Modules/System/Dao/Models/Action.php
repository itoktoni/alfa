<?php

namespace Modules\System\Dao\Models;

use App\Dao\Facades\GroupModuleFacades;
use Illuminate\Database\Eloquent\Model;
use Modules\System\Dao\Facades\ActionFacades;
use Modules\System\Dao\Facades\ModuleConnectionActionFacades;
use Modules\System\Dao\Facades\ModuleFacades;

class Action extends Model
{
    protected $table = 'system_action';
    protected $primaryKey = 'system_action_code';
    protected $action_function = 'system_action_function';
    protected $moduleKey = 'system_action_module';

    protected $fillable = [
        'system_action_code',
        'system_action_module',
        'system_action_name',
        'system_action_description',
        'system_action_link',
        'system_action_controller',
        'system_action_function',
        'system_action_sort',
        'system_action_show',
        'system_action_enable',
        'system_action_path',
        'system_action_method',
        'system_action_api',
    ];

    // public $with = ['module'];

    public $timestamps = false;
    public $incrementing = false;
    public $rules = [
        'system_action_code' => 'required|unique:system_action',
        'system_action_name' => 'required|min:3',
    ];

    const CREATED_AT = 'system_action_created_at';
    const UPDATED_AT = 'system_action_created_by';

    public $searching = 'system_action_name';
    public $datatable = [
        'system_action_code' => [true => 'Code'],
        'system_action_name' => [true => 'Name'],
        'system_action_link' => [false => 'Link'],
        'system_action_controller' => [true => 'Controller'],
        'system_action_function' => [false => 'Function'],
        'system_action_enable' => [false => 'Enable', 'width' => '100', 'class' => 'text-center'],
        'system_action_show' => [true => 'Show', 'width' => '100', 'class' => 'text-center'],
        'system_action_api' => [true => 'Api', 'width' => '100', 'class' => 'text-center'],
    ];
    
    public $show    = [
        '1' => ['Show', 'info'],
        '0' => ['Hide', 'warning'],
    ];

    public $enable    = [
        '1' => ['Enable', 'info'],
        '0' => ['Disable', 'default'],
    ];

    public $api = [
        '1' => ['Active', 'success'],
        '0' => ['Not Active', 'danger'],
    ];

    public function getFunctionName(){
        return $this->action_function;
    }

    public function connection_module()
	{
		return $this->belongsToMany(Module::class, ModuleConnectionActionFacades::getTable(), ModuleFacades::getKeyName(), ActionFacades::getKeyName());
	}

    public function getModuleKeyName(){
        return $this->moduleKey;
    }

}
