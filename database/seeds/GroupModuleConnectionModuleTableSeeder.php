<?php

use Illuminate\Database\Seeder;

class GroupModuleConnectionModuleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('group_module_connection_module')->delete();
        
        \DB::table('group_module_connection_module')->insert(array (
            0 => 
            array (
                'conn_gm_group_module' => 'home',
                'conn_gm_module' => 'home',
            ),
            1 => 
            array (
                'conn_gm_group_module' => 'sales',
                'conn_gm_module' => 'home',
            ),
            2 => 
            array (
                'conn_gm_group_module' => 'system',
                'conn_gm_module' => 'group_user',
            ),
            3 => 
            array (
                'conn_gm_group_module' => 'system',
                'conn_gm_module' => 'group_module',
            ),
            4 => 
            array (
                'conn_gm_group_module' => 'system',
                'conn_gm_module' => 'module',
            ),
            5 => 
            array (
                'conn_gm_group_module' => 'master',
                'conn_gm_module' => 'master_team',
            ),
            6 => 
            array (
                'conn_gm_group_module' => 'system',
                'conn_gm_module' => 'team',
            ),
            7 => 
            array (
                'conn_gm_group_module' => 'system',
                'conn_gm_module' => 'action',
            ),
            8 => 
            array (
                'conn_gm_group_module' => 'master',
                'conn_gm_module' => 'product',
            ),
            9 => 
            array (
                'conn_gm_group_module' => 'system',
                'conn_gm_module' => 'site',
            ),
            10 => 
            array (
                'conn_gm_group_module' => 'master',
                'conn_gm_module' => 'slider',
            ),
            11 => 
            array (
                'conn_gm_group_module' => 'master',
                'conn_gm_module' => 'sosmed',
            ),
            12 => 
            array (
                'conn_gm_group_module' => 'master',
                'conn_gm_module' => 'contact',
            ),
            13 => 
            array (
                'conn_gm_group_module' => 'master',
                'conn_gm_module' => 'solution',
            ),
            14 => 
            array (
                'conn_gm_group_module' => 'master',
                'conn_gm_module' => 'tag',
            ),
            15 => 
            array (
                'conn_gm_group_module' => 'master',
                'conn_gm_module' => 'category',
            ),
        ));
        
        
    }
}