@extends('layouts.user-app')

@push('styles')
    {{-- <link rel="stylesheet" href="{{ asset('css/user/products/show.css') }}"> --}}

    <style>
        a.page-link,
        span.page-link {
            font-size: large !important;
            padding: 10px !important;
            line-height: 1 !important;
            margin: 5px !important;
        }

        .like-erorr {
            display: none;
            color: red;
            font-size: 14px;
        }

        a.product {
            color: #000;
            text-decoration: none;
            width: 100%;
            height: 100%;
        }

        .icon_holder.liked i {
            font-size: 22px;
            color: #e51376;
        }

        .like_icon_container {
            width: 40px;
            position: relative;
        }

        .likesNum {
            position: absolute;
            bottom: 12%;
            left: 100%;
        }

        .shopping-icon {
            font-size: 21px;
            color: #848687
        }

        .shopping-icon:hover {
            font-size: 22px;
            color: #e51376;
        }

        .likes {
            display: flex;
            justify-content: space-around;
            align-items: center;
            width: 50px;
            margin: 0 auto;
        }

        .shopping-icon.fa.fa-heart,
        .shopping-icon.fa.fa-shopping-cart {
            cursor: pointer;
        }

        .btn_filter {
            background: #0cafe5;
            border: 1px solid #e5e5e5;
            border-radius: 5px;
            padding: 8px 10px;
            color: #fff;
            font-size: 14px;
            margin: 10px 0;
            font-weight: 700;
            font-size: 20px
        }

        .discount::before {
            content: attr(data-ribbon);
            position: absolute;
            font-size: 16px;
            top: 0;
            right: 0;
            transform: translate(29.29%, -100%) rotate(45deg);
            color: #fff;
            text-align: center;
            border: 1px solid transparent;
            border-bottom: 0;
            transform-origin: bottom left;
            padding: 5px 30px;
            background: linear-gradient(rgba(0, 0, 0, 0.5) 0 0) bottom/100% 6px no-repeat blue;
            background-clip: padding-box;
            clip-path: polygon(0 0, 100% 0, 100% 100%, calc(100% - 6px) calc(100% - 6px), 6px calc(100% - 6px), 0 100%);
            -webkit-mask: linear-gradient(135deg, transparent calc(50% - 6px * 0.707), #fff 0) bottom left,
                linear-gradient(-135deg, transparent calc(50% - 6px * 0.707), #fff 0)bottom right;
            -webkit-mask-size: 300vmax 300vmax;
            -webkit-mask-composite: destination-in;
            mask-composite: intersect;
            z-index: 1;
        }


        .range-slider {
            height: 5px;
            position: relative;
            background-color: #e1e9f6;
            border-radius: 2px;
        }

        .range-selected {
            height: 100%;
            left: 0;
            right: 0;
            position: absolute;
            border-radius: 5px;
            background-color: #1b53c0;
        }

        .range-input {
            position: relative;
        }

        .range-input input {
            position: absolute;
            width: 100%;
            height: 5px;
            top: -7px;
            background: none;
            pointer-events: none;
            -webkit-appearance: none;
            -moz-appearance: none;
        }

        .range-input input::-webkit-slider-thumb {
            height: 20px;
            width: 20px;
            border-radius: 50%;
            border: 3px solid #1b53c0;
            background-color: #fff;
            pointer-events: auto;
            -webkit-appearance: none;
        }

        .range-input input::-moz-range-thumb {
            height: 15px;
            width: 15px;
            border-radius: 50%;
            border: 3px solid #1b53c0;
            background-color: #fff;
            pointer-events: auto;
            -moz-appearance: none;
        }

        .range-price {
            margin: 30px 0;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .range-price label {
            margin-right: 5px;
        }

        .range-price input {
            width: 70px;
            padding: 5px;
        }

        .range-price input:first-of-type {
            margin-right: 15px;
        }

        .ribbon-wrapper {
            width: 85px;
            height: 88px;
            overflow: hidden;
            position: absolute;
            top: -3px;
            left: -3px;
        }

        .ribbon-wrapper .ribbon {
            font: bold 15px sans-serif;
            color: #333;
            text-align: center;
            -webkit-transform: rotate(-45deg);
            -moz-transform: rotate(-45deg);
            -ms-transform: rotate(-45deg);
            -o-transform: rotate(-45deg);
            position: relative;
            padding: 7px 0;
            top: 15px;
            left: -30px;
            width: 120px;
            background-color: #e51376;
            color: #fff;
        }
    </style>
@endpush

@section('content')
    <!-- page-header -->
    <div class="page-header">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="page-breadcrumb">
                        <ol class="breadcrumb">
                            <li><a href="{{ route('welcome') }}">Home</a></li>
                            <li>Product List</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.page-header-->
    <!-- product-list -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
                    <form action="{{ route('filter') }}" method="GET">
                        <!-- sidenav-section -->
                        <div id='cssmenu'>
                            <ul>
                                <li class='has-sub'><a href='#'>CATEGORY
                                        (<span>{{ count($categories) }}</span>)</a>
                                    <ul class="filterUl">
                                        @foreach ($categories as $category)
                                            <li>
                                                <label>
                                                    <input name='category[]' value='{{ $category->id }}' type="checkbox"
                                                        {{ @$response['category'] ? (in_array($category->id, @$response['category']) ? 'checked' : '') : '' }}>
                                                    <span class="checkbox-list">{{ $category->name }} </span>
                                                </label>

                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'>Brand
                                        (<span>{{ count($brands) }}</span>)</a>
                                    <ul class="filterUl">
                                        @foreach ($brands as $brand)
                                            <li>
                                                <label>
                                                    <input name='brand[]' value='{{ $brand->id }}' type="checkbox"
                                                        {{ @$response['brand'] ? (in_array($brand->id, @$response['brand']) ? 'checked' : '') : '' }}>
                                                    <span class="checkbox-list">{{ $brand->name }}
                                                </label>

                                                </span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                                <li class='has-sub'><a href='#'>Price Range</a>
                                    <ul class="filterUl">
                                        <li style="padding: 0 10px 10px;">
                                            <div class="range">
                                                <div class="range-slider">
                                                    <span class="range-selected"></span>
                                                </div>
                                                <div class="range-input">
                                                    <input type="range" class="min" min="0" max="20000"
                                                        value="{{ @$response['priceRange'][0] ? $response['priceRange'][0] : 0 }}"
                                                        step="200">
                                                    <input type="range" class="max" min="0" max="20000"
                                                        value="{{ @$response['priceRange'][1] ? $response['priceRange'][1] : 20000 }}"
                                                        step="200">
                                                </div>
                                                <div class="range-price"
                                                    style="justify-content: space-around; align-items:center">
                                                    <div
                                                        style="display:flex;flex-direction: column;justify-content: center; align-items:center">
                                                        <h4 for="min">Min</h4>
                                                        <strong id="minResult"
                                                            style="display:inline">{{ @$response['priceRange'][0] ? $response['priceRange'][0] : 0 }}</strong>
                                                    </div>

                                                    <div
                                                        style="display:flex;flex-direction: column;justify-content: center; align-items:center">
                                                        <h4 for="max">Max</h4>
                                                        <strong id="maxResult"
                                                            style="display:inline">{{ @$response['priceRange'][1] ? $response['priceRange'][1] : 20000 }}</strong>
                                                    </div>

                                                    <input style="display: none" type="number" name="priceRange[]"
                                                        value="{{ @$response['priceRange'][0] ? $response['priceRange'][0] : 0 }}">
                                                    <input style="display: none" type="number" name="priceRange[]"
                                                        value="{{ @$response['priceRange'][1] ? $response['priceRange'][1] : 20000 }}">
                                                </div>
                                            </div>
                                        </li>
                                    </ul>

                                </li>
                                <li class='has-sub'><a href='#'>Ordered By (<span>3</span>)</a>
                                    <ul class="filterUl">
                                        <li>
                                            <label>
                                                <input name="sort" value="" type="radio" checked>
                                                <span class="radio-list">Rundom</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input name="sort" value="desc" type="radio"
                                                    {{ @$response['sort'] == 'desc' ? 'checked' : '' }}>
                                                <span class="radio-list">High Price</span>
                                            </label>
                                        </li>
                                        <li>
                                            <label>
                                                <input name="sort" value="asc" type="radio"
                                                    {{ @$response['sort'] == 'asc' ? 'checked' : '' }}>
                                                <span class="radio-list">Low Price</span>
                                            </label>
                                        </li>
                                    </ul>
                                </li>
                            </ul>
                            <button id="filterSubmit" type="submit" class="btn_filter">Filter</button>
                        </div>
                        <!-- /.sidenav-section -->
                    </form>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
                    <div class="row">
                        @if (!$products->isEmpty())
                            @foreach ($products as $product)
                                <!-- product -->
                                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 mb30 pr-0">
                                    <x-user.welcome.product-component :product="$product" />
                                </div>

                                <!-- /.product -->
                            @endforeach
                        @else
                            <div class="no_products" style="position:absolute; top:33%; left:33%;">
                                No products match your filters
                            </div>
                        @endif

                    </div>
                    {{ $products->links('pagination::bootstrap-4') }}

                </div>
            </div>
        </div>
    </div>
    <!-- /.product-list -->
@endsection

@push('scripts')
    <script src={{ asset('js/owl.carousel.min.js') }}></script>
    <script src={{ asset('js/multiple-carousel.js') }}></script>
    <script>
        $(document).on('click', '.pagination li a', function(e) {
            e.preventDefault();
            if ($(this).attr('href')) {
                var queryString = '';
                var allQueries = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                if (allQueries[0].split('=').length > 1) {
                    for (var i = 0; i < allQueries.length; i++) {
                        var hash = allQueries[i].split('=');
                        if (hash[0] !== 'page') {
                            queryString += '&' + hash[0] + '=' + hash[1];
                        }
                    }
                }
                window.location.replace($(this).attr('href') + queryString);
            }
        });

        $(document).ready(function() {
            // hide the numbers of likes if equal 0
            $('.likesNum').each(function() {
                this.innerText == 0 ? this.style.display = "none" : this.style.display = "unset";
            });
        });
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        function likeFunction(likeBtn) {
            let productId = likeBtn.dataset.product;
            let url = `${$(likeBtn).hasClass('liked') ? 'dislike' : 'like'}/${productId}`;
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    "product_id": productId
                },
                dataType: 'JSON',
                success: function(res) {
                    if (res.success) {
                        handelLike(likeBtn);
                    }
                }
            });
        }

        function cart(cartBtn) {
            let productId = cartBtn.dataset.product;
            let url = "";
            let method = "POST";
            if (!$(cartBtn).hasClass('liked')) {
                url = `cart`;
            } else {
                url = `cart/${productId}`;
                method = "DELETE";
            }
            $.ajax({
                url: url,
                method: method,
                dataType: 'JSON',
                data: {
                    _token: CSRF_TOKEN,
                    "product_id": cartBtn.dataset.product,
                    "cart_id": cartBtn.dataset.cart,
                    "total": cartBtn.dataset.price
                },
                success: function(res) {
                    console.log(res);
                    $("#cartQuantity").text(res.cartQuantity);
                    cartBtn.classList.toggle("liked");
                }
            });
        }

        function handelLike(likeBtn) {
            let likesNumContainer = $(likeBtn).parent().find('.likesNum');
            if ($(likeBtn).hasClass('liked')) {
                let likesNum = parseInt(likesNumContainer.text(), 10) - 1;
                likesNumContainer.text(likesNum);
                likesNumContainer.text() == 0 ? likesNumContainer.hide() : likesNumContainer.show()
            } else {
                let likesNum = parseInt(likesNumContainer.text(), 10) + 1;
                likesNumContainer.text(likesNum);
                likesNumContainer.show()
            }

            likeBtn.classList.toggle("liked");
        }

        function likeErorr(likeIcon) {
            $(likeIcon).parent().parent().parent().find('.like-erorr').fadeIn(1000);
            $(likeIcon).parent().parent().parent().find('.like-erorr').fadeOut(1000);
        }
    </script>
    <script>
        (function($) {
            $(document).ready(function() {
                $('#cssmenu ul ul li:odd').addClass('odd');
                $('#cssmenu ul ul li:even').addClass('even');
                $('#cssmenu > ul > li > a').click(function() {
                    $('#cssmenu li').removeClass('active');
                    $(this).closest('li').addClass('active');
                    var checkElement = $(this).next();
                    if ((checkElement.is('ul')) && (checkElement.is(':visible'))) {
                        $(this).closest('li').removeClass('active');
                        checkElement.slideUp('normal');
                    }
                    if ((checkElement.is('ul')) && (!checkElement.is(':visible'))) {
                        $('#cssmenu ul ul:visible').slideUp('normal');
                        checkElement.slideDown('normal');
                    }
                    if ($(this).closest('li').find('ul').children().length == 0) {
                        return true;
                    } else {
                        return false;
                    }
                });
            });
        })(jQuery);

        let rangeMin = 500;
        let minResult = document.getElementById('minResult');
        let maxResult = document.getElementById('maxResult');
        const range = document.querySelector(".range-selected");
        const rangeInput = document.querySelectorAll(".range-input input");
        const rangePrice = document.querySelectorAll(".range-price input");

        rangeInput.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minRange = parseInt(rangeInput[0].value);
                let maxRange = parseInt(rangeInput[1].value);
                if (maxRange - minRange < rangeMin) {
                    if (e.target.className === "min") {
                        rangeInput[0].value = maxRange - rangeMin;
                        minResult.innerText = maxRange - rangeMin
                    } else {
                        rangeInput[1].value = minRange + rangeMin;
                        maxResult.innerText = minRange + rangeMin
                    }
                } else {
                    rangePrice[0].value = minRange;
                    minResult.innerText = minRange
                    rangePrice[1].value = maxRange;
                    maxResult.innerText = maxRange
                    range.style.left = (minRange / rangeInput[0].max) * 100 + "%";
                    range.style.right = 100 - (maxRange / rangeInput[1].max) * 100 + "%";
                }
                console.log(rangePrice[0].value, rangePrice[1].value);
            });
        });

        rangePrice.forEach((input) => {
            input.addEventListener("input", (e) => {
                let minPrice = rangePrice[0].value;
                let maxPrice = rangePrice[1].value;
                if (maxPrice - minPrice >= rangeMin && maxPrice <= rangeInput[1].max) {
                    if (e.target.className === "min") {
                        rangeInput[0].value = minPrice;
                        range.style.left = (minPrice / rangeInput[0].max) * 100 + "%";
                    } else {
                        rangeInput[1].value = maxPrice;
                        range.style.right = 100 - (maxPrice / rangeInput[1].max) * 100 + "%";
                    }
                }
            });
        });
    </script>
@endpush
