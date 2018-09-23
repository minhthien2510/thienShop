<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', function () {
        return view('admin.index');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', 'UserController@index')->name('users.index');
        Route::get('/list', 'UserController@getList')->name('users.list');
    });

    Route::prefix('categories')->group(function () {
        Route::get('/', 'CategoryController@index')->name('categories.index');
        Route::get('/list', 'CategoryController@getList')->name('categories.list');
        Route::post('/create', 'CategoryController@create')->name('categories.create');
        Route::post('/edit', 'CategoryController@edit')->name('categories.edit');
        Route::post('/destroy', 'CategoryController@destroy')->name('categories.destroy');
    });

    Route::prefix('brands')->group(function () {
        Route::get('/', 'BrandController@index')->name('brands.index');
        Route::get('/list', 'BrandController@getList')->name('brands.list');
        Route::post('/create', 'BrandController@create')->name('brands.create');
        Route::post('/edit', 'BrandController@edit')->name('brands.edit');
        Route::post('/destroy', 'BrandController@destroy')->name('brands.destroy');
    });

    Route::prefix('products')->group(function () {
        Route::get('/', 'ProductController@index')->name('products.index');
        Route::get('/list', 'ProductController@getList')->name('products.list');
        Route::post('/create', 'ProductController@create')->name('products.create');
        Route::post('/edit', 'ProductController@edit')->name('products.edit');
        Route::post('/destroy', 'ProductController@destroy')->name('products.destroy');

        Route::get('/imgList', 'ImageController@getList')->name('products.imgList');
        Route::post('/createImg', 'ImageController@create')->name('products.createImg');
        Route::post('/updateImg', 'ImageController@update')->name('products.updateImg');
        Route::post('/destroyImg', 'ImageController@destroy')->name('products.destroyImg');
    });
});

Route::get('/test', function () {
    return view('layouts.master');
});

Route::get('/', 'PageController@index')->name('home');
Route::get('/category/{slug}', 'PageController@getCategory')->name('category');
Route::get('/brand/{slug}', 'PageController@getBrand')->name('brand');

Route::post('/loginAjax', 'UserController@loginAjax')->name('loginAjax');
Route::get('/login', 'UserController@getLogin')->name('getLogin');
Route::post('/login', 'UserController@postLogin')->name('postLogin');

Route::get('/lost-password', 'UserController@lostPassword');
Route::get('/register', 'UserController@getRegister')->name('getRegister');
Route::post('/register', 'UserController@registerAjax')->name('registerAjax');
Route::post('/registerCheckout', 'UserController@registerCheckout')->name('registerCheckout');
Route::get('/logout', 'UserController@logout')->name('logout');

Route::get('/mini-cart', 'CartController@getMiniCart')->name('mini-cart');
Route::post('/add-cart', 'CartController@addCart')->name('addCart');
Route::post('/remove-cart', 'CartController@removeCart')->name('removeCart');
Route::get('/cart', 'CartController@getCart')->name('cart');
Route::post('/update-cart', 'CartController@postCart')->name('cart.update');

Route::get('wishlist', 'PageController@wishList')->name('wishlist');
Route::post('add-wishlist', 'PageController@addWishList')->name('addWishList');
Route::post('remove-wishlist', 'PageController@removeWishList')->name('removeWishList');

Route::get('/comment', 'PageController@comment')->name('comment');
Route::get('/product/{slug}', 'PageController@getProductDetail')->name('product.detail');

Route::get('/checkout', 'OrderController@checkout')->name('checkout');
Route::post('/createOrder', 'OrderController@create')->name('order');
Route::get('/checkout/order-received/{id}', 'OrderController@orderReceived')->name('order.received');
