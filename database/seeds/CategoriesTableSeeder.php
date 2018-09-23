<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Phone & Tablet', 'slug' => 'phone-tablet', 'parent_id' => 0, 'status' => 1],
            ['name' => 'Laptop & Computer', 'slug' => 'laptop-computer', 'parent_id' => 0, 'status' => 1],
            ['name' => 'Headphones', 'slug' => 'headphones', 'parent_id' => 0, 'status' => 1],
            ['name' => 'Portable Electrics', 'slug' => 'portable-electrics', 'parent_id' => 0, 'status' => 1],
        ]);
    }
}
