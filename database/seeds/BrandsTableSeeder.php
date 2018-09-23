<?php

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->insert([
            ['name' => 'Apple', 'slug' => 'apple'],
            ['name' => 'Samsung', 'slug' => 'samsung'],
            ['name' => 'Google', 'slug' => 'google'],
            ['name' => 'Nokia', 'slug' => 'nokia'],
            ['name' => 'HTC', 'slug' => 'htc']
        ]);
    }
}
