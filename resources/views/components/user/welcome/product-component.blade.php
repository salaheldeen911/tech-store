    <div class="product-block component" data-ribbon="{{ $product->discount_percent }}%">
        <a href="{{ route('show.product', $product->id) }}">
            <div class="product-img">
                <img src="{{ $product->main_image }}" alt="">
                <div class="ribbon-wrapper">
                    <div class="ribbon">{{ $product->used ? 'Used' : 'New' }}</div>
                </div>
            </div>
        </a>
        <div class="product-content">
            <h5>
                <a href="{{ route('show.product', $product->id) }}" class="product-title">
                    <span>{{ $product->brand->name . ' ' . $product->name }}</span>
                    <strong>({{ $product->color->name }})</strong>
                </a>
            </h5>
            @if ($product->discount > 0)
                <div class="product-meta">
                    <span class="product-price">${{ $product->final_price }}</span>
                    <span class="discounted-price">${{ $product->price }}</span>
                    <span class="offer-price">{{ $product->discount_percent }}%off</span>
                </div>
            @else
                <div class="product-meta">
                    <span class="product-price">${{ $product->final_price }}</span>
                </div>
            @endif
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
                    onclick={{ auth()->user() ? 'cart(this)' : 'likeErorr(this)' }} data-product="{{ $product->id }}"
                    data-price="{{ $product->price }}">
                    <i class="shopping-icon fa fa-shopping-cart"></i>
                </span>
            </div>

            <span class="like-erorr none">You have to login first</span>

        </div>
    </div>
