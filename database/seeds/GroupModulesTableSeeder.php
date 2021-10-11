<?php

use Illuminate\Database\Seeder;

class GroupModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('group_modules')->delete();
        
        \DB::table('group_modules')->insert(array (
            0 => 
            array (
                'group_module_code' => 'admin',
                'group_module_name' => 'ADMIN',
                'group_module_description' => '',
                'group_module_link' => 'admin',
                'group_module_sort' => 0,
                'group_module_visible' => '1',
                'group_module_enable' => '1',
            ),
            1 => 
            array (
                'group_module_code' => 'finance_accounting',
                'group_module_name' => 'FINANCE ACCOUNTING',
                'group_module_description' => '',
                'group_module_link' => 'finance_accounting',
                'group_module_sort' => 0,
                'group_module_visible' => '1',
                'group_module_enable' => '1',
            ),
            2 => 
            array (
                'group_module_code' => 'master',
                'group_module_name' => 'MASTER',
                'group_module_description' => 'module ini digunakan untuk data master',
                'group_module_link' => 'master',
                'group_module_sort' => 0,
                'group_module_visible' => '1',
                'group_module_enable' => '1',
            ),
            3 => 
            array (
                'group_module_code' => 'operation',
                'group_module_name' => 'OPERATION',
                'group_module_description' => '',
                'group_module_link' => 'operation',
                'group_module_sort' => 0,
                'group_module_visible' => '1',
                'group_module_enable' => '1',
            ),
            4 => 
            array (
                'group_module_code' => 'owner',
                'group_module_name' => 'OWNER',
                'group_module_description' => '',
                'group_module_link' => 'owner',
                'group_module_sort' => 0,
                'group_module_visible' => '1',
                'group_module_enable' => '1',
            ),
            5 => 
            array (
                'group_module_code' => 'sales',
                'group_module_name' => 'SALES',
                'group_module_description' => '',
                'group_module_link' => 'sales',
                'group_module_sort' => 0,
                'group_module_visible' => '1',
                'group_module_enable' => '1',
            ),
            6 => 
            array (
                'group_module_code' => 'system',
                'group_module_name' => 'SYSTEM',
                'group_module_description' => 'Core & System',
                'group_module_link' => 'system',
                'group_module_sort' => 5,
                'group_module_visible' => '1',
                'group_module_enable' => '1',
            ),
        ));
        
        
    }
}