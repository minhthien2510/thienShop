@extends('layouts.master')

@section('title', 'Checkout')

<?php
        $total = 0;
        foreach ($order_details as $item)
            $total += $item->quantity * $item->price;
?>
@section('content')
    <div class="heading-container">
        <div class="container heading-standar">
            <div class="page-breadcrumb">
                <ul class="breadcrumb">
                    <li>
                        <span typeof="v:Breadcrumb">
                            <a href="{{ route('home') }}" class="home">
                                <span>Home</span>
                            </a>
                        </span>
                    </li>
                    <li>
                        <span>Checkout</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12 main-wrap" data-itemprop="mainContentOfPage" role="main">
                    <div class="main-content">
                        <div class="woocommerce">
                            <div class="woocommerce-checkout-thankyou">
                                <h2>Thank you. Your order has been received.</h2>
                                <ul class="order_details order_summary">
                                    <li class="order"> Order Number: <strong>{{ $order->id }}</strong></li>
                                    <li class="date"> Date: <strong>{{ $order->created_at }}</strong></li>
                                    <li class="total"> Total: <strong><span class="amount">{{ number_format($total, 0, ',', '.') }} &Dstrok;</span></strong></li>
                                    <li class="method"> Payment Method: <strong>Cheque Payment</strong></li>
                                </ul>
                                <div class="clear"></div>
                                <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                <h2>Order Details</h2>
                                <table class="shop_table order_details">
                                    <thead>
                                    <tr>
                                        <th class="product-name">Product</th>
                                        <th class="product-total">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($order_details as $item)
                                        <tr class="order_item">
                                            <td class="product-name">
                                                <a href="{{ route('product.detail', $item->pro_id) }}">{{ $item->pro_name }}</a>
                                                <strong class="product-quantity">× {{ $item->quantity }}</strong>
                                            </td>
                                            <td class="product-total"> <span class="amount">{{ number_format($item->price, 0, ',', '.') }} VND</span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th scope="row">Subtotal:</th>
                                        <td><span class="amount">{{ number_format($total, 0, ',', '.') }} VND</span></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Payment Method:</th>
                                        <td>Cheque Payment</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">Total:</th>
                                        <td><span class="amount">{{ number_format($total, 0, ',', '.') }} VND</span></td>
                                    </tr>
                                    </tfoot>
                                </table>
                                <header>
                                    <h2>Customer Details</h2>
                                </header>
                                <table class="shop_table shop_table_responsive customer_details">
                                    <tbody>
                                    <tr>
                                        <th>Email:</th>
                                        <td>{{ $order->email }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telephone:</th>
                                        <td>{{ $order->phone }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                                <header class="title"><h3>Billing Address</h3> </header>
                                <address>{{ $order->address }}</address>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection