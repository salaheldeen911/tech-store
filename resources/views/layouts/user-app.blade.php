<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description"
        content="create ecommerce website template for your online store, responsive mobile templates">
    <meta name="keywords" content="ecommerce website templates, online store,">
    <title> Salah Online Tech Store </title>
    <!-- Bootstrap -->
    <link href={{ asset('css/bootstrap.min.css') }} rel="stylesheet">
    <link href={{ asset('css/bootstrap.4.3.1.min.css') }} rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="{{ asset('images/dashboard-logo.png') }}">

    <!-- Style CSS -->
    <link href={{ asset('css/style.css') }} rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- owl-carousel -->
    <link href={{ asset('css/owl.carousel.css') }} rel="stylesheet">
    <link href={{ asset('css/owl.theme.default.css') }} rel="stylesheet">
    <!-- FontAwesome CSS -->
    <link href={{ asset('css/font-awesome.min.css') }} rel="stylesheet">
    <link rel="stylesheet" href={{ asset('/css/spryValidator-V1.css') }}>
    <link href={{ asset('css/custom.css') }} rel="stylesheet">

    @stack('styles')
</head>

<body>
    @auth
        <x-nav-bar cart="{{ $cart }}" />
    @endauth
    @guest
        <x-nav-bar />
    @endguest

    @yield('content')


    <!-- footer -->
    <div class="footer">
        <div class="container">
            <div class="row">
                <!-- footer-company-links -->
                <!-- footer-contact links -->
                <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="footer-widget">
                        <h3 class="footer-title">Contact Info </h3>
                        <div class="contact-info">
                            <span class="contact-icon"><i class="fa fa-map-marker"></i></span>
                            <span class="contact-text">Muharam Bik,<br>
                                Alexandria
                                Egypt</span>
                        </div>
                        <div class="contact-info">
                            <span class="contact-icon"><i class="fa fa-phone"></i></span>
                            <span class="contact-text">+2-012-735-42-801</span>
                        </div>
                        <div class="contact-info">
                            <span class="contact-icon"><i class="fa fa-envelope"></i></span>
                            <span class="contact-text">salah.eldeen.mail@gmail.com</span>
                        </div>
                    </div>
                </div>
                <!-- /.footer-useful-links -->
                <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="footer-widget">
                        <h3 class="footer-title">Quick Links</h3>
                        <ul class="arrow">
                            <li><a href="{{ route('welcome') }}">Home </a></li>
                            <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                            <li><a href="{{ route('cart.index') }}">Cart</a></li>
                            <li><a href="{{ route('orders') }}">Orders</a></li>
                            <li><a href="{{ route('products') }}">All Products</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.footer-useful-links -->
                <!-- footer-policy-list-links -->
                <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="footer-widget">
                        <h3 class="footer-title">Skills</h3>
                        <ul class="arrow">
                            <li><a href="#">JavaScript</a></li>
                            <li><a href="#">JQUERY</a></li>
                            <li><a href="#">VueJS</a></li>
                            <li><a href="#">PHP</a></li>
                            <li><a href="#">Laravel</a></li>
                        </ul>
                    </div>
                </div>
                <!-- /.footer-policy-list-links -->
                <!-- footer-social links -->
                <div class=" col-lg-3 col-md-3 col-sm-3 col-xs-12">
                    <div class="footer-widget">
                        <h3 class="footer-title">Connect With Us</h3>
                        <div class="ft-social">
                            <span><a href="#" class="btn-social btn-facebook"><i
                                        class="fa fa-facebook"></i></a></span>
                            <span><a href="#" class="btn-social btn-twitter"><i
                                        class="fa fa-twitter"></i></a></span>
                            <span><a href="#" class="btn-social btn-googleplus"><i
                                        class="fa fa-google-plus"></i></a></span>
                            <span><a href="#" class=" btn-social btn-linkedin"><i
                                        class="fa fa-linkedin"></i></a></span>
                            <span><a href="#" class=" btn-social btn-instagram"><i
                                        class="fa fa-instagram"></i></a></span>
                        </div>
                    </div>
                </div>
                <!-- /.footer-social links -->
            </div>
        </div>
        <!-- tiny-footer -->
        <div class="tiny-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="payment-method alignleft">
                            <ul>
                                <li><a href="#"><i class="fa fa-cc-paypal fa-2x"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-mastercard  fa-2x"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-visa fa-2x"></i></a></li>
                                <li><a href="#"><i class="fa fa-cc-discover fa-2x"></i></a></li>
                            </ul>
                        </div>
                        <p class="alignright">Copyright © All Rights Reserved 2020 Template Design by
                            <a href="https://easetemplate.com/" target="_blank" class="copyrightlink">EaseTemplate</a>
                        </p>
                    </div>
                </div>
            </div>
            <!-- /. tiny-footer -->
        </div>
    </div>
    <!-- /.footer -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src={{ asset('js/jquery.min.js') }}></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src={{ asset('js/bootstrap.min.js') }}></script>
    <script src={{ asset('js/menumaker.js') }}></script>
    <script src={{ asset('js/jquery.sticky.js') }}></script>
    <script src={{ asset('js/sticky-header.js') }}></script>

    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $("#preloader").css("opacity", 0)
            }, 500)
        });
    </script>
    @stack('scripts')
</body>

</html>
