<?php

use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'name' => 'JSY',            
            'code' => '001',
            'password' => bcrypt('001'),
            'authorization' => 'superadmin',
        ]);

        DB::table('admins')->insert([
            'name' => 'ZXX',            
            'code' => '002',
            'password' => bcrypt('002'),
            'authorization' => 'admin',
        ]);

    }
}
