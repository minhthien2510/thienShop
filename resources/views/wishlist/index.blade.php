@extends('layouts.master')

@section('title', 'Wishlist')

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
                        <span>My Wishlist</span>
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
                        <form class="commerce">
                            <div class="wishlist-title ">
                                <h2>My wishlist on WooW</h2>
                            </div>
                            <table class="shop_table cart wishlist_table">
                                <thead>
                                <tr>
                                    <th class="product-remove"></th>
                                    <th class="product-thumbnail"></th>
                                    <th class="product-name"><span class="nobr">Product Name</span></th>
                                    <th class="product-price"><span class="nobr">Unit Price </span></th>
                                    <th class="product-stock-stauts"><span class="nobr">Stock Status </span></th>
                                    <th class="product-add-to-cart"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(empty($_SESSION['wishlist']))
                                    <tr>
                                        <td colspan="6" class="wishlist-empty text-center">No products were added to the wishlist</td>
                                    </tr>
                                @else
                                    @foreach($products as $item)
                                        <tr>
                                            <td class="product-remove">
                                                <a href="javascript:void(0)" data-id="{{ $item->id }}" class="remove remove_from_wishlist">&times;</a>
                                            </td>
                                            <td class="product-thumbnail">
                                                <a href="{{ route('product.detail', $item->slug) }}">
                                                    <img width="100" height="150" src="{{ $item->image }}" alt="{{ $item->name }}"/>
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <a href="{{ route('product.detail', $item->slug) }}">{{ $item->name }}</a>
                                            </td>
                                            <td class="product-price">
                                                <span class="amount">{{ number_format($item->price, 0, ',', '.') }} &Dstrok;</span>
                                            </td>
                                            <td class="product-stock-status">
                                                <span class="wishlist-in-stock">In Stock</span>
                                            </td>
                                            <td class="product-add-to-cart">
                                                <a href="javascript:void(0)" class="add_to_cart_button btn btn-default rounded" data-id="{{ $item->id }}" data-quantity="{{ $item->quantity }}"> Add to cart</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="6">&nbsp;</td>
                                </tr>
                                </tfoot>
                            </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        jQuery().ready(function($) {
            $('.remove_from_wishlist').click(function () {
                $.post(
                    '{{ route('removeWishList') }}',
                    { id: $(this).data('id') },
                    function (data) {
                        location.reload();
                    }
                );
            });
        })
    </script>
@endsection