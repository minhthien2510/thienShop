<?php

use Illuminate\Database\Seeder;

class ImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<25; $i++) {
            for ($j=0; $j<2; $j++) {
                $image = new \App\Image();
                $image->pro_id = $i;
                if ($j % 2 == 0) {
                    $image->name = '/laravel/public/uploads/images/product_328x328.jpg';
                    $image->cover_image = 1;
                } else {
                    $image->name = '/laravel/public/uploads/images/product_328x328alt.jpg';
                }
                $image->save();
            }
        }
    }
}
