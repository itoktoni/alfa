<?php

use Illuminate\Database\Seeder;

class ModulesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('modules')->delete();
        
        \DB::table('modules')->insert(array (
            0 => 
            array (
                'module_code' => 'action',
                'module_name' => 'Action',
                'module_description' => 'form pemagian module',
                'module_link' => 'action',
                'module_sort' => 3,
                'module_single' => 0,
                'module_controller' => 'Action',
                'module_filters' => NULL,
                'module_visible' => '1',
                'module_enable' => '1',
            ),
            1 => 
            array (
                'module_code' => 'group_module',
                'module_name' => 'Group Module',
            'module_description' => 'module pembagian berdasarkan departemen ( data master, finance)',
                'module_link' => 'group_module',
                'module_sort' => 1,
                'module_single' => 0,
                'module_controller' => 'GroupModule',
                'module_filters' => NULL,
                'module_visible' => '1',
                'module_enable' => '1',
            ),
            2 => 
            array (
                'module_code' => 'group_user',
                'module_name' => 'Group User',
                'module_description' => 'module untuk membuat pengelompokan session user',
                'module_link' => 'group_user',
                'module_sort' => 0,
                'module_single' => 0,
                'module_controller' => 'GroupUser',
                'module_filters' => NULL,
                'module_visible' => '1',
                'module_enable' => '1',
            ),
            3 => 
            array (
                'module_code' => 'home',
                'module_name' => 'Home',
                'module_description' => 'dashboard',
                'module_link' => 'home',
                'module_sort' => 0,
                'module_single' => 1,
                'module_controller' => 'Home',
                'module_filters' => NULL,
                'module_visible' => '1',
                'module_enable' => '1',
            ),
            4 => 
            array (
                'module_code' => 'master_team',
                'module_name' => 'Master Team',
                'module_description' => 'ini digunakan oleh data master',
                'module_link' => 'master_team',
                'module_sort' => 0,
                'module_single' => 0,
                'module_controller' => 'Team',
                'module_filters' => NULL,
                'module_visible' => '1',
                'module_enable' => '1',
            ),
            5 => 
            array (
                'module_code' => 'module',
                'module_name' => 'Module',
                'module_description' => 'untuk memisahkan role action module',
                'module_link' => 'module',
                'module_sort' => 2,
                'module_single' => 0,
                'module_controller' => 'Module',
                'module_filters' => NULL,
                'module_visible' => '1',
                'module_enable' => '1',
            ),
            6 => 
            array (
                'module_code' => 'team',
                'module_name' => 'Team',
                'module_description' => '',
                'module_link' => 'team',
                'module_sort' => 0,
                'module_single' => 0,
                'module_controller' => 'Team',
                'module_filters' => NULL,
                'module_visible' => '1',
                'module_enable' => '1',
            ),
        ));
        
        
    }
}