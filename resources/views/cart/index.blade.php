@extends('layouts.master')

@section('title', 'Cart')

@section('content')
    <div class="heading-container">
        <div class="container heading-standar">
            <div class="page-breadcrumb">
                <ul class="breadcrumb">
                    <li>
                        <span>
                            <a class="home" href="{{ route('home') }}">
                                <span>Home</span>
                            </a>
                        </span>
                    </li>
                    <li>
                        <span>Cart</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-container">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-content">
                        <div class="commerce">
                            @if(empty($_SESSION['cart']))
                                <p class="cart-empty">Your cart is currently empty.</p>
                                <p class="return-to-shop"><a class="button wc-backward" href="{{ route('home') }}">Return To Shop</a></p>
                            @else
                            <form method="post" action="{{ route('cart.update') }}">
                                {{ csrf_field() }}
                                <table class="table shop_table cart">
                                    <thead>
                                    <tr>
                                        <th class="product-remove hidden-xs">&nbsp;</th>
                                        <th class="product-thumbnail hidden-xs">&nbsp;</th>
                                        <th class="product-name">Product</th>
                                        <th class="product-price text-center">Price</th>
                                        <th class="product-quantity text-center">Quantity</th>
                                        <th class="product-subtotal text-center hidden-xs">Total</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php $subtotal = 0; ?>
                                    @foreach($_SESSION['cart'] as $item)
                                        <?php $subtotal += $item['quantity'] * $item['price'] ?>
                                    <tr class="cart_item">
                                        <td class="product-remove hidden-xs">
                                            <a href="javascript:void(0)" class="remove remove_from_cart" data-id="{{ $item['id'] }}" title="Remove this item">&times;</a>
                                        </td>
                                        <td class="product-thumbnail hidden-xs">
                                            <a href="{{ route('product.detail', str_slug($item['name'])) }}">
                                                <img width="100" height="150" src="{{ $item['img'] }}" alt="{{ $item['name'] }}"/>
                                            </a>
                                        </td>
                                        <td class="product-name">
                                            <a href="{{ route('product.detail', str_slug($item['name'])) }}">{{ $item['name'] }}</a>
                                            {{--<dl class="variation">--}}
                                                {{--<dt class="variation-Color">Color:</dt>--}}
                                                {{--<dd class="variation-Color"><p>Green</p></dd>--}}
                                                {{--<dt class="variation-Size">Size:</dt>--}}
                                                {{--<dd class="variation-Size"><p>Extra Large</p></dd>--}}
                                            {{--</dl>--}}
                                        </td>
                                        <td class="product-price text-center">
                                            <span class="amount">{{ number_format($item['price'], 0, ',', '.') }} &Dstrok;</span>
                                        </td>
                                        <td class="product-quantity text-center">
                                            <div class="quantity">
                                                <input type="number" step="1" min="0" name="quantity[{{ $item['id'] }}]" value="{{ $item['quantity'] }}" title="Qty" class="input-text qty text" size="4"/>
                                            </div>
                                        </td>
                                        <td class="product-subtotal hidden-xs text-center">
                                            <span class="amount">{{ number_format($item['quantity']*$item['price'], 0, ',', '.') }} &Dstrok;</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="6" class="actions">
                                            <div class="coupon">
                                                <label for="coupon_code">Coupon:</label>
                                                <input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" placeholder="Coupon code"/>
                                                <input type="submit" class="button rounded" name="apply_coupon" value="Apply Coupon"/>
                                            </div>
                                            <input type="submit" class="button update-cart-button rounded" name="update_cart" value="Update Cart"/>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </form>
                            <div class="cart-collaterals">
                                <div class="cart_totals">
                                    <h2>Cart Totals</h2>
                                    <table>
                                        <tr class="cart-subtotal">
                                            <th>Subtotal</th>
                                            <td><span class="amount">{{ number_format($subtotal, 0, ',', '.') }} &Dstrok;</span></td>
                                        </tr>
                                        <tr class="shipping">
                                            <th>Shipping</th>
                                            <td><span class="amount">0 &Dstrok;</span></td>
                                        </tr>
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td><strong><span class="amount">{{ number_format($subtotal, 0, ',', '.') }} &Dstrok;</span></strong></td>
                                        </tr>
                                    </table>
                                    <div class="wc-proceed-to-checkout">
                                        <a href="{{  route('checkout') }}" class="checkout-button button alt wc-forward rounded">Proceed to Checkout</a>
                                    </div>
                                </div>
                                <div class="cross-sells">
                                    <h2>You may be interested in&hellip;</h2>
                                    <ul class="products columns-2">
                                        <li class="product style-2">
                                            <div class="product-container">
                                                <figure>
                                                    <div class="product-wrap">
                                                        <div class="product-images">
                                                            <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                                                                <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                                                                <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328alt.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <figcaption>
                                                        <div class="shop-loop-product-info">
                                                            <div class="info-meta clearfix">
                                                                <div class="star-rating">
                                                                    <span style="width:100%"></span>
                                                                </div>
                                                                <div class="loop-add-to-wishlist">
                                                                    <div class="yith-wcwl-add-to-wishlist">
                                                                        <div class="yith-wcwl-add-button">
                                                                            <a href="#" class="add_to_wishlist">
                                                                                Add to Wishlist
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="info-content-wrap">
                                                                <h3 class="product_title">
                                                                    <a href="shop-detail-1.html">Florence Knoll Credenza</a>
                                                                </h3>
                                                                <div class="info-price">
																			<span class="price">
																				<span class="amount">£17.50</span>
																			</span>
                                                                </div>
                                                                <div class="loop-action">
                                                                    <div class="loop-add-to-cart">
                                                                        <a href="#" class="add_to_cart_button">
                                                                            Add to cart
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </li>
                                        <li class="product style-2">
                                            <div class="product-container">
                                                <figure>
                                                    <div class="product-wrap">
                                                        <div class="product-images">
                                                            <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                                                                <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328.jpg" alt=""/></a>
                                                            </div>
                                                            <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                                                                <a href="shop-detail-1.html"><img width="450" height="450" src="images/products/product_328x328alt.jpg" alt=""/></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <figcaption>
                                                        <div class="shop-loop-product-info">
                                                            <div class="info-meta clearfix">
                                                                <div class="star-rating">
                                                                    <span style="width:100%"></span>
                                                                </div>
                                                                <div class="loop-add-to-wishlist">
                                                                    <div class="yith-wcwl-add-to-wishlist">
                                                                        <div class="yith-wcwl-add-button">
                                                                            <a href="#" class="add_to_wishlist">
                                                                                Add to Wishlist
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="info-content-wrap">
                                                                <h3 class="product_title">
                                                                    <a href="shop-detail-1.html">Citterio Grand Repos</a>
                                                                </h3>
                                                                <div class="info-price">
																			<span class="price">
																				<span class="amount">£12.00</span>
																				–
																				<span class="amount">£20.00</span>
																			</span>
                                                                </div>
                                                                <div class="loop-action">
                                                                    <div class="loop-add-to-cart">
                                                                        <a href="#" class="add_to_cart_button">
                                                                            Add to cart
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </figcaption>
                                                </figure>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        jQuery(function($) {
            $('.remove_from_cart').click(function () {
                var id = $(this).data('id');
                $.post(
                    "{{ route('removeCart') }}",
                    { id: id },
                    function (data) {
                        console.log(data);
                        location.reload();
                    }
                );
            });

            $('.minicart-link').addClass('disabled');
        });
    </script>
@endsection