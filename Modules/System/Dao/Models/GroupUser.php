<?php

namespace Modules\System\Dao\Models;

use Illuminate\Database\Eloquent\Model;
use Modules\System\Dao\Facades\GroupModuleFacades;
use Modules\System\Dao\Facades\GroupUserConnectionGroupModuleFacades;
use Modules\System\Dao\Facades\GroupUserFacades;
use Modules\System\Dao\Models\GroupUserConnectionGroupModule;

class GroupUser extends Model
{
    protected $table      = 'system_group_user';
    protected $primaryKey = 'system_group_user_code';
    protected $fillable = [
        'system_group_user_code',
        'system_group_user_name',
        'system_group_user_description',
        'system_group_user_show',
        'system_group_user_level',
        'system_group_user_dashboard',
    ];
    public $timestamps   = false;
    public $incrementing = false;
    public $rules        = [
        'system_group_user_code' => 'required|min:3|unique:system_group_user',
        'system_group_user_name' => 'required',
    ];

    protected $keyType = 'string';

    public function scopeById($query, $id)
    {
        return $query->where('system_group_user_code', $id);
    }

    public $datatable = [
        'system_group_user_code'        => [true => 'Code'],
        'system_group_user_name'        => [true => 'Name'],
        'system_group_user_dashboard'   => [true => 'Dashboard'],
        'system_group_user_description' => [true => 'Description'],
    ];

    public $searching = 'system_group_user_name'; //searching default

    public function connection_group_module()
	{
		return $this->belongsToMany(GroupModule::class, GroupUserConnectionGroupModuleFacades::getTable(), GroupUserFacades::GetKeyName(), GroupModuleFacades::getKeyName())->withPivot('system_group_user_code');
    }
}
