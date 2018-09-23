<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        factory(\App\Product::class, 25)->create();
        for ($i=0; $i<25; $i++) {
            $product = new \App\Product();
            $product->name = str_random(5);
            $product->slug = str_slug($product->name);
            $product->price = random_int(100000, 10000000);
            $sale = random_int(100000, 10000000);
            if ($sale < $product->price)
                $product->sale_price = $sale;
            $product->quantity = random_int(0, 100);
            $product->description = str_random(10);
            $product->cat_id = random_int(1, 4);
            $product->brand_id = random_int(1, 5);
            $product->save();
        }
    }
}
