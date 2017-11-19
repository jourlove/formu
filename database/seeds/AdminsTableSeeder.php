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
            'code' => '001',
            'password' => bcrypt('001'),
            'name' => 'JSY',
        ]);
    }
}
