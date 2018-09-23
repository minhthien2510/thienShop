@extends('layouts.master')

@section('title', $product->name)

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
                        <span>{{ $product->name }}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="content-container no-padding">
        <div class="container-full">
            <div class="row">
                <div class="col-md-12">
                    <div class="main-content">
                        <div class="commerce">
                            <div class="style-1 product">
                                <div class="container">
                                    <div class="row summary-container">
                                        <div class="col-md-7 col-sm-6 entry-image">
                                            <div class="single-product-images">
                                                <span class="onsale">Sale!</span>
                                                <div class="single-product-images-slider">
                                                    <div class="caroufredsel product-images-slider" data-synchronise=".single-product-images-slider-synchronise" data-scrollduration="500" data-height="variable" data-scroll-fx="none" data-visible="1" data-circular="1" data-responsive="1">
                                                        <div class="caroufredsel-wrap">
                                                            <ul class="caroufredsel-items">
                                                                @foreach($images as $item)
                                                                <li class="caroufredsel-item">
                                                                    <a href="{{ $item->name }}" data-rel="magnific-popup-verticalfit">
                                                                        <img width="600" height="685" src="{{ $item->name }}" alt="{{ $product->name }}"/>
                                                                    </a>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                            <a href="javascript:void(0)" class="caroufredsel-prev"></a>
                                                            <a href="javascript:void(0)" class="caroufredsel-next"></a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-product-thumbnails">
                                                    <div class="caroufredsel product-thumbnails-slider" data-visible-min="2" data-visible-max="4" data-scrollduration="500" data-direction="up" data-height="100%" data-circular="1" data-responsive="0">
                                                        <div class="caroufredsel-wrap">
                                                            <ul class="single-product-images-slider-synchronise caroufredsel-items">
                                                                <?php $i = 0; ?>
                                                                @foreach($images as $item)
                                                                    <li class="caroufredsel-item{{ $i==0 ? ' selected' : '' }}">
                                                                        <div class="thumb">
                                                                            <a href="#" data-rel="{{ $i }}">
                                                                                <img width="300" height="300" src="{{ $item->name }}" alt="{{ $product->name }}"/>
                                                                            </a>
                                                                        </div>
                                                                    </li>
                                                                    <?php $i++; ?>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-5 col-sm-6 entry-summary">
                                            <div class="summary">
                                                <h1 class="product_title entry-title">{{ $product->name }}</h1>
                                                <p class="price">
                                                    {{--<del>--}}
                                                        {{--<span class="amount">&pound;20.50</span>--}}
                                                    {{--</del>--}}
                                                    <ins>
                                                        <span class="amount">{{ number_format($product->price, 0, ',', '.') }} VNĐ</span>
                                                    </ins>
                                                </p>
                                                <div class="product-excerpt">
                                                    <p>
                                                        {{ $product->description }}
                                                    </p>
                                                </div>
                                                <form class="cart">
                                                    <div class="add-to-cart-table">
                                                        <div class="quantity">
                                                            <input type="number" step="1" min="1" name="quantity" value="1" title="Qty" class="input-text qty text" size="4"/>
                                                        </div>
                                                        <button type="button" class="button add_to_cart_button" data-id="{{ $product->id }}">Add to cart</button>
                                                    </div>
                                                </form>
                                                <p><a href="javascript:void(0)" class="add_to_wishlist" data-id="{{ $product->id }}"><strong>Add to Wishlist</strong></a></p>
                                                <div class="clear"></div>
                                                <div class="product_meta">
                                                    <span class="posted_in">
                                                        Categories:
                                                        <a href="{{ route('category', $product->category_slug) }}">{{ $product->category }}</a>
                                                    </span>
                                                    <span class="posted_in">
                                                        Brand:
                                                        <a href="{{ route('brand', $product->brand_slug) }}">{{ $product->brand }}</a>
                                                    </span>
                                                </div>
                                                <div class="share-links">
                                                    <div class="share-icons">
                                                        <span class="facebook-share">
                                                            <a href="#" title="Share on Facebook">
                                                                <i class="fa fa-facebook"></i>
                                                            </a>
                                                        </span>
                                                        <span class="twitter-share">
                                                            <a href="#" title="Share on Twitter">
                                                                <i class="fa fa-twitter"></i>
                                                            </a>
                                                        </span>
                                                        <span class="google-plus-share">
                                                            <a href="#" title="Share on Google +">
                                                                <i class="fa fa-google-plus"></i>
                                                            </a>
                                                        </span>
                                                        <span class="linkedin-share">
                                                            <a href="#" title="Share on Linked In">
                                                                <i class="fa fa-linkedin"></i>
                                                            </a>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="commerce-tab-container">
                                    <div class="container">
                                        <div class="col-md-12">
                                            <div class="tabbable commerce-tabs">
                                                <ul class="nav nav-tabs">
                                                    <li class="vc_tta-tab active">
                                                        <a data-toggle="tab" href="#tab-1">Description</a>
                                                    </li>
                                                    <li class="vc_tta-tab">
                                                        <a data-toggle="tab" href="#tab-2">Reviews <span>0</span></a>
                                                    </li>
                                                </ul>
                                                <div class="tab-content">
                                                    <div id="tab-1" class="tab-pane fade in active">
                                                        <h2>Product Description</h2>
                                                        {{ $product->description }}
                                                    </div>
                                                    <div id="tab-2" class="tab-pane fade">
                                                        <div id="comments" class="comments-area">
                                                            <h2 class="comments-title">There are <span>3</span> Comments</h2>
                                                            <ol class="comments-list">
                                                            </ol>
                                                            <div class="comment-respond">
                                                                <h3 class="comment-reply-title">
                                                                    <span>Leave your thought</span>
                                                                </h3>
                                                                <form class="comment-form">
                                                                    @if(Auth::check())
                                                                        <div class="row">
                                                                            <div class="comment-form-comment col-sm-12">
                                                                                <textarea class="form-control" placeholder="Comment" id="comment" name="comment" cols="40" rows="6" ></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-submit">
                                                                            <a class="btn btn-default-outline btn-outline" href="#">
                                                                                <span>Post Comment</span>
                                                                            </a>
                                                                        </div>
                                                                    @else
                                                                        <div class="row">
                                                                            <div class="comment-form-author col-sm-12">
                                                                                <input id="author" name="author" type="text" placeholder="Your name" class="form-control" value="" size="30" />
                                                                            </div>
                                                                            <div class="comment-form-email col-sm-12">
                                                                                <input id="email" name="email" type="text" placeholder="email@domain.com" class="form-control" value="" size="30" />
                                                                            </div>
                                                                            <div class="comment-form-comment col-sm-12">
                                                                                <textarea class="form-control" placeholder="Comment" id="comment" name="comment" cols="40" rows="6" ></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-submit">
                                                                            <a class="btn btn-default-outline btn-outline" href="#">
                                                                                <span>Post Comment</span>
                                                                            </a>
                                                                        </div>
                                                                    @endif
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="container">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="related products">
                                                <div class="related-title">
                                                    <h3><span>We know you will love</span></h3>
                                                </div>
                                                <ul class="products columns-4" data-columns="4">
                                                    <?php
                                                        $count = 0;
                                                    ?>
                                                    @foreach($products as $item)
                                                        @if ($count == 4)
                                                            @break
                                                        @endif
                                                        <li class="product product-no-border style-2">
                                                            <div class="product-container">
                                                                <figure>
                                                                    <div class="product-wrap">
                                                                        <div class="product-images">
                                                                            {{--<span class="onsale">Sale!</span>--}}
                                                                            <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                                                                                <a href="{{ route('product.detail', $item->slug) }}"><img width="450" height="450" src="{{ $item->image }}" alt=""/></a>
                                                                            </div>
                                                                            <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                                                                                <a href="{{ route('product.detail', $item->slug) }}"><img width="450" height="450" src="{{ $item->image }}" alt=""/></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <figcaption>
                                                                        <div class="shop-loop-product-info">
                                                                            <div class="info-meta clearfix">
                                                                                <div class="star-rating">
                                                                                    <span style="width:50%"></span>
                                                                                </div>
                                                                                <div class="loop-add-to-wishlist">
                                                                                    <div class="yith-wcwl-add-to-wishlist">
                                                                                        <div class="yith-wcwl-add-button">
                                                                                            <a href="javascript:void(0)" class="add_to_wishlist" data-id="{{ $item->id }}">
                                                                                                Add to Wishlist
                                                                                            </a>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="info-content-wrap">
                                                                                <h3 class="product_title">
                                                                                    <a href="{{ route('product.detail', $item->slug) }}">{{ $item->name }}</a>
                                                                                </h3>
                                                                                <div class="info-price">
                                                                                    <span class="price">
                                                                                        @if(isset($item->sale_price))
                                                                                            <del><span class="amount">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span></del>
                                                                                            <ins><span class="amount">{{ number_format($item->sale_price, 0, ',', '.') }} VNĐ</span></ins>
                                                                                        @else
                                                                                            <span class="amount">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>
                                                                                        @endif
                                                                                    </span>
                                                                                </div>
                                                                                <div class="loop-action">
                                                                                    <div class="loop-add-to-cart">
                                                                                        <a href="javascript:void(0)" class="add_to_cart_button" data-id="{{ $item->id }}">
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
                                                        <?php $count++; ?>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        (function ($) {
            $('ol.comments-list').load("{{ route('comment') }}");
        })(jQuery);
    </script>
@endsection