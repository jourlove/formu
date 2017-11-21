<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('categories')->insert([
            'name' => '日用品',
            'layer' => 0,
        ]);
        DB::table('categories')->insert([
            'parent_id' => 1,
            'name' => '眼药水',
            'layer' => 1,
        ]);
        
    }
}
