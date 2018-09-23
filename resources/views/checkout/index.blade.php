@extends('layouts.master')

@section('title', 'Checkout')

@section('content')
    <div class="heading-container">
        <div class="container heading-standar">
            <div class="page-breadcrumb">
                <ul class="breadcrumb">
                    <li>
                        <span>
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
                            @if(!Auth::check())
                                <div class="woocommerce-info woocommerce-info-login">
                                    Returning customer?
                                    <a data-toggle="collapse" href="#loginaccount" class="showlogin">Click here to login</a>
                                </div>
                                <form method="post" id="loginaccount" class="login collapse" action="{{ route('postLogin') }}">
                                    <p>If you have shopped with us before, please enter your details in the boxes below. If you are a new customer please proceed to the Billing &amp; Shipping section.</p>
                                    {{ csrf_field() }}
                                    @if ($errors->any())
                                        <div class="alert alert-danger alert-dismissible" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <p class="form-row form-row-first">
                                        <label for="Email">Email <span class="required">*</span></label>
                                        <input class="input-text" name="email" id="email" type="email">
                                    </p>
                                    <p class="form-row form-row-last">
                                        <label for="password">Password <span class="required">*</span></label>
                                        <input class="input-text" name="password" id="password" type="password">
                                    </p>
                                    <div class="clear"></div>
                                    <p class="form-row">
                                        <label for="rememberme" class="form-flat-checkbox">
                                            <input name="remember" id="rememberme" value="false" type="checkbox"> <i></i>Remember me
                                        </label>
                                        <br>
                                        <input class="button rounded" name="login" value="Login" type="submit">
                                    </p>
                                    <p class="lost_password">
                                        <a href="#lost-password">Lost your password?</a>
                                    </p>
                                    <div class="clear"></div>
                                </form>
                            @endif
                            <div class="woocommerce-info woocommerce-info-coupon">
                                Have a coupon?
                                <a data-toggle="collapse" href="#coupon" class="showcoupon">Click here to enter your code</a>
                            </div>
                            <form id="coupon" class="checkout_coupon collapse" method="post">
                                <p class="form-row form-row-first">
                                    <input name="coupon_code" class="input-text" placeholder="Coupon code" id="coupon_code" type="text">
                                </p>
                                <p class="form-row form-row-last">
                                    <input class="button rounded" name="apply_coupon" value="Apply Coupon" type="submit">
                                </p>
                                <div class="clear"></div>
                            </form>
                            <form name="checkout" method="post" class="checkout woocommerce-checkout" action="" enctype="multipart/form-data" style="position: static;">
                                <ul class="error"></ul>
                                <div class="row">
                                    <div class="col-md-7 col-sm-6 checkout-customer-details " id="customer_details">
                                        <div class="checkout-billing">
                                            <div class="woocommerce-billing-fields">
                                                <h3>Billing Details</h3>
                                                <p class="form-row form-row-first" id="billing_first_name_field">
                                                    <label for="billing_first_name" class="">First Name <abbr class="required" title="required">*</abbr></label>
                                                    <input class="input-text " name="billing_first_name" id="billing_first_name" placeholder="" type="text" required>
                                                    <div class="help-block errorFirstName"></div>
                                                </p>
                                                <p class="form-row form-row-last" id="billing_last_name_field">
                                                    <label for="billing_last_name" class="">Last Name <abbr class="required" title="required">*</abbr></label>
                                                    <input class="input-text " name="billing_last_name" id="billing_last_name" placeholder="" type="text" required>
                                                    <div class="help-block errorLastName"></div>
                                                </p>
                                                <p class="form-row form-row-first" id="billing_email_field">
                                                    <label for="billing_email" class="">Email Address <abbr class="required" title="required">*</abbr></label>
                                                    <input class="input-text " name="billing_email" id="billing_email" placeholder="" type="email" required>
                                                    <div class="help-block errorEmail"></div>
                                                </p>
                                                <p class="form-row form-row-last" id="billing_phone_field">
                                                    <label for="billing_phone" class="">Phone <abbr class="required" title="required">*</abbr></label>
                                                    <input class="input-text " name="billing_phone" id="billing_phone" placeholder="" type="tel" required>
                                                    <div class="help-block errorPhone"></div>
                                                </p>
                                                <div class="clear"></div>
                                                <p class="form-row form-row-wide address-field" id="billing_address_field">
                                                    <label for="billing_address" class="">Address <abbr class="required" title="required">*</abbr></label>
                                                    <input class="input-text " name="billing_address" id="billing_address" placeholder="Street address" type="text" required>
                                                    <div class="help-block errorAddress"></div>
                                                </p>
                                                <div class="clear"></div>
                                                @if(!Auth::check())
                                                    <p class="form-row form-row-wide create-account">
                                                        <label for="createaccount" class="checkbox form-flat-checkbox">
                                                            <input class="input-checkbox" id="createaccount" name="createaccount" value="1" type="checkbox" data-toggle="collapse" data-target="#collapseRegister">
                                                            <i></i> Create an account?
                                                        </label>
                                                    </p>
                                                    <div class="create-account collapse" id="collapseRegister">
                                                        <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                                        <p class="form-row form-row validate-required woocommerce-validated" id="account_password_field">
                                                            <label for="account_password" class="">Account password <abbr class="required" title="required">*</abbr></label>
                                                            <input class="input-text " name="account_password" id="account_password" placeholder="Password" type="password">
                                                        </p>
                                                        <div class="clear"></div>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="checkout-shipping">
                                            <div class="woocommerce-shipping-fields">
                                                <h3>Additional Information</h3>
                                                <p class="form-row form-row notes" id="order_comments_field">
                                                    <label for="order_comments" class="">Order Notes</label>
                                                    <textarea name="order_comments" class="input-text " id="order_comments" placeholder="Notes about your order, e.g. special notes for delivery." rows="2" cols="5"></textarea>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5 col-sm-6">
                                        <div id="order_review" class="woocommerce-checkout-review-order">
                                            <h3 id="order_review_heading">Your order</h3>
                                            <table class="shop_table woocommerce-checkout-review-order-table">
                                                <thead>
                                                <tr>
                                                    <th class="product-name">Product</th>
                                                    <th class="product-total">Total</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <?php $total = 0; ?>
                                                @foreach($_SESSION['cart'] as $item)
                                                    <?php $total += $item['quantity'] * $item['price']; ?>
                                                    <tr class="cart_item">
                                                        <td class="product-name">
                                                            {{ $item['name'] }}
                                                            <strong class="product-quantity">× {{ $item['quantity'] }}</strong>
                                                        </td>
                                                        <td class="product-total">
                                                            <span class="amount">{{ number_format($item['quantity'] * $item['price'], 0, ',', '.') }} &Dstrok;</span>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr class="cart-subtotal">
                                                    <th>Subtotal</th>
                                                    <td><span class="amount">{{ number_format($total, 0, ',', '.') }} &Dstrok;</span></td>
                                                </tr>
                                                <tr class="order-total">
                                                    <th>Total</th>
                                                    <td>
                                                        <strong><span class="amount">{{ number_format($total, 0, ',', '.') }} &Dstrok;</span></strong>
                                                    </td>
                                                    <input type="hidden" id="total_money" value="{{ $total }}">
                                                </tr>
                                                </tfoot>
                                            </table>

                                            <div id="payment" class="woocommerce-checkout-payment">
                                                <ul class="payment_methods methods">
                                                    <li class="payment_method_cheque">
                                                        <label for="payment_method_cheque" class="form-flat-radio">
                                                            <input id="payment_method_cheque" class="input-radio" name="payment_method" value="cheque" checked="checked" data-order_button_text="" type="radio">
                                                            <i></i> Cheque Payment
                                                        </label>
                                                        <div class="payment_box payment_method_cheque">
                                                            <p>Please send your cheque to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</p>
                                                        </div>
                                                    </li>
                                                    <li class="payment_method_paypal">
                                                        <label for="payment_method_paypal" class="form-flat-radio">
                                                            <input id="payment_method_paypal" class="input-radio" name="payment_method" value="paypal" data-order_button_text="Proceed to PayPal" type="radio">
                                                            <i></i> PayPal <img src="https://www.paypalobjects.com/webstatic/mktg/Logo/AM_mc_vs_ms_ae_UK.png" alt="PayPal Acceptance Mark">
                                                            <a href="https://www.paypal.com/gb/webapps/mpp/paypal-popup" class="about_paypal" onclick="javascript:window.open('https://www.paypal.com/gb/webapps/mpp/paypal-popup','WIPaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); return false;" title="What is PayPal?">What is PayPal?</a>
                                                        </label>
                                                        <div class="payment_box payment_method_paypal" style="display:none;">
                                                            <p>Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</p>
                                                        </div>
                                                    </li>
                                                </ul>

                                                <div class="form-row place-order">
                                                    <noscript>
                                                        Since your browser does not support JavaScript, or it is disabled, please ensure you click the <em>Update Totals</em> button before placing your order. You may be charged more than the amount stated above if you fail to do so.<br/>
                                                        <input type="submit" class="button alt" name="woocommerce_checkout_update_totals" value="Update totals" />
                                                    </noscript>
                                                    <input id="_wpnonce" name="_wpnonce" value="729520aefb" type="hidden">
                                                    <input name="_wp_http_referer" value="/woow/electric/checkout/?wc-ajax=update_order_review" type="hidden">
                                                    <button type="button" class="button alt rounded btn" disabled="disabled" name="woocommerce_checkout_place_order" id="place_order" value="Place order" data-value="Place order">Place order</button>
                                                    <p class="form-row terms">
                                                        <label for="terms" class="checkbox form-flat-checkbox">
                                                            <input class="input-checkbox" name="terms" id="terms" type="checkbox">
                                                            <i></i> I’ve read and accept the <a href="#" target="_blank">terms &amp; conditions</a>
                                                        </label>
                                                    </p>
                                                </div>

                                                <div class="clear"></div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function ($) {
            $('#payment_method_cheque').click(function () {
                $('div.payment_method_cheque').show(500);
                $('div.payment_method_paypal').hide(500);
                $('#place_order').html('Place order').val('Place order');
            });

            $('#payment_method_paypal').click(function () {
                $('div.payment_method_paypal').show(500);
                $('div.payment_method_cheque').hide(500);
                $('#place_order').html('Proceed to PayPal').val('Proceed to PayPal');
            });

            $('#terms').click(function () {
                if ($('.input-checkbox').is(':checked'))
                    $('#place_order').removeAttr('disabled', 'disabled');
                else
                    $('#place_order').attr('disabled', 'disabled');
            });

            $('#place_order').click(function () {
                if ($('#createaccount').is(":checked")) {
                    $.post(
                        '{{ route('registerCheckout') }}',
                        {
                            first_name: $('#billing_first_name').val(),
                            last_name: $('#billind_last_name').val(),
                            email: $('#billing_email').val(),
                            phone: $('#billing_phone').val(),
                            address: $('#billing_address').val(),
                            password: $('#account_password').val()
                        },
                        function (data) {
                            console.log(data);
                            if (data == 'email is exist') {
                                $('.error').addClass('alert alert-danger').css('list-style', 'none').html('<li><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> An account is already registered with your email address. Please login.</li>');
                                $(window).scrollTop(120);
                            } else {
                                $('.error').removeClass('alert alert-danger').html('');
                                if (data == 'success') {
                                    $.post(
                                        '{{ route('order') }}',
                                        {
                                            first_name: $('#billing_first_name').val(),
                                            last_name: $('#billing_last_name').val(),
                                            email: $('#billing_email').val(),
                                            phone: $('#billing_phone').val(),
                                            address: $('#billing_address'),
                                            total_money: $('#total_money').val()
                                        },
                                        function (response) {
                                            console.log(response);

                                            if (response.success != 0) {
                                                $(location).attr('href', '/checkout/order-received/' + response.success);
                                            }
                                        }
                                    );
                                } else {
                                    var error = '';
                                    error = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                                    $.each(data, function (index, value) {
                                        error += '<li>' + value + '</li>'
                                    });
                                    $('.error').addClass('alert alert-danger alert-dismissible').attr('role', 'alert').css('list-style', 'inside').html(error);
                                }
                            }
                        }
                    );
                } else {
                    $.post(
                        '{{ route('order') }}',
                        {
                            first_name: $('#billing_first_name').val(),
                            last_name: $('#billing_last_name').val(),
                            email: $('#billing_email').val(),
                            phone: $('#billing_phone').val(),
                            address: $('#billing_address').val(),
                            total_money: $('#total_money').val()
                        },
                        function (data) {
                            console.log(data);

                            if (data.success != 0) {
                                $(location).attr('href', '/checkout/order-received/' + data.success);
                            } else {
                                var error = '';
                                error = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'
                                $.each(data, function (index, value) {
                                    if (index != 'success')
                                        error += '<li>' + value + '</li>'
                                });
                                $('.error').addClass('alert alert-danger alert-dismissible').attr('role', 'alert').css('list-style', 'inside').html(error);
                                $(window).scrollTop(300);
                            }
                        }
                    );
                }
            });

            $('.minicart-link').addClass('disabled');

        })(jQuery);
    </script>
@endsection