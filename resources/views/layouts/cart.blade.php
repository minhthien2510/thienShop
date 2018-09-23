<div class="minicart-side-title">
    <h4>Shopping Cart</h4>
</div>
<div class="minicart-side-content">
    <div class="minicart">
        @if (empty($_SESSION['cart']))
            <div class="minicart-header no-items show">
                Your shopping bag is empty.
            </div>
            {{-- <div class="minicart-footer">--}}
                {{--<div class="minicart-actions clearfix">--}}
                    {{--<a class="button no-item-button" href="#">--}}
                        {{--<span class="text">Go to the shop</span>--}}
                    {{--</a>--}}
                {{--</div>--}}
            {{--</div> --}}
        @else
            <div class="minicart-header">
                {{$count}} items in the shopping cart
            </div>
            <div class="minicart-body">
                @foreach ($_SESSION['cart'] as $item)
                    <div class="cart-product clearfix">
                        <div class="cart-product-image">
                            <a class="cart-product-img" href="#">
                                <img width="300" height="300" src="{{ $item['img'] }}" width="60px" alt=""/>
                            </a>
                        </div>
                        <div class="cart-product-details">
                            <div class="cart-product-title">
                                <a href="#">{{ $item['name'] }}</a>
                            </div>
                            <div class="cart-product-quantity-price">
                                {{ $item['quantity'] }} x <span class="amount">{{ number_format($item['price'], 0, ',', '.') }} &dstrok;</span>
                            </div>
                        </div>
                        <a href="javascript:void(0)" class="remove remove_from_cart" data-id="{{ $item['id'] }}" title="Remove this item">&times;</a>
                    </div>
                @endforeach
            </div>
            <div class="minicart-footer">
                <div class="minicart-total">
                    Cart Subtotal <span class="amount">{{ number_format($subtotal, 0, ',', '.') }} &Dstrok;</span>
                </div>
                <div class="minicart-actions clearfix">
                    <a class="viewcart-button button rounded" href="{{ route('cart') }}">
                        <span class="text">View Cart</span>
                    </a>
                    <a class="checkout-button button rounded" href="{{ route('checkout') }}">
                        <span class="text">Checkout</span>
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
    jQuery(document).ready(function ($) {
        $('.cart-total').html({{ $count }});

        $('.remove_from_cart').click(function () {
            var id = $(this).data('id');
            $.post(
                "{{ route('removeCart') }}",
                {id: id},
                function (data) {
                    console.log(data);
                    $('.minicart-side').load("{{ route('mini-cart') }}");
                }
            );
        });
    })
</script>