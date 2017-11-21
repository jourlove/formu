<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('permission_role')->insert([
            'permission_id' => 1,
            'role_id' => 1,
        ]);          

        DB::table('users')->insert([
            'name' => 'jsy',
            'email' => 'test@test.com',
            'password' => bcrypt('test'),            
        ]);

        DB::table('role_user')->insert([
            'user_id' => 1,
            'role_id' => 1,
        ]);          
        
    }
}
