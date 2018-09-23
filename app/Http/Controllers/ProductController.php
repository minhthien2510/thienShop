<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Category;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.product.index');
    }

    public function getList()
    {
        $brands = Brand::all();
        $categories = Category::all();
        $products = Product::all();
//        $products =
        return view('admin.product.list', compact('brands', 'categories', 'products'));
    }

    public function create()
    {
        $checkName = Product::where('name', $_POST['name'])->first();
        $pro_name = str_replace(' ', '', $_POST['name']);

        $errorName = "";
        $errorPrice = "";
        $errorQuantity = "";
        $errorDescription = "";

        if (empty($pro_name)) {
            $errorName = "<li class='error'>The Name field is required.</li>";
        } elseif (count($checkName) > 0) {
            $errorName = "<li class='error'>The Name field has a duplicate value.</li>";
        }

        if (empty($_POST['price'])) {
            $errorPrice = "<li class='error'>The Price field is required.</li>";
        } elseif (!is_numeric($_POST['price'])) {
            $errorPrice = "<li class='error'>The Price must be a number.</li>";
        }

        if ($_POST['quantity'] == null) {
            $errorQuantity = "<li class='error'>The Quantity field is required.</li>";
        } elseif (!preg_match('/^[0-9]+$/', $_POST['quantity'])) {
            $errorQuantity = "<li class='error'>The Quantity must be a number.</li>";
        }

        if (empty($_POST['description'])) {
            $errorDescription = "<li class='error'>The Description field is required.</li>";
        }

        if ($errorName != null || $errorPrice != null || $errorQuantity != null || $errorDescription != null) {
            $data = [
                'errorName' => $errorName,
                'errorPrice' => $errorPrice,
                'errorQuantity' => $errorQuantity,
                'errorDescription' => $errorDescription
            ];
        } else {
            $pro = new Product();
            $pro->name = $_POST['name'];
            $pro->slug = str_slug($_POST['name']);
            $pro->price = $_POST['price'];
            if ($_POST['sale_price'] != null)
                $pro->sale_price = $_POST['sale_price'];
            $pro->quantity = $_POST['quantity'];
            $pro->description = $_POST['description'];
            $pro->cat_id = $_POST['cat_id'];
            $pro->brand_id = $_POST['bra_id'];
            $pro->status = $_POST['status'];
            $pro->save();

            $data = "success";
        }

        return $data;
    }

    public function edit()
    {
        $id = $_POST['id'];
        $checkName = Product::where('name', $_POST['name'])->where('id', '<>', $id)->first();
        $pro_name = str_replace(' ', '', $_POST['name']);
        $checkCat = Category::find($_POST['cat_id']);

        $errorName = "";
        $errorPrice = "";
        $errorQuantity = "";
        $errorDescription = "";
        $errorCat = "";

        $p = Product::find($id);
        $data = [
            'name' => $_POST['name'],
            'slug' => str_slug($_POST['name']),
            'price' => $_POST['price'],
            'sale_price' => $_POST['sale_price'],
            'quantity' => $_POST['quantity'],
            'description' => $_POST['description'],
            'cat_id' => $_POST['cat_id'],
            'status' => $_POST['status']
        ];

        if (empty($pro_name)) {
            $errorName = "<li class='error'>The Name field is required.</li>";
        } elseif (count($checkName) > 0) {
            $errorName = "<li class='error'>The Name field has a duplicate value.</li>";
        }

        if (empty($_POST['price'])) {
            $errorPrice = "<li class='error'>The Price field is required.</li>";
        } elseif (!preg_match('/^[0-9]+$/', $_POST['price'])) {
            $errorPrice = "<li class='error'>The Price must be a number.</li>";
        }

        if (is_null($_POST['quantity'])) {
            $errorQuantity = "<li class='error'>The Quantity field is required.</li>";
        } elseif (!preg_match('/^[0-9]+$/', $_POST['quantity'])) {
            $errorQuantity = "<li class='error'>The Quantity must be a number.</li>";
        }

        if (empty($_POST['description'])) {
            $errorDescription = "<li class='error'>The Description field is required.</li>";
        }

        if (count($checkCat) == 0)
            $errorCat = "<li class='error'>The selected Category is invalid.</li>";

        if ($errorName != null || $errorPrice != null || $errorQuantity != null || $errorDescription != null || $errorCat != null) {
            $response = [
                'errorName' => $errorName,
                'errorPrice' => $errorPrice,
                'errorQuantity' => $errorQuantity,
                'errorDescription' => $errorDescription,
                'errorCat' => $errorCat
            ];
        } elseif ($p->name == $data['name'] && $p->price == $data['price'] &&
            $p->sale_price == $data['sale_price'] && $p->quantity == $data['quantity'] &&
            $p->description == $data['description'] && $p->cat_id == $data['cat_id'] &&
            $p->status == $data['status']) {
            $response = ['success' => "Product does not change."];
        } else {
            $pro = Product::find($id);
            $pro->name = $_POST['name'];
            $pro->slug = str_slug($_POST['name']);
            $pro->price = $_POST['price'];
            if ($_POST['sale_price'] != null)
                $pro->sale_price = $_POST['sale_price'];
            $pro->quantity = $_POST['quantity'];
            $pro->description = $_POST['description'];
            $pro->cat_id = $_POST['cat_id'];
            $pro->status = $_POST['status'];
            $pro->save();

            // Product::find($id)->update($data);

            $response = ['success' => "Product has been updated."];
        }

        return $response;
    }

    public function destroy()
    {
        $id = $_POST['id'];

        Product::destroy($id);

        return "success";
    }
}
