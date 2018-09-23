<?php

use App\Brand;
use App\Category;
use App\Image;
use App\User;
use App\Product;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('brands', function() {
    return Brand::all();
});

Route::post('brands', function() {
    $countName = DB::table('brands')->where('name', $_POST['name'])->count();
    $errorName = "";

    if (empty($_POST['name'])) {
        $errorName = "<li class='error'>The Name field is required.</li>";
    } elseif ($countName > 0) {
        $errorName = "<li class='error'>The Name field has a duplicate value.</li>";
    }

    if ($errorName == null) {
        Brand::insert([
            'name'      => $_POST['name'],
            'slug'      => str_slug($_POST['name']),
            'status'    => $_POST['status']
        ]);

//            $brand = new Brand([
//                'name'      => $_POST['name'],
//                'slug'      => str_slug($_POST['name']),
//                'status'    => $_POST['status']
//            ]);
//            $brand->save();

        $data = "success";
    } else {
        $data = ['errorName' => $errorName];
    }

    return $data;
});

Route::get('brands/{id}', function($id) {
    return Brand::find($id);
});

Route::get('categories', function() {
    return Category::all();
});

Route::get('categories/{id}', function($id) {
    return Category::find($id);
});

Route::get('products', function() {
    return Product::all();
});

Route::get('products/{id}', function($id) {
    return Product::find($id);
});

Route::delete('products/{id}', function($id) {
    return Product::destroy($id);
});

Route::get('product-images/{id}', function($id) {
    $images = Image::where('pro_id', $id)->get();
    return response()->json($images, 200);
});
