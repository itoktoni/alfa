<?php

use Illuminate\Database\Seeder;

class ActionsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('actions')->delete();
        
        \DB::table('actions')->insert(array (
            0 => 
            array (
                'action_code' => 'action_create',
                'action_module' => NULL,
                'action_name' => 'Create Action',
                'action_description' => NULL,
                'action_link' => 'action/create',
                'action_controller' => 'Action',
                'action_function' => 'create',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            1 => 
            array (
                'action_code' => 'action_delete',
                'action_module' => NULL,
                'action_name' => 'Delete Action',
                'action_description' => NULL,
                'action_link' => 'action/delete',
                'action_controller' => 'Action',
                'action_function' => 'delete',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            2 => 
            array (
                'action_code' => 'action_list',
                'action_module' => NULL,
                'action_name' => 'List Action',
                'action_description' => NULL,
                'action_link' => 'action/list',
                'action_controller' => 'Action',
                'action_function' => 'list',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            3 => 
            array (
                'action_code' => 'action_update',
                'action_module' => NULL,
                'action_name' => 'Update Action',
                'action_description' => NULL,
                'action_link' => 'action/update',
                'action_controller' => 'Action',
                'action_function' => 'update',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            4 => 
            array (
                'action_code' => 'config_configuration',
                'action_module' => NULL,
                'action_name' => 'System',
                'action_description' => '',
                'action_link' => 'config/configuration',
                'action_controller' => 'Home',
                'action_function' => 'configuration',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            5 => 
            array (
                'action_code' => 'configuration_create',
                'action_module' => NULL,
                'action_name' => 'Configuration Create',
                'action_description' => NULL,
                'action_link' => 'configuration/create',
                'action_controller' => 'Configuration',
                'action_function' => 'create',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            6 => 
            array (
                'action_code' => 'configuration_delete',
                'action_module' => NULL,
                'action_name' => 'Configuration Delete',
                'action_description' => NULL,
                'action_link' => 'configuration/delete',
                'action_controller' => 'Configuration',
                'action_function' => 'delete',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            7 => 
            array (
                'action_code' => 'configuration_read',
                'action_module' => NULL,
                'action_name' => 'Configuration Read',
                'action_description' => NULL,
                'action_link' => 'configuration/read',
                'action_controller' => 'Configuration',
                'action_function' => 'read',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            8 => 
            array (
                'action_code' => 'configuration_update',
                'action_module' => NULL,
                'action_name' => 'Configuration Update',
                'action_description' => NULL,
                'action_link' => 'configuration/update',
                'action_controller' => 'Configuration',
                'action_function' => 'update',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            9 => 
            array (
                'action_code' => 'group_module_create',
                'action_module' => NULL,
                'action_name' => 'Create Group Module',
                'action_description' => NULL,
                'action_link' => 'group_module/create',
                'action_controller' => 'GroupModule',
                'action_function' => 'create',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            10 => 
            array (
                'action_code' => 'group_module_delete',
                'action_module' => NULL,
                'action_name' => 'Delete Group Module',
                'action_description' => NULL,
                'action_link' => 'group_module/delete',
                'action_controller' => 'GroupModule',
                'action_function' => 'delete',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            11 => 
            array (
                'action_code' => 'group_module_list',
                'action_module' => NULL,
                'action_name' => 'List Group Module',
                'action_description' => NULL,
                'action_link' => 'group_module/list',
                'action_controller' => 'GroupModule',
                'action_function' => 'list',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            12 => 
            array (
                'action_code' => 'group_module_update',
                'action_module' => NULL,
                'action_name' => 'Update Group Module',
                'action_description' => NULL,
                'action_link' => 'group_module/update',
                'action_controller' => 'GroupModule',
                'action_function' => 'update',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            13 => 
            array (
                'action_code' => 'group_user_create',
                'action_module' => NULL,
                'action_name' => 'Create Group User',
                'action_description' => NULL,
                'action_link' => 'group_user/create',
                'action_controller' => 'GroupUser',
                'action_function' => 'create',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            14 => 
            array (
                'action_code' => 'group_user_delete',
                'action_module' => NULL,
                'action_name' => 'Delete Group User',
                'action_description' => NULL,
                'action_link' => 'group_user/delete',
                'action_controller' => 'GroupUser',
                'action_function' => 'delete',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            15 => 
            array (
                'action_code' => 'group_user_list',
                'action_module' => NULL,
                'action_name' => 'List Group User',
                'action_description' => NULL,
                'action_link' => 'group_user/list',
                'action_controller' => 'GroupUser',
                'action_function' => 'list',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            16 => 
            array (
                'action_code' => 'group_user_update',
                'action_module' => NULL,
                'action_name' => 'Update Group User',
                'action_description' => NULL,
                'action_link' => 'group_user/update',
                'action_controller' => 'GroupUser',
                'action_function' => 'update',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            17 => 
            array (
                'action_code' => 'master_team_create',
                'action_module' => NULL,
                'action_name' => 'Create Master Team',
                'action_description' => NULL,
                'action_link' => 'master_team/create',
                'action_controller' => 'Team',
                'action_function' => 'create',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            18 => 
            array (
                'action_code' => 'master_team_delete',
                'action_module' => NULL,
                'action_name' => 'Delete Master Team',
                'action_description' => NULL,
                'action_link' => 'master_team/delete',
                'action_controller' => 'Team',
                'action_function' => 'delete',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            19 => 
            array (
                'action_code' => 'master_team_list',
                'action_module' => NULL,
                'action_name' => 'List Master Team',
                'action_description' => NULL,
                'action_link' => 'master_team/list',
                'action_controller' => 'Team',
                'action_function' => 'list',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            20 => 
            array (
                'action_code' => 'master_team_update',
                'action_module' => NULL,
                'action_name' => 'Update Master Team',
                'action_description' => NULL,
                'action_link' => 'master_team/update',
                'action_controller' => 'Team',
                'action_function' => 'update',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            21 => 
            array (
                'action_code' => 'module_create',
                'action_module' => NULL,
                'action_name' => 'Create Module',
                'action_description' => NULL,
                'action_link' => 'module/create',
                'action_controller' => 'Module',
                'action_function' => 'create',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            22 => 
            array (
                'action_code' => 'module_delete',
                'action_module' => NULL,
                'action_name' => 'Delete Module',
                'action_description' => NULL,
                'action_link' => 'module/delete',
                'action_controller' => 'Module',
                'action_function' => 'delete',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            23 => 
            array (
                'action_code' => 'module_list',
                'action_module' => NULL,
                'action_name' => 'List Module',
                'action_description' => NULL,
                'action_link' => 'module/list',
                'action_controller' => 'Module',
                'action_function' => 'list',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            24 => 
            array (
                'action_code' => 'module_update',
                'action_module' => NULL,
                'action_name' => 'Update Module',
                'action_description' => NULL,
                'action_link' => 'module/update',
                'action_controller' => 'Module',
                'action_function' => 'update',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            25 => 
            array (
                'action_code' => 'team_create',
                'action_module' => NULL,
                'action_name' => 'Create Team',
                'action_description' => NULL,
                'action_link' => 'team/create',
                'action_controller' => 'Team',
                'action_function' => 'create',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            26 => 
            array (
                'action_code' => 'team_delete',
                'action_module' => NULL,
                'action_name' => 'Delete Team',
                'action_description' => NULL,
                'action_link' => 'team/delete',
                'action_controller' => 'Team',
                'action_function' => 'delete',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            27 => 
            array (
                'action_code' => 'team_list',
                'action_module' => NULL,
                'action_name' => 'List Team',
                'action_description' => NULL,
                'action_link' => 'team/list',
                'action_controller' => 'Team',
                'action_function' => 'list',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            28 => 
            array (
                'action_code' => 'team_update',
                'action_module' => NULL,
                'action_name' => 'Update Team',
                'action_description' => NULL,
                'action_link' => 'team/update',
                'action_controller' => 'Team',
                'action_function' => 'update',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            29 => 
            array (
                'action_code' => 'user_create',
                'action_module' => NULL,
                'action_name' => 'User Create',
                'action_description' => 'for create User',
                'action_link' => 'user/create',
                'action_controller' => 'User',
                'action_function' => 'create',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            30 => 
            array (
                'action_code' => 'user_delete',
                'action_module' => NULL,
                'action_name' => 'User Delete',
                'action_description' => 'for delete User',
                'action_link' => 'user/delete',
                'action_controller' => 'User',
                'action_function' => 'delete',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
            31 => 
            array (
                'action_code' => 'user_read',
                'action_module' => NULL,
                'action_name' => 'User Read',
                'action_description' => 'for read User',
                'action_link' => 'user/read',
                'action_controller' => 'User',
                'action_function' => 'read',
                'action_sort' => 0,
                'action_visible' => '1',
                'action_enable' => '1',
            ),
            32 => 
            array (
                'action_code' => 'user_update',
                'action_module' => NULL,
                'action_name' => 'User Update',
                'action_description' => 'for update User',
                'action_link' => 'user/update',
                'action_controller' => 'User',
                'action_function' => 'update',
                'action_sort' => 0,
                'action_visible' => '0',
                'action_enable' => '1',
            ),
        ));
        
        
    }
}