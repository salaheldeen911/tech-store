@extends('layouts.admin-app')

@section('admin-content')
    <!-- Page Content -->
    <div class="row">
        <div class="col-lg-5 p-r-0 title-margin-right">
            <div class="page-header">
                <div class="page-title">
                    <h1>Hello,
                        <span>Welcome Here</span>
                    </h1>
                </div>
            </div>
        </div>
        <!-- /# column -->
        <div class="col-lg-7 p-l-0 title-margin-left">
            <div class="page-header">
                <div class="page-title">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.home') }}">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a style="display:inline;" href="{{ route('admin.products.index') }}">Products</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $product->name }}</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /# column -->
    </div>
    <!-- /# row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="user-photo m-b-30" style="height:400px">
                                <a data-fancybox="product" href="{{ asset($product->main_image) }}" class="item-link">
                                    <img class="img-fluid" style="width:100%;height:100%"
                                        src="{{ asset($product->main_image) }}" alt="" />
                                </a>
                                @if ($product->subImages)
                                    @foreach ($product->subImages as $subImage)
                                        <a style="display: none;" data-fancybox="product"
                                            href="{{ asset($subImage->sub_image) }}">
                                            <img src="{{ asset($subImage->sub_image) }}" alt="{{ asset($product->name) }}">
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div style="display:flex; justify-content:space-between; align-items: center;">
                                <div class="ratings">
                                    <h3 class="text-center">Ratings</h3>
                                    <div id="ratingStars" class="rating-star"
                                        data-rate="{{ floor($product->ratings->pluck('rating')->avg()) }}">
                                        <span>{{ $product->ratings->pluck('rating')->avg() ?? '0' }} / 5</span>
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                        <i class="ti-star"></i>
                                    </div>
                                </div>
                                <div class="user-send-message mt-0">
                                    <a href="{{ route('admin.products.edit', $product->id) }}"
                                        class="btn btn-primary btn-addon" type="button">
                                        <i class="ti-pencil-alt"></i>Edit</a>
                                </div>
                            </div>

                            <div class="custom-tab user-profile-tab">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active h5">
                                        <p>{{ $product->title }}</p>
                                    </li>
                                </ul>
                                <div style="display: flex;justify-content: space-between;">
                                    <div class="tab-content">
                                        <div id="1" role="tabpanel" class="tab-pane active">
                                            <div class="basic-information">
                                                <h4>Admin information</h4>
                                                <div class="color-content">
                                                    <span class="contact-title">Condition:</span>
                                                    <span class="name">{{ $product->used ? 'Used' : 'New' }}</span>
                                                </div>
                                                <div class="color-content">
                                                    <span class="contact-title">Model Name:</span>
                                                    <span class="name">{{ $product->name }}</span>
                                                </div>
                                                <div class="color-content">
                                                    <span class="contact-title">Category:</span>
                                                    <span class="name">{{ $product->category->name }}</span>
                                                </div>
                                                <div class="color-content">
                                                    <span class="contact-title">Brand:</span>
                                                    <span class="name">{{ $product->brand->name }}</span>
                                                </div>
                                                <div>
                                                    <span class="contact-title">Quantity:</span>
                                                    <span>{{ $product->quantity }}</span>
                                                </div>
                                                <div>
                                                    <span class="contact-title">Sold:</span>
                                                    <span>{{ $product->sold }}</span>
                                                </div>
                                                <div class="sim_card-content">
                                                    <span class="contact-title">Likes:</span>
                                                    <span class="sim_card">{{ $product->likes }}</span>
                                                </div>
                                                <div>
                                                    <span class="contact-title">Price:</span>
                                                    <span>{{ $product->price }} $</span>
                                                </div>
                                                <div>
                                                    <span class="contact-title">discount:</span>
                                                    <span>{{ $product->discount }} $</span>
                                                </div>
                                                <div>
                                                    <span class="contact-title">Final Price:</span>
                                                    <span>{{ $product->final_price }} $</span>
                                                </div>
                                                <div>
                                                    <span class="contact-title">Publisher Email:</span>
                                                    <span>{{ $product->seller->email }}</span>
                                                </div>
                                                <div>
                                                    <span class="contact-title">Publisher Name:</span>
                                                    <span>{{ $product->seller->name }}</span>
                                                </div>
                                                <div>
                                                    <span class="contact-title">Published Date:</span>
                                                    <span>{{ $product->created_at->diffForHumans() }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="basic-information">
                                        <h4>Main information</h4>
                                        @if ($product->category_id == $product::$mobileCategory)
                                            <x-admin.product.show-mobile :product="$product" />
                                        @endif
                                        @if ($product->category_id == $product::$tvCategory)
                                            <x-admin.product.show-tv :product="$product" />
                                        @endif

                                        @if ($product->category_id == $product::$laptopCategory)
                                            <x-admin.product.show-laptop :product="$product" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="container ml-5 mr-5">
                            <hr>
                            <h4>Description</h4>
                            <p
                                style="font-size: 18px;line-height: 26px;font-weight: 400;color: #36344D;letter-spacing: .3px;">
                                {!! nl2br($product->details->description) !!}
                            </p>
                        </div>
                        <div class="container ml-5 mr-5">
                            <div class="box-head">
                                <hr>

                                <h4 class="head-title">Customer Reviews</h4>
                            </div>

                            <div class="box-body">
                                @if (!empty($product->ratings->toArray()))
                                    @foreach ($product->ratings as $rate)
                                        <div class="w-100">
                                            <div style="display: flex; justify-content:space-between;align-items: center;">
                                                <div data-rate="{{ $rate->rating }}" class="product-rating rated">
                                                    <span><i class="fa "></i></span>
                                                    <span><i class="fa "></i></span>
                                                    <span><i class="fa "></i></span>
                                                    <span><i class="fa "></i></span>
                                                    <span><i class="fa "></i></span>
                                                    <p class="reviews-text">
                                                        By
                                                        <span class="text-default">
                                                            {{ auth()->user()->where('id', $rate->user_id)->first()->name }}
                                                        </span>
                                                        from {{ $rate->created_at->diffForHumans() }}
                                                    </p>
                                                </div>

                                                @role('super_admin')
                                                    <div class="delete">
                                                        <i style="cursor: pointer" class="fa fa-close"></i>
                                                        <form action="/dashboard/products/rating/{{ $rate->id }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>
                                                    </div>
                                                @endrole
                                            </div>
                                            <div class="col-xs-12">
                                                <p>{{ $rate->review }}</p>
                                            </div>

                                            <div class="col-xs-12">
                                                <div class="divider-line"></div>
                                            </div>
                                        </div>
                                        <hr>
                                    @endforeach
                                @else
                                    <p>No reviews available yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/js/jquery.fancybox.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            let i = 1;
            let rating = Math.floor($("#ratingStars").attr('data-rate'));
            $("#ratingStars").find("i").each(function() {
                if (rating >= i) {
                    $(this).addClass('color-primary');
                    i += 1
                }
            })
        });

        $(document).ready(function() {
            $('.rated').each(function() {
                let i = 1;
                let rating = Math.floor($(this).attr('data-rate'));
                $(this).find("i").each(function() {
                    if (rating >= i) {
                        $(this).addClass('fa-star');
                        i += 1
                    } else {
                        $(this).addClass('fa-star-o');
                    }
                })
            });
        });

        $('.delete').on('click', function() {
            $(this).find('form').submit();
        });
    </script>
@endpush
