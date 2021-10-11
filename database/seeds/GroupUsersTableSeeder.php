<?php

use Illuminate\Database\Seeder;

class GroupUsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('group_users')->delete();
        
        \DB::table('group_users')->insert(array (
            0 => 
            array (
                'group_user_code' => 'admin',
                'group_user_name' => 'ADMINISTRATOR',
                'group_user_description' => '',
                'group_user_visible' => '1',
                'group_user_level' => NULL,
                'group_user_dashboard' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            1 => 
            array (
                'group_user_code' => 'developer',
                'group_user_name' => 'DEVELOPER',
                'group_user_description' => 'for programming only, can not other user',
                'group_user_visible' => '1',
                'group_user_level' => NULL,
                'group_user_dashboard' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            2 => 
            array (
                'group_user_code' => 'fin_acc',
                'group_user_name' => 'FINANCE AND ACCOUNTING',
                'group_user_description' => '',
                'group_user_visible' => '1',
                'group_user_level' => NULL,
                'group_user_dashboard' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            3 => 
            array (
                'group_user_code' => 'master',
                'group_user_name' => 'MASTER DATA',
                'group_user_description' => 'data master',
                'group_user_visible' => '1',
                'group_user_level' => NULL,
                'group_user_dashboard' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            4 => 
            array (
                'group_user_code' => 'operation',
                'group_user_name' => 'OPERATION',
                'group_user_description' => '',
                'group_user_visible' => '1',
                'group_user_level' => NULL,
                'group_user_dashboard' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            5 => 
            array (
                'group_user_code' => 'owner',
                'group_user_name' => 'OWNER',
                'group_user_description' => '',
                'group_user_visible' => '1',
                'group_user_level' => NULL,
                'group_user_dashboard' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
            6 => 
            array (
                'group_user_code' => 'sales',
                'group_user_name' => 'SALES',
                'group_user_description' => '',
                'group_user_visible' => '1',
                'group_user_level' => NULL,
                'group_user_dashboard' => NULL,
                'created_at' => NULL,
                'updated_at' => NULL,
                'created_by' => NULL,
                'updated_by' => NULL,
            ),
        ));
        
        
    }
}