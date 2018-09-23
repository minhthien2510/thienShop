<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            BrandsTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            ImagesTableSeeder::class
        ]);

        DB::table('users')->insert([
            'first_name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
            'level' => '1',
            'status' => '1'
        ]);
    }
}
