@extends('layouts.user-app')
@push('styles')
    <style>
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

        .icon_holder i {
            transition: width ease-in 1s;
        }

        .icon_holder i.disabled {
            width: 0;
            overflow: hidden;
        }

        .icon_holder.liked i {
            font-size: 22px;
            color:
                #e51376;
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

        .slider-img img {
            width: 100% !important;
            height: 100% !important;
        }

        .showcase-img {
            max-width: 100%;
            min-width: 70%;
            height: 80%;
        }

        .showcase-img img {
            width: 100%;
            height: 100%;
        }

        .showcase-block {
            width: 100%;
            height: 300px;
            padding-bottom: 10px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .big_brand .showcase-img {
            flex-grow: 1;
        }

        .display-logo {
            height: 20%;
            margin: 0;
            width: 80%;
        }

        .component {
            position: relative;
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
    {{-- {{ dd($cart) }} --}}
    <!-- slider -->
    <div class="slider">
        <div class="owl-carousel owl-one owl-theme">
            @if (count($sliders) > 0)
                @foreach ($sliders as $slider)
                    <div class="item">
                        <div class="slider-img">
                            <img style="height: 100% !impodrtant;" src="{{ asset($slider->path) }}" alt="">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-5 col-md-8 col-sm-6 col-xs-12">
                                    <div class="slider-captions">
                                        @if ($slider->product !== null)
                                            <div class="brand-img">
                                                <img src="./images/mi_logo.png" alt="">
                                            </div>
                                            <h1 class="slider-title">
                                                {{ $slider->product->brand }}
                                                <span>{{ $slider->product->name }}</span>
                                            </h1>
                                            <p class="hidden-xs">
                                                {{ $slider->product->storage }}
                                                Storage | {{ $slider->product->ram }}GB Ram |
                                                {{ $slider->product->sim_card }}
                                                Sim Card
                                                <br>
                                                {{ $slider->product->processor }} Processor
                                            </p>
                                            <p class="slider-price">${{ $slider->product->price }} </p>
                                            <a href="products/{{ $slider->product->id }}"
                                                class="btn btn-primary btn-lg hidden-xs">Buy Now</a>
                                        @else
                                            <div class="brand-img">
                                                <img src="./images/mi_logo.png" alt="">
                                            </div>
                                            <h1 class="slider-title">Quote {{ $loop->index + 1 }}</h1>
                                            @if ($loop->index == 0)
                                                <p class="hidden-xs" style="font-size:22px;font-weight:400;">Programming
                                                    made the impossible
                                                    possible. You can
                                                    have
                                                    a null object and a constant variable.</p>
                                            @endif
                                            @if ($loop->index == 1)
                                                <p class="hidden-xs" style="font-size:22px;font-weight:400;">Don’t worry if
                                                    it doesn’t work right. If
                                                    everything
                                                    did, you’d be out of a job.</p>
                                            @endif
                                            @if ($loop->index == 2)
                                                <p class="hidden-xs" style="font-size:22px;font-weight:400;">Some people
                                                    when confronted with a
                                                    problem think, “I
                                                    know, I’ll use regular expressions.” Now they have two problems.</p>
                                            @endif
                                            <a href="/all-products" class="btn btn-primary btn-lg hidden-xs">Shop Now</a>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
    <!-- /.slider -->
    <!-- mobile showcase -->
    <div class="space-medium">
        <div class="container">
            <div class="row">
                @if (!$AdvertisingSections->isEmpty())
                    @foreach ($AdvertisingSections as $brand)
                        <div
                            class="{{ $brand->brand_order == 2 ? 'col-lg-6 col-md-6' : 'col-lg-3 col-md-3' }} col-sm-12 col-xs-12">
                            <div class="showcase-block {{ $brand->brand_order == 2 ? 'active big_brand' : '' }}">
                                @if ($brand->brand)
                                    <div class="display-logo ">
                                        <a href="{{ route('filter', ['brand' => [$brand->brand_id]]) }}"> <img
                                                style="max-height: 100%" src="{{ asset($brand->brand_lable_image_path) }}"
                                                alt=""></a>
                                    </div>
                                    {{-- {{ dd($brand->category) }} --}}
                                @endif

                                @if ($brand->category)
                                    <a href="{{ route('filter', ['category' => [$brand->category_id]]) }}">
                                        <h2
                                            style="text-align:center;font-family:'Hurricane',cursive;font-size:21px;margin:0;font-weight:900;">
                                            {{ $brand->category->name }}</h2>
                                    </a>
                                @endif

                                @if ($brand->brand)
                                    <div class="showcase-img">
                                        <a href="{{ route('filter', ['brand' => [$brand->brand_id]]) }}"> <img
                                                src="{{ asset($brand->brand_main_image_path) }}" alt=""></a>
                                    </div>
                                @endif
                                @if ($brand->category)
                                    <div class="showcase-img">
                                        <a href="{{ route('filter', ['category' => [$brand->category_id]]) }}"> <img
                                                src="{{ asset($brand->brand_main_image_path) }}" alt=""></a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                @endif

            </div>
        </div>
    </div>
    <x-user.welcome.latest-section />

    <x-user.welcome.t-v-section />

    <x-user.welcome.mobile-section />

    <x-user.welcome.laptop-section />

    @push('scripts')
        <script src={{ asset('js/owl.carousel.min.js') }}></script>
        <script src={{ asset('js/multiple-carousel.js') }}></script>
        <script>
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $(document).ready(function() {
                // hide the numbers of likes if equal 0
                $('.likesNum').each(function() {
                    this.innerText == 0 ? this.style.display = "none" : this.style.display = "unset";
                });
            });

            function likeFunction(likeBtn) {
                $(likeBtn).find("i").addClass("disabled");
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
                        $(likeBtn).find("i").removeClass("disabled");

                        if (res.success) {
                            handelLike(likeBtn);
                        }
                    },
                    error: function(res) {
                        $(likeBtn).find("i").removeClass("disabled");
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
                $(likeIcon).find("i").addClass("disabled");
                $(likeIcon).parent().parent().parent().find('.like-erorr').fadeIn(1000);
                $(likeIcon).parent().parent().parent().find('.like-erorr').fadeOut(1000);
                setTimeout(() => {
                    $(likeIcon).find("i").removeClass("disabled");
                }, 1000);
            }

            function cart(cartBtn) {
                $(cartBtn).find("i").addClass("disabled");

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
                        $(cartBtn).find("i").removeClass("disabled");
                        console.log(res);
                        $("#cartQuantity").text(res.cartQuantity);
                        cartBtn.classList.toggle("liked");
                    },
                    error: function(res) {
                        $(cartBtn).find("i").removeClass("disabled");
                    }
                });
            }
        </script>
    @endpush
@endsection
