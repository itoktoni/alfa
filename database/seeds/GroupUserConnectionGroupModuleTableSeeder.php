<?php

use Illuminate\Database\Seeder;

class GroupUserConnectionGroupModuleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('group_user_connection_group_module')->delete();
        
        \DB::table('group_user_connection_group_module')->insert(array (
            0 => 
            array (
                'conn_gu_group_module' => 'sales',
                'conn_gu_group_user' => 'sales',
            ),
            1 => 
            array (
                'conn_gu_group_module' => 'supplier',
                'conn_gu_group_user' => 'supplier',
            ),
            2 => 
            array (
                'conn_gu_group_module' => 'finance',
                'conn_gu_group_user' => 'finance',
            ),
            3 => 
            array (
                'conn_gu_group_module' => 'waewhouse',
                'conn_gu_group_user' => 'warehouse',
            ),
            4 => 
            array (
                'conn_gu_group_module' => 'owner',
                'conn_gu_group_user' => 'owner',
            ),
            5 => 
            array (
                'conn_gu_group_module' => 'production',
                'conn_gu_group_user' => 'production',
            ),
            6 => 
            array (
                'conn_gu_group_module' => 'group',
                'conn_gu_group_user' => 'test',
            ),
            7 => 
            array (
                'conn_gu_group_module' => 'admin',
                'conn_gu_group_user' => 'developer',
            ),
            8 => 
            array (
                'conn_gu_group_module' => 'master',
                'conn_gu_group_user' => 'developer',
            ),
            9 => 
            array (
                'conn_gu_group_module' => 'system',
                'conn_gu_group_user' => 'developer',
            ),
            10 => 
            array (
                'conn_gu_group_module' => 'waewhouse',
                'conn_gu_group_user' => 'developer',
            ),
            11 => 
            array (
                'conn_gu_group_module' => 'master',
                'conn_gu_group_user' => 'master',
            ),
            12 => 
            array (
                'conn_gu_group_module' => 'admin',
                'conn_gu_group_user' => 'admin',
            ),
            13 => 
            array (
                'conn_gu_group_module' => 'master',
                'conn_gu_group_user' => 'admin',
            ),
        ));
        
        
    }
}