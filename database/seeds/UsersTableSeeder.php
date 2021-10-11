<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'user_id' => 'U201808001',
                'nik' => 'U201801001',
                'name' => 'itok toni laksono',
                'email' => 'itok.toni@gmail.com',
                'password' => '$2y$10$W1sDOE45BuiXL3g42lvhs.p6HISJynvw4HpZakHP0bIR/c1wyLuVu',
                'username' => 'itoktoni',
                'photo' => 'itoktoni.jpeg',
                'active' => 1,
                'group_user' => 'developer',
                'remember_token' => 'lJUdw7EOCDPy17tM57Sl2buzU46SW6YPhwxVx0AqjuoAvee6IpVarp97LMuQ',
                'created_at' => '2017-02-01 04:39:15',
                'updated_at' => '2017-11-30 01:19:59',
                'warehouse' => 'jakarta',
                'site_id' => 'JBT',
                'target' => 100.0,
                'pencapaian' => 20.0,
                'gender' => '',
                'address' => 'Jl tanah koja RT.001/02 No. 65 Duri kosambi, Cengkareng, Jakarta Barat',
                'birth' => '2017-03-23',
                'place_birth' => 'Blora',
                'biografi' => 'Barang siapa yg mengenal dirinya maka sungguh dia telah mengenal Tuhannya.',
                'handphone' => '081311007076',
                'no_tax' => '123456',
                'created_by' => 'itoktoni',
                'sales_responsible' => 'itok.toni@gmail.com',
                'status' => 1,
            ),
        ));
        
        
    }
}