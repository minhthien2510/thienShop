<?php

namespace App\Http\Controllers;

use App\Image;
use App\Product;
use Illuminate\Http\Request;
session_start();

class CartController extends Controller
{
    public function getMiniCart()
    {
        $count = 0;
        if (isset($_SESSION['cart'])) {
            $subtotal = 0;
            $cart = $_SESSION['cart'];
            foreach ($cart as $key) {
                $count += $key['quantity'];
                $subtotal += $cart[$key['id']]['price'] * $cart[$key['id']]['quantity'];
            }
        }

        return view('layouts.cart', compact('cart', 'subtotal', 'count'));
    }

    public function addCart()
    {
        $id = $_POST['id'];
        $product = Product::find($id);
        $image = Image::where('pro_id', $product->id)->where('cover_image', 1)->first();

        if (empty($_SESSION['cart'])) {
            $_SESSION['cart'][$id] = [
                'id' => $id,
                'img' => $image->name,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'quantity' => $_POST['quantity']
            ];
        } else {
            if (array_key_exists($id, $_SESSION['cart'])) {
//                $_SESSION['cart'][$id] = [
//                    'id' => $id,
//                    'img' => $image->name,
//                    'name' => $product->name,
//                    'slug' => $product->slug,
//                    'price' => $product->price,
//                    'quantity' => $_SESSION['cart'][$id]['quantity'] + $_POST['quantity']
//                ];
                $_SESSION['cart'][$id]['quantity'] += $_POST['quantity'];
            } else {
                $_SESSION['cart'][$id] = [
                    'id' => $id,
                    'img' => $image->name,
                    'name' => $product->name,
                    'slug' => $product->slug,
                    'price' => $product->price,
                    'quantity' => $_POST['quantity']
                ];
            }
        }

        return $_SESSION['cart'];
    }

    public function getCart()
    {
        return view('cart.index');
    }

    public function postCart(Request $request)
    {
        foreach ($request->input('quantity') as $key => $value) {
            if ($value == 0) {
                unset($_SESSION['cart'][$key]);
            } else {
                $_SESSION['cart'][$key]['quantity'] = $value;
            }
        }

        return redirect()->back();
    }

    public function removeCart()
    {
        $id = $_POST['id'];
        unset($_SESSION['cart'][$id]);

        return $_SESSION['cart'];
    }
}
