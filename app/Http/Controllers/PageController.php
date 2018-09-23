<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Image;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
session_start();

class PageController extends Controller
{
    public function index()
    {
        $paginate = isset($_GET['per_page']) ? $_GET['per_page'] : 12;
        $brands = Brand::all();
        $categories = Category::all();
        $images = Image::orderBy('pro_id')->orderBy('id')->get();
        $products = Product::paginate($paginate);

        return view('home.index', compact('brands', 'categories', 'images', 'products'));
    }
    
    public function getBrand($slug)
    {
        $brand = Brand::where('slug', $slug)->first();
        $products = Product::where('brand_id', $brand->id)->paginate(12);
        $images = Image::where('cover_image', 1)->get();
        $brands = Brand::all();
        $categories = Category::all();
        return view('brand.index', compact('brand', 'images', 'products', 'brands', 'categories'));
    }

    public function getCategory($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = Product::where('cat_id', $category->id)->paginate(12);
        $images = Image::where('cover_image', 1)->get();
        $brands = Brand::all();
        $categories = Category::all();
        return view('category.index', compact('category', 'images', 'products', 'brands', 'categories'));
    }

    public function getProductDetail($slug)
    {
        $product = DB::table('products')
            ->join('categories', 'categories.id', '=', 'products.cat_id')
            ->join('brands', 'brands.id', '=', 'products.brand_id')
            ->select('products.*', 'categories.name as category', 'categories.slug as category_slug', 'brands.name as brand', 'brands.slug as brand_slug')
            ->where('products.slug', $slug)
            ->first();
        $images = DB::table('images')->where('pro_id', $product->id)->orderBy('id')->get();
        $products = DB::table('images')
            ->join('products', 'products.id', '=', 'images.pro_id')
            ->select('products.*', 'images.name as image', 'images.cover_image as cover_image')
            ->orderBy('id')
            ->where([['images.cover_image', 1], ['products.cat_id', $product->cat_id]])
            ->orWhere([['images.cover_image', 1], ['products.brand_id', $product->brand_id]])
            ->get();
        return view('detail.index', compact('product', 'products', 'images'));
//        dd($products);
    }

    public function comment()
    {
        return view('detail.comment');
    }

    public function wishList()
    {
        if (isset($_SESSION['wishlist'])) {
            $products = DB::table('products')
                ->join('images', 'products.id', '=', 'images.pro_id')
                ->whereIn('products.id', $_SESSION['wishlist'])
                ->where('images.cover_image', 1)
                ->select('products.*', 'images.name as image')
                ->get();
            return view('wishlist.index', compact('products'));
        } else {
            return view('wishlist.index');
        }
    }

    public function addWishList()
    {
        $id = $_POST['id'];
        if (empty($_SESSION['wishlist'])) {
//            $_SESSION['wishlist'][$id] = $id;
//            $_SESSION['wishlist'] = array_fill($id, 1, $id);
//            $keys = [$id];
            $_SESSION['wishlist'] = array_fill_keys([$id], $id);

        } elseif (array_key_exists($id, $_SESSION['wishlist'])) {
            unset($_SESSION['wishlist'][$id]);
        } else {
            $_SESSION['wishlist'][$id] = $id;
        }

        return $_SESSION['wishlist'];
    }

    public function removeWishList()
    {
        $id = $_POST['id'];

        unset($_SESSION['wishlist'][$id]);
    }
}
