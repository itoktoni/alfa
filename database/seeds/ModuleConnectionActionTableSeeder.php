<?php

use Illuminate\Database\Seeder;

class ModuleConnectionActionTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('module_connection_action')->delete();
        
        \DB::table('module_connection_action')->insert(array (
            0 => 
            array (
                'conn_ma_module' => 'configuration',
                'conn_ma_action' => 'configuration_create',
            ),
            1 => 
            array (
                'conn_ma_module' => 'configuration',
                'conn_ma_action' => 'configuration_read',
            ),
            2 => 
            array (
                'conn_ma_module' => 'configuration',
                'conn_ma_action' => 'configuration_update',
            ),
            3 => 
            array (
                'conn_ma_module' => 'configuration',
                'conn_ma_action' => 'configuration_delete',
            ),
            4 => 
            array (
                'conn_ma_module' => 'action',
                'conn_ma_action' => 'action_create',
            ),
            5 => 
            array (
                'conn_ma_module' => 'action',
                'conn_ma_action' => 'action_list',
            ),
            6 => 
            array (
                'conn_ma_module' => 'action',
                'conn_ma_action' => 'action_update',
            ),
            7 => 
            array (
                'conn_ma_module' => 'action',
                'conn_ma_action' => 'action_delete',
            ),
            8 => 
            array (
                'conn_ma_module' => 'group_module',
                'conn_ma_action' => 'group_module_create',
            ),
            9 => 
            array (
                'conn_ma_module' => 'group_module',
                'conn_ma_action' => 'group_module_list',
            ),
            10 => 
            array (
                'conn_ma_module' => 'group_module',
                'conn_ma_action' => 'group_module_update',
            ),
            11 => 
            array (
                'conn_ma_module' => 'group_module',
                'conn_ma_action' => 'group_module_delete',
            ),
            12 => 
            array (
                'conn_ma_module' => 'group_user',
                'conn_ma_action' => 'group_user_create',
            ),
            13 => 
            array (
                'conn_ma_module' => 'group_user',
                'conn_ma_action' => 'group_user_list',
            ),
            14 => 
            array (
                'conn_ma_module' => 'group_user',
                'conn_ma_action' => 'group_user_update',
            ),
            15 => 
            array (
                'conn_ma_module' => 'group_user',
                'conn_ma_action' => 'group_user_delete',
            ),
            16 => 
            array (
                'conn_ma_module' => 'master_team',
                'conn_ma_action' => 'master_team_create',
            ),
            17 => 
            array (
                'conn_ma_module' => 'master_team',
                'conn_ma_action' => 'master_team_list',
            ),
            18 => 
            array (
                'conn_ma_module' => 'master_team',
                'conn_ma_action' => 'master_team_update',
            ),
            19 => 
            array (
                'conn_ma_module' => 'module',
                'conn_ma_action' => 'module_create',
            ),
            20 => 
            array (
                'conn_ma_module' => 'module',
                'conn_ma_action' => 'module_list',
            ),
            21 => 
            array (
                'conn_ma_module' => 'module',
                'conn_ma_action' => 'module_update',
            ),
            22 => 
            array (
                'conn_ma_module' => 'module',
                'conn_ma_action' => 'module_delete',
            ),
            23 => 
            array (
                'conn_ma_module' => 'team',
                'conn_ma_action' => 'team_create',
            ),
            24 => 
            array (
                'conn_ma_module' => 'team',
                'conn_ma_action' => 'team_list',
            ),
            25 => 
            array (
                'conn_ma_module' => 'team',
                'conn_ma_action' => 'team_update',
            ),
            26 => 
            array (
                'conn_ma_module' => 'team',
                'conn_ma_action' => 'team_delete',
            ),
        ));
        
        
    }
}