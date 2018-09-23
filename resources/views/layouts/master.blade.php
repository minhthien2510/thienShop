@php
    $countCart = 0;
    $subtotal = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $countCart += $item['quantity'];
            $subtotal += $item['quantity'] * $item['price'];
        }
    }
@endphp
<!doctype html>
<html lang="en-US">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - WOOW</title>
    <link rel="shortcut icon" href="http://sitesao.com/woow/electric/wp-content/uploads/2015/12/favicon.png">

    <link rel='stylesheet' href="{{ asset('public/front/css/bootstrap.min.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' href="{{ asset('public/front/css/swatches-and-photos.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' href="{{ asset('public/front/css/prettyPhoto.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' href="{{ asset('public/front/css/jquery.selectBox.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' href="{{ asset('public/front/css/font-awesome.min.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Karla:400,400italic,700,700italic%7CCrimson+Text:400,400italic,600,600italic,700,700italic' type='text/css' media='all'/>
    <link rel='stylesheet' href="{{ asset('public/front/css/elegant-icon.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' href="{{ asset('public/front/css/style.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' href="{{ asset('public/front/css/commerce.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' href="{{ asset('public/front/css/custom.css') }}" type='text/css' media='all'/>
    <link rel='stylesheet' href="{{ asset('public/front/css/magnific-popup.css') }}" type='text/css' media='all'/>

    <link href="{{ asset('public/admin/assets/css/icons.css') }}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<div class="offcanvas open">
    <div class="offcanvas-wrap">
        <div class="offcanvas-user clearfix">
            <a class="offcanvas-user-wishlist-link" href="{{ route('wishlist') }}">
                <i class="dripicons-heart{{ !empty($_SESSION['wishlist']) ? ' text-danger' : '' }}"></i> My Wishlist
            </a>
            <a class="offcanvas-user-account-link" href="{{ route('getLogin') }}">
                <i class="fa fa-user"></i> Login
            </a>
        </div>
        <nav class="offcanvas-navbar">
            <ul class="offcanvas-nav">
                <li class="menu-item-has-children dropdown current-menu-ancestor">
                    <a href="{{ route('home') }}" class="dropdown-hover">Home</a>
                    {{--<ul class="dropdown-menu">--}}
                        {{--<li><a href="home-v2.html">Home v2</a></li>--}}
                        {{--<li><a href="home-v3.html">Home v3</a></li>--}}
                        {{--<li><a href="home-v4.html">Home v4</a></li>--}}
                        {{--<li><a href="home-v5.html">Home v5</a></li>--}}
                    {{--</ul>--}}
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="javascript:void(0)" class="dropdown-hover">Shop <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li class="menu-item-has-children dropdown-submenu">
                            <a href="javascript:void(0)">Products</a>
                        </li>
                        <li class="menu-item-has-children dropdown-submenu">
                            <a href="javascript:void(0)">Brands <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @php
                                    $brands = \App\Brand::where('status', 1)->get();
                                    foreach ($brands as $item) {
                                        echo '<li><a href="' . route("brand", $item->slug) . '">' . $item->name . '</a></li>';
                                    }
                                @endphp
                            </ul>
                        </li>
                        <li class="menu-item-has-children dropdown-submenu">
                            <a href="javascript:void(0)">Categories <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                                @php
                                    $categories = \App\Category::where('status', 1)->get();
                                    foreach ($categories as $item) {
                                        echo '<li><a href="'. route("category", $item->slug) . '">' . $item->name . '</a></li>';
                                    }
                                @endphp
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#">Collections</a></li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-hover">Blog{{-- <span class="caret"> --}}</span></a>
                    {{-- <ul class="dropdown-menu">
                        <li><a href="blog-default.html">Blog Default</a></li>
                        <li><a href="blog-center.html">Blog Center</a></li>
                        <li><a href="blog-masonry.html">Blog Masonry</a></li>
                    </ul> --}}
                </li>
                <li class="menu-item-has-children dropdown">
                    <a href="#" class="dropdown-hover">Pages <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="about-us.html">About us</a></li>
                        <li><a href="contact-us.html">Contact Us</a></li>
                        <li><a href="faq.html">FAQ</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
<div id="wrapper" class="wide-wrap">
    <div class="offcanvas-overlay"></div>
    <header class="header-container header-type-classic header-navbar-classic header-scroll-resize">
        <div class="topbar" style="display: none;">
            <div class="container topbar-wap">
                <div class="row">
                    <div class="col-sm-6 col-left-topbar">
                        <div class="left-topbar">
                            Shop unique and handmade items directly
                            <a href="#">About<i class="fa fa-long-arrow-right"></i></a>
                        </div>
                    </div>
                    <div class="col-sm-6 col-right-topbar">
                        <div class="right-topbar">
                            <div class="user-login">
                                @if(Auth::check())
                                    {{--<div class="input-group-btn">--}}
                                        {{--<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                            {{--Action <span class="caret"></span></button>--}}
                                        {{--<ul class="dropdown-menu dropdown-menu-right">--}}
                                            {{--<li><a href="#">Action</a></li>--}}
                                            {{--<li><a href="#">Another action</a></li>--}}
                                            {{--<li><a href="#">Something else here</a></li>--}}
                                            {{--<li role="separator" class="divider"></li>--}}
                                            {{--<li><a href="#">Separated link</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                    <div>
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                                            Hi! {{ Auth::user()->email }} <span class="caret"></span>
                                        </a>
                                        <ul class="dropdown-menu">
                                            <li><a href="{{ route('cart') }}"><i class="fa fa-shopping-cart"></i> My cart</a></li>
                                            <li><a href="{{ route('wishlist') }}"><i class="fa fa-heart"></i> My Wishlist</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out"></i> Logout</a></li>
                                        </ul>
                                    </div>
                                @else
                                    <ul class="nav top-nav">
                                        <li class="menu-item"><a data-rel="loginModal" href="#"> Login </a></li>
                                        <li>/</li>
                                        <li class="menu-item"><a data-rel="registerModal" href="#"> Register </a></li>
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="navbar-container">
            <div class="navbar navbar-default navbar-scroll-fixed" style="background-color: #fff;">
                <div class="navbar-default-wrap">
                    <div class="container">
                        <div class="row">
                            <div class="navbar-default-col">
                                <div class="navbar-wrap">
                                    <div class="navbar-header">
                                        <button type="button" class="navbar-toggle">
                                            <span class="sr-only">Toggle navigation</span>
                                            <span class="icon-bar bar-top"></span>
                                            <span class="icon-bar bar-middle"></span>
                                            <span class="icon-bar bar-bottom"></span>
                                        </button>
                                        <a class="navbar-search-button search-icon-mobile" href="#">
                                            <i class="fa fa-search"></i>
                                        </a>
                                        <a class="cart-icon-mobile" href="{{ route('cart') }}">
                                            <i class="elegant_icon_bag"></i>
                                            <span class="cart-total">{{ $countCart }}</span>
                                        </a>
                                        <a class="navbar-brand" href="./">
                                            <img class="logo" alt="WOOW" src="{{ asset('public/front/images/logo.png') }}">
                                            <img class="logo-fixed" alt="WOOW" src="{{ asset('public/front/images/logo-fixed.png') }}">
                                            <img class="logo-mobile" alt="WOOW" src="{{ asset('public/front/images/logo-mobile.png') }}">
                                        </a>
                                    </div>
                                    <nav class="collapse navbar-collapse primary-navbar-collapse">
                                        <ul class="nav navbar-nav primary-nav">
                                            <li class="current-menu-item menu-item-has-children dropdown">
                                                <a href="{{ route('home') }}" class="dropdown-hover">
                                                    <span class="underline">Home</span> <span class="caret"></span>
                                                </a>
                                                {{--<ul class="dropdown-menu">--}}
                                                    {{--<li><a href="home-v2.html">Home v2</a></li>--}}
                                                    {{--<li><a href="home-v3.html">Home v3</a></li>--}}
                                                    {{--<li><a href="home-v4.html">Home v4</a></li>--}}
                                                    {{--<li><a href="home-v5.html">Home v5</a></li>--}}
                                                {{--</ul>--}}
                                            </li>
                                            <li class="menu-item-has-children megamenu megamenu-fullwidth dropdown">
                                                <a href="javascript:void(0)" class="dropdown-hover">
                                                    <span class="underline">Shop</span> <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li class="mega-col-3">
                                                        <h3 class="megamenu-title">Products</h3>
                                                        <div class="megamenu-sidebar">
                                                            <div class="widget widget_products commerce">
                                                                <ul class="product_list_widget">
                                                                    <?php
                                                                        $products = \App\Product::where('status', 1)->take(3)->get();
                                                                        $images = \App\Image::where('cover_image', 1)->get();
                                                                    ?>
                                                                    @foreach($products as $item)
                                                                    <li>
                                                                        <?php  ?>
                                                                        <a href="{{ route('product.detail', $item->slug) }}">
                                                                            @foreach($images as $img)
                                                                                @if($img->pro_id == $item->id)
                                                                                    <img src="{{ $img->name }}" alt="{{ $item->name }}"/>
                                                                                @endif
                                                                            @endforeach
                                                                            <span class="product-title">{{ $item->name }}</span>
                                                                        </a>
                                                                        <span class="amount">{{ number_format($item->price, 0, ',', '.') }} VND</span>
                                                                    </li>
                                                                    @endforeach
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    <li class="mega-col-3">
                                                        <h3 class="megamenu-title">Brands <span class="caret"></span></h3>
                                                        <ul class="dropdown-menu">
                                                            @php
                                                                $brands = \App\Brand::where('status', 1)->get();
                                                                foreach ($brands as $item) {
                                                                    echo '<li><a href="' . route("brand", $item->slug) . '">' . $item->name . '</a></li>';
                                                                }
                                                            @endphp
                                                        </ul>
                                                    </li>
                                                    <li class="mega-col-3">
                                                        <h3 class="megamenu-title">Categories <span class="caret"></span></h3>
                                                        <ul class="dropdown-menu">
                                                            @php
                                                                $categories = \Illuminate\Support\Facades\DB::table('categories')->where('status', 1)->get();
                                                            @endphp
                                                            @foreach($categories as $item)
                                                                <li><a href="{{ route('category', $item->slug) }}">{{ $item->name }}</a></li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    <li class="mega-col-3">
                                                        <h3 class="megamenu-title">Woo</h3>
                                                        <ul class="dropdown-menu">
                                                            <li><a href="#">My Account</a></li>
                                                            <li><a href="{{ route('cart') }}">Cart</a></li>
                                                            <li><a href="{{ route('checkout') }}">Checkout</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="#collection"><span class="underline">Collections</span></a></li>
                                            <li class="menu-item-has-children dropdown">
                                                <a href="#" class="dropdown-hover">
                                                    <span class="underline">Blog</span> <span class="caret"></span>
                                                </a>
                                                {{--<ul class="dropdown-menu">--}}
                                                    {{--<li><a href="blog-default.html">Blog Default</a></li>--}}
                                                    {{--<li><a href="blog-center.html">Blog Center</a></li>--}}
                                                    {{--<li><a href="blog-masonry.html">Blog Masonry</a></li>--}}
                                                {{--</ul>--}}
                                            </li>
                                            <li class="menu-item-has-children dropdown">
                                                <a href="#" class="dropdown-hover">
                                                    <span class="underline">Pages</span> <span class="caret"></span>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li><a href="#about-us.html">About us</a></li>
                                                    <li><a href="#contact-us.html">Contact Us</a></li>
                                                    <li><a href="#faq.html">FAQ</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </nav>
                                    <div class="header-right">
                                        <div class="navbar-search">
                                            <a class="navbar-search-button btn" href="#">
                                                <i class="dripicons-search"></i>
                                            </a>
                                            <div class="search-form-wrap show-popup hide"></div>
                                        </div>
                                        <div class="navbar-minicart navbar-minicart-topbar">
                                            <div class="navbar-minicart">
                                                <a class="minicart-link btn" href="#">
                                                    <span class="minicart-icon">
                                                        <i class="icon dripicons-cart"></i>
                                                        <span class="cart-total">{{ $countCart }}</span>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="navbar-wishlist">
                                            <a class="wishlist btn" href="{{ route('wishlist') }}">
                                                <i class="dripicons-heart{{ !empty($_SESSION['wishlist']) ? ' text-danger' : '' }}"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-search-overlay hide">
                    <div class="container">
                        <div class="header-search-overlay-wrap">
                            <form class="searchform">
                                <input type="search" class="searchinput" name="s" autocomplete="off" value="" placeholder="Search..."/>
                            </form>
                            <button type="button" class="close">
                                <span aria-hidden="true" class="fa fa-times"></span>
                                <span class="sr-only">Close</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    {{-- <div class="heading-container">
        <div class="container heading-standar">
            <div class="page-breadcrumb">
                <ul class="breadcrumb">
                    <li>
                        <span>
                            <a class="home" href="#">
                                <span>Home</span>
                            </a>
                        </span>
                    </li>
                    <li>
                        <span>@yield('title')</span>
                    </li>
                </ul>
            </div>
        </div>
    </div> --}}
    @yield('content')
    @include('layouts.footer')
</div>

<div class="modal fade user-login-modal" id="userloginModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="userloginModalForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Login</h4>
                </div>
                <div class="modal-body">
                    {{--<div class="user-login-facebook">--}}
                        {{--<button class="btn-login-facebook" type="button">--}}
                            {{--<i class="fa fa-facebook"></i> Sign in with Facebook--}}
                        {{--</button>--}}
                    {{--</div>--}}
                    {{--<div class="user-login-or"><span>or</span></div>--}}
                    <div class="error"></div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="email" name="log" class="form-control" value="" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" value="" name="pwd" class="form-control" placeholder="Password">
                    </div>
                    <div class="checkbox clearfix">
                        <label class="form-flat-checkbox pull-left">
                            <input type="checkbox" name="remember" id="remember" value="false">
                            <i></i>&nbsp;Remember Me
                        </label>
                        <span class="lostpassword-modal-link pull-right">
                            <a href="#lostpasswordModal" data-rel="lostpasswordModal">Lost your password?</a>
                        </span>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="user-login-modal-register pull-left">
                        <a data-rel="registerModal" href="#">Not a Member yet?</a>
                    </span>
                    <button type="button" id="login" class="btn btn-primary rounded">Sign in</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade user-register-modal" id="userregisterModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="userregisterModalForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Register account</h4>
                </div>
                <div class="modal-body">
                    {{--<div class="user-login-facebook">--}}
                        {{--<button class="btn-login-facebook" type="button">--}}
                            {{--<i class="fa fa-facebook"></i> Sign in with Facebook--}}
                        {{--</button>--}}
                    {{--</div>--}}
                    {{--<div class="user-login-or"><span>or</span></div>--}}
                    <div class="form-group email">
                        <label for="user_email">Email</label>
                        <input type="email" id="email-r" required class="form-control" value="" placeholder="Email">
                        <span class="errorEmail help-block"></span>
                    </div>
                    <div class="form-group password">
                        <label for="user_password">Password</label>
                        <input type="password" id="password-r" required value="" class="form-control" placeholder="Password">
                        <span class="errorPassword help-block"></span>
                    </div>
                    <div class="form-group passwordConfirm">
                        <label for="user_password">Retype password</label>
                        <input type="password" id="re_password" required value="" class="form-control" placeholder="Retype password">
                        <span class="errorPasswordConfirm help-block"></span>
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="user-login-modal-link pull-left">
                        <a data-rel="loginModal" href="#loginModal">Already have an account?</a>
                    </span>
                    <button type="button" id="register" class="btn btn-primary btn-rounded rounded">Register</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade user-lostpassword-modal" id="userlostpasswordModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="userlostpasswordModalForm">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title">Forgot Password</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>E-mail:</label>
                        <input type="text" name="user_login" required class="form-control" value="" placeholder="E-mail">
                    </div>
                </div>
                <div class="modal-footer">
                    <span class="user-login-modal-link pull-left">
                        <a data-rel="loginModal" href="#loginModal">Already have an account?</a>
                    </span>
                    <button type="button" class="btn btn-primary rounded">Reset</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="minicart-side">
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
                        {{--<a class="button no-item-button" href="{{ route('home') }}">--}}
                            {{--<span class="text">Go to the shop</span>--}}
                        {{--</a>--}}
                    {{--</div>--}}
                {{--</div> --}}
            @else
                <div class="minicart-header">
                    {{$countCart}} items in the shopping cart
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
                    <div class="minicart-actions clearfix ss" style="display: block !important;">
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
</div>

<script type='text/javascript' src="{{ asset('public/front/js/jquery.js') }}"></script>
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type='text/javascript' src="{{ asset('public/front/js/jquery-migrate.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/easing.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/imagesloaded.pkgd.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/bootstrap.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/superfish-1.7.4.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/jquery.appear.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/script.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/swatches-and-photos.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/jquery.cookie.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/jquery.prettyPhoto.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/jquery.prettyPhoto.init.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/jquery.selectBox.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/jquery.touchSwipe.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/jquery.transit.min.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/jquery.carouFredSel.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/jquery.magnific-popup.js') }}"></script>
<script type='text/javascript' src="{{ asset('public/front/js/isotope.pkgd.min.js') }}"></script>

<script type='text/javascript' src="{{ asset('public/front/js/price-slider.js') }}"></script>

<script type="text/javascript" src="{{ asset('public/front/js/login-register.js') }}"></script>
<script type="text/javascript" charset="utf-8">
    jQuery.noConflict();
    (function( $ ) {
        {{--$('.minicart-side').load("{{ route('mini-cart') }}");--}}

        $('#login').click(function() {
            $.post(
                "{{ route('loginAjax') }}",
                { email: $('#email').val(), password: $('#password').val(), remember: $('#remember').val() },
                function( data ) {
                    console.log(data);
                    if(data == 'success'){
                        console.log(data);
                        location.reload();
                    } else {
                        $('.error').addClass('alert alert-danger').html("Invalid email/password combination");
                    }
                }
            )
        });

        $('.add_to_cart_button').click(function () {
            $('.add_to_cart_button').addClass('btn disabled');
            var id = $(this).data('id');
            if ($(this).hasClass('button'))
                var quantity = $("input[name='quantity']").val();
            else
                var quantity = 1;

            $.post(
                "{{ route('addCart') }}",
                { id: id, quantity: quantity },
                function( data ) {
                    console.log(data);
                    var count = 0;
                    var amount = 0;
                    $.each(data, function (index, array) {
                        $.each(array, function (key, value) {
                            if (key == 'quantity')
                                count += parseInt(value);
                        });
                        amount += array.quantity * array.price;
                    });
                    $('.cart-total').html(count);
                    {{--$('.minicart-side').load("{{ route('mini-cart') }}");--}}

                    var cart = '<div class="minicart-header">' + count + ' items in the shopping cart</div>';
                    $.each(data, function (index, array) {
                        cart += '<div class="minicart-body">'+
                            '<div class="cart-product clearfix">' +
                            '<div class="cart-product-image">' +
                            '<a class="cart-product-img" href="/laravel/product/' + array.slug + '">' +
                            '<img width="300" height="300" src="' + array.img + '" width="60px" alt=""/>' +
                            '</a>' +
                            '</div>' +
                            '<div class="cart-product-details">' +
                            '<div class="cart-product-title">' +
                            '<a href="/laravel/product/' + array.slug + '">' + array.name + '</a>' +
                            '</div>' +
                            '<div class="cart-product-quantity-price">' +
                            array.quantity + ' x <span class="amount">' + Number(parseInt(array.price).toFixed(1)).toLocaleString() + '&dstrok;</span>' +
                            '</div>' +
                            '</div>' +
                            '<a href="javascript:void(0)" class="remove remove_from_cart" data-id="' + array.id + '" title="Remove this item">&times;</a>' +
                            '</div>' +
                            '</div>';
                    });
                    cart += '<div class="minicart-footer">' +
                        '<div class="minicart-total">' +
                        'Cart Subtotal <span class="amount">' + Number(amount.toFixed(1)).toLocaleString() + ' &Dstrok;</span>' +
                        '</div>' +
                        '<div class="minicart-actions clearfix dd">' +
                        '<a class="viewcart-button button rounded" href="/cart">' +
                        '<span class="text">View Cart</span>' +
                        '</a>' +
                        '<a class="checkout-button button rounded" href="/checkout">' +
                        '<span class="text">Checkout</span>' +
                        '</a>' +
                        '</div>' +
                        '</div>';
                    $('.minicart').html(cart);
                    $('.add_to_cart_button').removeClass('disabled');
                });
        });

        $('body').on('click', '.remove_from_cart', function() {
            var id = $(this).data('id');
            $.post(
                "{{ route('removeCart') }}",
                { id: id },
                function (data) {
                    console.log(data);
                    {{--$('.minicart-side').load("{{ route('mini-cart') }}");--}}

                    var count = 0;
                    var amount = 0;
                    $.each(data, function (index, array) {
                        $.each(array, function (key, value) {
                            if (key == 'quantity')
                                count += parseInt(value);
                        });
                        amount += array.quantity * array.price;
                    });
                    $('.cart-total').html(count);

                    var cart = '';
                    if(data == '') {
                        cart = '<div class="minicart-header no-items show">Your shopping bag is empty.</div>'
                    } else {
                        cart = '<div class="minicart-header">' + count + ' items in the shopping cart</div>';
                        $.each(data, function (index, array) {
                            cart +=
                                '<div class="minicart-body">'+
                                '<div class="cart-product clearfix">' +
                                '<div class="cart-product-image">' +
                                '<a class="cart-product-img" href="/laravel/product/' + array.slug + '">' +
                                '<img width="300" height="300" src="' + array.img + '" width="60px" alt=""/>' +
                                '</a>' +
                                '</div>' +
                                '<div class="cart-product-details">' +
                                '<div class="cart-product-title">' +
                                '<a href="/laravel/product/' + array.slug + '">' + array.name + '</a>' +
                                '</div>' +
                                '<div class="cart-product-quantity-price">' +
                                array.quantity + ' x <span class="amount">' + array.price + '&dstrok;</span>' +
                                '</div>' +
                                '</div>' +
                                '<a href="javascript:void(0)" class="remove remove_from_cart" data-id="' + array.id + '" title="Remove this item">&times;</a>' +
                                '</div>' +
                                '</div>';
                        });
                        cart += '<div class="minicart-footer">' +
                            '<div class="minicart-total">' +
                            'Cart Subtotal <span class="amount">' + amount + '&Dstrok;</span>' +
                            '</div>' +
                            '<div class="minicart-actions clearfix">' +
                            '<a class="viewcart-button button rounded" href="/cart">' +
                            '<span class="text">View Cart</span>' +
                            '</a>' +
                            '<a class="checkout-button button rounded" href="/checkout">' +
                            '<span class="text">Checkout</span>' +
                            '</a>' +
                            '</div>' +
                            '</div>';
                    }
                    $('.minicart').html(cart);
                });
        });

        $('.add_to_wishlist').click(function () {
            if ($(this).hasClass('red'))
                $(this).removeClass('red');
            else
                $(this).addClass('red');

            var id = $(this).data('id');

            $.post(
                "{{ route('addWishList') }}",
                { id: id },
                function (data) {
                    console.log(data);
                    if (data != '') {
                        $('.dripicons-heart').addClass('text-danger');
                    } else {
                        $('.dripicons-heart').removeClass('text-danger');
                    }
                });
        });

        if ($(location).attr('pathname') != '/login' &&
            window.location.pathname != '/register' &&
            window.location.pathname != '/checkout') {
            $('.topbar').removeAttr('style');
        }
        
        $("body div:last").hide();
    })(jQuery);
</script>

@yield('scripts')

</body>
</html>
