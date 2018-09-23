<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

session_start();

class OrderController extends Controller
{
    public function checkout()
    {
        if (isset($_SESSION['cart'])) {
            return view('checkout.index');
        } else {
            return redirect()->route('cart');
        }
    }

    public function create()
    {
        if (empty($_POST['first_name']))
            $data['errorFirstName'] = 'The First name field is required';

        if (empty($_POST['last_name']))
            $data['errorLastName'] = 'The Last name field is required';

        if (empty($_POST['email'])) {
            $data['errorEmail'] = 'The Email field is required.';
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $data['errorEmail'] = 'The Email must be a valid email address.';
        }

        if (empty($_POST['phone']))
            $data['phone'] = 'The Phone field is required';

        if (empty($_POST['address']))
            $data['address'] = 'The Address field is required';

        if (empty($data)) {
            $qty = 0;
            foreach ($_SESSION['cart'] as $item)
                $qty += $item['quantity'];

            $order = new Order();
            if (Auth::check())
                $order->customer_id = Auth::user()->id;
            $order->first_name = $_POST['first_name'];
            $order->last_name = $_POST['last_name'];
            $order->email = $_POST['email'];
            $order->phone = $_POST['phone'];
            $order->address = $_POST['address'];
            $order->quantity = $qty;
            $order->total_money = $_POST['total_money'];
            $order->save();

            foreach ($_SESSION['cart'] as $item) {
                $od = new OrderDetail();
                $od->pro_id = $item['id'];
                $od->pro_name = $item['name'];
                $od->quantity = $item['quantity'];
                $od->price = $item['price'];
                $od->order_id = $order->id;
                $od->save();
//                OrderDetail::create([
//                    'pro_id' => $item['id'],
//                    'pro_name' => $item['name'],
//                    'quantity' => $item['quantity'],
//                    'price' => $item['price'],
//                    'order_id' => $order->id
//                ]);
            }

            unset($_SESSION['cart']);

            return array('success' => $order->id);
        } else {
            $data['success'] = 0;
            return $data;
        }
    }

    public function orderReceived($id)
    {
        $order = Order::find($id);
        $order_details = OrderDetail::where('order_id', $id)->get();
        return view('checkout/order-received', compact('order', 'order_details'));
    }
}
