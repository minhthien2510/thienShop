@extends('layouts.master')

@section('title', $brand->name)

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
                    <span>{{ $brand->name }}</span>
                </li>
            </ul>
        </div>
    </div>
</div>
<div class="content-container commerce page-layout-left-sidebar">
    <div class="container">
        <div class="row">
            <div class="col-md-9 main-wrap">
                <div class="main-content">
                    <div class="shop-toolbar">
                        <form class="commerce-ordering clearfix">
                            <div class="commerce-ordering-select">
                                <label class="hide">Sorting:</label>
                                <div class="form-flat-select">
                                    <select name="orderby" class="orderby">
                                        <option value="" selected='selected'>Default sorting</option>
                                        <option value="">Sort by popularity</option>
                                        <option value="">Sort by average rating</option>
                                        <option value="">Sort by newness</option>
                                        <option value="">Sort by price: low to high</option>
                                        <option value="">Sort by price: high to low</option>
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                            <div class="commerce-ordering-select">
                                <label class="hide">Show:</label>
                                <div class="form-flat-select">
                                    <select name="per_page" class="per_page">
                                        <option value="" selected='selected'>12</option>
                                        <option value="">24</option>
                                        <option value="">36</option>
                                    </select>
                                    <i class="fa fa-angle-down"></i>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="shop-loop grid">
                        <ul class="products">
                            @foreach ($products as $item)
                            <li class="product product-no-border style-2 col-md-3 col-sm-6">
                                <div class="product-container">
                                    <figure>
                                        <div class="product-wrap">
                                            <div class="product-images">
                                                @if(isset($item->sale_price))
                                                <span class="onsale">Sale!</span>
                                                @endif
                                                <div class="shop-loop-thumbnail shop-loop-front-thumbnail">
                                                    @foreach ($images as $img)
                                                        @if ($img->pro_id == $item->id)
                                                            <a href="{{ route('product.detail', $item->slug) }}"><img width="450" height="450" src="{{ $img->name }}" alt="{{  $item->name }}"/></a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <div class="shop-loop-thumbnail shop-loop-back-thumbnail">
                                                    @foreach ($images as $img)
                                                        @if ($img->pro_id == $item->id)
                                                            <a href="{{ route('product.detail', $item->slug) }}"><img width="450" height="450" src="{{ $img->name }}" alt="{{  $item->name }}"/></a>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        <figcaption>
                                            <div class="shop-loop-product-info">
                                                <div class="info-meta clearfix">
                                                    <div class="star-rating">
                                                        <span style="width:{{ random_int(0, 100) }}%"></span>
                                                    </div>
                                                    <div class="loop-add-to-wishlist">
                                                        <div class="yith-wcwl-add-to-wishlist">
                                                            <div class="yith-wcwl-add-button">
                                                                <?php
                                                                if (empty($_SESSION['wishlist']))
                                                                    $s = 0;
                                                                else {
                                                                    $s = 0;
                                                                    foreach ($_SESSION['wishlist'] as $key => $value)
                                                                        if($value == $item->id)
                                                                            $s = 1;
                                                                }
                                                                ?>
                                                                <a href="javascript:void(0)" class="add_to_wishlist{{ $s==1 ? ' red' : '' }}" data-id="{{ $item->id }}"></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="info-content-wrap">
                                                    <h3 class="product_title">
                                                        <a href="shop-detail-1.html">{{ $item->name }}</a>
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
                            @endforeach
                        </ul>
                    </div>
                    <nav class="commerce-pagination">
                        <div class="paginate">
                            <div class="paginate_links">
                                {{ $products->links() }}
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="col-md-3 sidebar-wrap">
                <div class="main-sidebar">
                    <div class="widget commerce widget_product_search">
                        <h4 class="widget-title">
                            <span>Product Search</span>
                        </h4>
                        <form class="commerce-product-search">
                            <label class="screen-reader-text" for="s">Search for:</label>
                            <input type="search" class="search-field rounded" placeholder="Search Products&hellip;" value="" name="s"/>
                            <input type="submit" value="Search"/>
                        </form>
                    </div>
                    <div class="widget widget_price_filter">
                        <h4 class="widget-title"><span>Price</span></h4>
                        <form>
                            <div class="price_slider_wrapper">
                                <div class="price_slider"></div>
                                <div class="price_slider_amount">
                                    <input type="text" id="min_price" name="min_price" value="" data-min="1000" placeholder="Min price"/>
                                    <input type="text" id="max_price" name="max_price" value="" data-max="1000000000" placeholder="Max price"/>
                                    <button type="submit" class="button">Filter</button>
                                    <div class="price_label">
                                        Price: <span class="from"></span> &mdash; <span class="to"></span>
                                    </div>
                                    <div class="clear"></div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="widget widget_layered_nav">
                        <h4 class="widget-title"><span>Brands</span></h4>
                        <ul>
                            @foreach($brands as $item)
                            <li>
                                <a href="{{ route('brand', $item->slug) }}">{{ $item->name }}</a> <small class="count">{{ random_int(1, 9) }}</small>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget widget_product_categories">
                        <h4 class="widget-title"><span>Categories</span></h4>
                        <ul class="product-categories">
                            @foreach($categories as $item)
                            <li>
                                <a href="{{ route('category', $item->slug) }}">{{ $item->name }}</a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget widget_products">
                        <h4 class="widget-title"><span>Best Sellers</span></h4>
                        <ul class="product_list_widget">
                            @foreach($products as $item)
                            @if(isset($item->sale_price))
                            <li>
                                <a href="{{ route('product.detail', $item->slug) }}">
                                    @foreach ($images as $img)
                                    @if ($img->pro_id == $item->id && $img->cover_image == 1)
                                    <img width="200" height="200" src="{{ $img->name }}" alt="$item->name"/>
                                    @break;
                                    @endif
                                    @endforeach
                                    <span class="product-title">{{ $item->name }}</span>
                                </a>
                                @if(isset($item->sale_price))
                                <del><span class="amount">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span></del>
                                <ins><span class="amount">{{ number_format($item->sale_price, 0, ',', '.') }} VNĐ</span></ins>
                                @else
                                <span class="amount">{{ number_format($item->price, 0, ',', '.') }} VNĐ</span>
                                @endif
                            </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection