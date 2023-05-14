    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="box">
                    <div class="box-head">
                        <h3 class="head-title">Tvs Products</h3>
                    </div>
                    <div class="box-body">
                        <div class="row latestProducts">
                            <!-- product -->
                            @if (!$tvs->isEmpty())
                                @foreach ($tvs as $product)
                                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb30 pr-0">

                                        <x-user.welcome.product-component :product="$product" />
                                    </div>
                                    {{-- <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12 mb30">
                                        <div class="product-block">
                                            <a href="{{ route('show.product', $product->id) }}">
                                                <div class="product-img">
                                                    <img src="{{ $product->main_image }}" alt="">
                                                </div>
                                            </a>

                                            <div class="product-content">
                                                <h5>
                                                    <a href="{{ route('show.product', $product->id) }}"
                                                        class="product-title">
                                                        <span>{{ $product->name }}</span>
                                                        <strong>({{ $product->color->name }})</strong>
                                                    </a>
                                                </h5>
                                                <div class="product-meta">
                                                    <span class="product-price">${{ $product->final_price }}</span>
                                                    <span class="discounted-price">${{ $product->discount }}</span>
                                                    <span
                                                        class="offer-price">{{ $product->discount_percent }}%off</span>
                                                </div>
                                                <div class="shopping-btn">
                                                    <span class="like_icon_container">
                                                        <span class="likesNum"> {{ $product->likes }}</span>
                                                        <span
                                                            class="icon_holder @auth {{ $product->likes()->where(['user_id' => auth()->user()->id], ['product_id' => $product->id])->exists()? 'liked': '' }} @endauth"
                                                            onclick={{ auth()->user() ? 'likeFunction(this)' : 'likeErorr(this)' }}
                                                            data-product="{{ $product->id }}">
                                                            <i class="shopping-icon fa fa-heart"></i>
                                                        </span>
                                                    </span>
                                                    <span
                                                        class="icon_holder @auth {{ !$cart->products->where('id', $product->id)->isEmpty() ? 'liked' : '' }} @endauth"
                                                        onclick={{ auth()->user() ? 'cart(this)' : 'likeErorr(this)' }}
                                                        data-product="{{ $product->id }}"
                                                        data-price="{{ $product->price }}">
                                                        <i class="shopping-icon fa fa-shopping-cart"></i>
                                                    </span>
                                                </div>

                                                <span class="like-erorr none">You have to login first</span>

                                            </div>
                                        </div>
                                    </div> --}}
                                @endforeach
                            @else
                                <div class="noData text-center w-100"> No products to show</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
