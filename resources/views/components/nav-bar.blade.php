<div>
    <!-- top-header-->
    <div id="preloader"></div>
    <div class="top-header">
        <div class="container-fluid">
            <div style="display:flex;justify-content:space-between;">
                <div class="hidden-sm hidden-xs">
                    <p class="top-text">Flexible & Fast</p>
                </div>
                <div class="header-contact">
                    <ul style="display:flex;justify-content:space-between;">
                        @guest
                            <li class="hidden-xs">
                                <a href="{{ route('admin-register') }}" class="top-text">Be an admin</a>
                            </li>
                        @endguest
                        <li>+201273542801</li>
                        <li>salah.eldeen.mail@gmial.com</li>
                    </ul>
                </div>
            </div>
            <!-- /.top-header-->
        </div>
    </div>
    <!-- header-section-->
    <div class="header-wrapper">
        <div class="container">
            <div class="row">
                <nav class="col-xs-12">
                    <div class="header_container">
                        <!-- logo -->
                        <div id="logo" class="logo">
                            <a href="{{ route('welcome') }}"><img src="{{ asset('images/logo.png') }}" alt="">
                            </a>
                        </div>
                        <div class="account-section" style='width:100%;'>
                            <ul style="display:flex; align-items:center; float: right;">
                                @guest
                                    @if (Route::has('login'))
                                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                                    @endif

                                    @if (Route::has('register'))
                                        <li><a href="{{ route('register') }}">{{ __('Sign Up') }}</a></li>
                                    @endif
                                    <li>
                                        <a href="{{ route('cart.index') }}" class="title p-0">
                                            <i class="fa fa-shopping-cart"></i>
                                            <sup class="cart-quantity">0</sup>
                                        </a>
                                    </li>
                                @endguest

                                @auth
                                    <li><a href="{{ route('orders') }}" class="title">My Orders</a></li>
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                    <li>
                                        <a href="{{ route('cart.index') }}" class="title p-0">
                                            <i class="fa fa-shopping-cart"></i>
                                        </a>
                                        <a href="{{ route('cart.index') }}" class="title p-0">
                                            <sup id="cartQuantity" class="cart-quantity"> {{ $cart->products->count() }}
                                            </sup>
                                        </a>
                                    </li>
                                @endauth
                            </ul>
                        </div>
                    </div>

                </nav>
                <!-- /.logo -->
                <!-- search -->
                <div class="col-xs-12">
                    <form action="{{ route('filter') }}">
                        <div class="search-bg mb-4">
                            <input type="text" name="name" class="form-control" placeholder="Search By Anything">
                            <button type="Submit"><i class="fa fa-search"></i></button>
                        </div>
                    </form>
                </div>
                <!-- /.search -->

            </div>
        </div>
        <!-- navigation -->
        <div class="navigation">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- navigations-->
                        <div id="navigation" style="margin-left: 1.5%">
                            <ul>
                                <li class="active"><a href="{{ route('welcome') }}">Home</a></li>
                                <li><a href="{{ route('products') }}">Products</a></li>
                                <li><a href="{{ route('orders') }}">Orders</a></li>
                                <li><a href="{{ route('cart.index') }}">Cart</a></li>
                                <li><a style="position: relative;" href="{{ route('wishlist') }}">
                                        <i class="shopping-icon fa fa-heart wish_list_icon"></i> Wish list
                                    </a></li>

                                <li class="has-sub"><a href="#">All</a>
                                    <ul>
                                        <li><a href="{{ route('products') }}">Products</a></li>
                                        <li><a href="{{ route('orders') }}">Orders</a></li>
                                        <li><a style="position: relative;" href="{{ route('wishlist') }}">Wish
                                                list</a></li>
                                        <li><a href="{{ route('cart.index') }}">Cart</a></li>

                                    </ul>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <!-- /.navigations-->
                </div>
            </div>
        </div>
    </div>
    <!-- /. header-section-->
</div>
