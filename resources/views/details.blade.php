@extends('layouts.base')
@push('styles')
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('assets/css/demo2.css') }}">
    <style>
        .rating-input {
            display: inline-block;
            font-size: 1.5rem;
        }

        .rating-input .rating-star {
            cursor: pointer;
            transition: color 0.2s;
        }

        .rating-input .fa-star {
            color: #ddd;
        }

        .rating-input .fa-star.theme-color {
            color: #ffc107;
        }

        .rating-input .fa-star.hover {
            color: #ffc107;
        }

        .review {
            margin-bottom: 1.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid #eee;
        }

        .review:last-child {
            border-bottom: none;
        }

        .user-rating .stars i {
            cursor: pointer;
        }
    </style>
@endpush
@section('content')

    <section class="breadcrumb-section section-b-space" style="padding-top:20px;padding-bottom:20px;">
        <ul class="circles">
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
            <li></li>
        </ul>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3>{{ $product->name }}</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('app.index') }}">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row gx-4 gy-5">
                <div class="col-lg-12 col-12">
                    <div class="details-items">
                        <div class="row g-4">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-lg-2">
                                        <div class="details-image-vertical black-slide rounded">
                                            <div>
                                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                                    class="img-fluid blur-up lazyload" alt="{{ $product->name }}">
                                            </div>
                                            @if ($product->images)
                                                @php
                                                    $images = explode(',', $product->images);
                                                @endphp
                                                @foreach ($images as $image)
                                                    <div>
                                                        <img src="{{ asset('storage/products/' . $image) }}"
                                                            class="img-fluid blur-up lazyload" alt="{{ $product->name }}">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-10">
                                        <div class="details-image-1 ratio_asos">
                                            <div>
                                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                                    class="img-fluid w-100 image_zoom_cls-0 blur-up lazyload"
                                                    alt="{{ $product->name }}">
                                            </div>
                                            @if ($product->images)
                                                @php
                                                    $images = explode(',', $product->images);
                                                @endphp
                                                @foreach ($images as $image)
                                                    <div>
                                                        <img src="{{ asset('storage/products/' . $image) }}"
                                                            class="img-fluid blur-up lazyload" alt="Product Image">
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="cloth-details-size">
                                    <div class="product-count">
                                        <ul>
                                            <li>
                                                <img src="../assets/images/gif/fire.gif" class="img-fluid blur-up lazyload"
                                                    alt="image">
                                                <span class="p-counter">37</span>
                                                <span class="lang">orders in last 24 hours</span>
                                            </li>
                                            <li>
                                                <img src="../assets/images/gif/person.gif"
                                                    class="img-fluid user_img blur-up lazyload" alt="image">
                                                <span class="p-counter">44</span>
                                                <span class="lang">active view this</span>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="details-image-concept">
                                        <h2>{{ $product->name }}</h2>
                                    </div>

                                    <div class="label-section">
                                        <span class="badge badge-grey-color">#1 Best seller</span>
                                        <span class="label-text">in fashion</span>
                                    </div>

                                    <h3 class="price-detail">
                                        @if ($product->sale_price)
                                            ${{ $product->sale_price }}
                                            <del>${{ $product->regular_price }}</del>
                                            <span>
                                                {{ round((($product->regular_price - $product->sale_price) / $product->regular_price) * 100) }}%
                                                off
                                            </span>
                                        @else
                                            ${{ $product->regular_price }}
                                        @endif
                                    </h3>

                                    <div class="color-image">
                                        {{-- <div class="image-select">
                                            <h5>Color :</h5>
                                            <ul class="image-section">
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <img src="../assets/images/fashion/product/front/5.jpg"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <img src="../assets/images/fashion/product/front/6.jpg"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">
                                                        <img src="../assets/images/fashion/product/front/7.jpg"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                </li>
                                            </ul>
                                        </div> --}}
                                    </div>

                                    {{-- <div id="selectSize" class="addeffect-section product-description border-product">
                                        <h6 class="product-title size-text">select size
                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                data-bs-target="#sizemodal">size chart</a>
                                        </h6>

                                        <h6 class="error-message">please select size</h6>

                                        <div class="size-box">
                                            <ul>
                                                <li>
                                                    <a href="javascript:void(0)">s</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">m</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">l</a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)">xl</a>
                                                </li>
                                            </ul>
                                        </div>

                                        <h6 class="product-title product-title-2 d-block">quantity</h6>

                                        <div class="qty-box">
                                            <div class="input-group">
                                                <span class="input-group-prepend">
                                                    <button type="button" class="btn quantity-left-minus"
                                                        onclick="updateQuantity()" data-type="minus" data-field="">
                                                        <i class="fas fa-minus"></i>
                                                    </button>
                                                </span>
                                                <input type="text" name="quantity" id="quantity"
                                                    class="form-control input-number" value="1">
                                                <span class="input-group-prepend">
                                                    <button type="button" class="btn quantity-right-plus"
                                                        onclick="updateQuantity()" data-type="plus" data-field="">
                                                        <i class="fas fa-plus"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                    </div> --}}

                                    <div class="product-buttons">
                                        <a href="javascript:void(0)" class="btn btn-solid">
                                            <i class="fa fa-bookmark fz-16 me-2"></i>
                                            <span>Wishlist</span>
                                        </a>

                                        <a href="#" id="cartEffect"
                                            class="btn btn-solid hover-solid btn-animation add-card"
                                            data-product-id="{{ $product->id }}">
                                            <i class="fa fa-shopping-cart"></i>
                                            <span>Add To Cart</span>
                                        </a>
                                    </div>

                                    <ul class="product-count shipping-order">
                                        <li>
                                            <img src="../assets/images/gif/truck.png" class="img-fluid blur-up lazyload"
                                                alt="image">
                                            <span class="lang">Free shipping for orders above $500 USD</span>
                                        </li>
                                    </ul>

                                    <div class="mt-2 mt-md-3 border-product">
                                        <h6 class="product-title hurry-title d-block">
                                            @if ($product->stock_status == 'instock')
                                                InStock
                                            @else
                                                Out Of Stock
                                            @endif
                                        </h6>
                                        <div class="progress">
                                            <div class="progress-bar" role="progressbar" style="width: 78%"></div>
                                        </div>
                                        <div class="font-light timer-5">
                                            <h5>Order in the next to get</h5>
                                            <ul class="timer1">
                                                <li class="counter">
                                                    <h5 id="days">&#9251;</h5> Days :
                                                </li>
                                                <li class="counter">
                                                    <h5 id="hours">&#9251;</h5> Hour :
                                                </li>
                                                <li class="counter">
                                                    <h5 id="minutes">&#9251;</h5> Min :
                                                </li>
                                                <li class="counter">
                                                    <h5 id="seconds">&#9251;</h5> Sec
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="border-product">
                                        <h6 class="product-title d-block">share it</h6>
                                        <div class="product-icon">
                                            <ul class="product-social">
                                                <li>
                                                    <a href="https://www.facebook.com/">
                                                        <i class="fab fa-facebook-f"></i>
                                                    </a>
                                                </li>
                                                {{-- <li>
                                                    <a href="https://www.google.com/">
                                                        <i class="fab fa-google-plus-g"></i>
                                                    </a>
                                                </li> --}}
                                                <li>
                                                    <a href="https://twitter.com/">
                                                        <i class="fab fa-twitter"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="https://www.instagram.com/">
                                                        <i class="fab fa-instagram"></i>
                                                    </a>
                                                </li>
                                                {{-- <li class="pe-0">
                                                    <a href="https://www.google.com/">
                                                        <i class="fas fa-rss"></i>
                                                    </a>
                                                </li> --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="cloth-review">
                        <nav>
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab"
                                    data-bs-target="#desc" type="button">Description</button>
                                {{-- <button class="nav-link" id="nav-speci-tab" data-bs-toggle="tab" data-bs-target="#speci"
                                    type="button">Specifications</button>
                                <button class="nav-link" id="nav-size-tab" data-bs-toggle="tab"
                                    data-bs-target="#nav-guide" type="button">Sizing Guide</button> --}}
                                <button class="nav-link" id="nav-question-tab" data-bs-toggle="tab"
                                    data-bs-target="#question" type="button">Q & A</button>
                                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab"
                                    data-bs-target="#review" type="button">Review</button>
                            </div>
                        </nav>

                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="desc">
                                <div class="shipping-chart">
                                    {{ $product->description }}
                                </div>
                            </div>

                            <div class="tab-pane fade" id="speci">
                                <div class="pro mb-4">
                                    <p class="font-light">The Model is wearing a white blouse from our stylist's
                                        collection, see the image for a mock-up of what the actual blouse would look
                                        like.it has text written on it in a black cursive language which looks great
                                        on a white color.</p>
                                    <div class="table-responsive">
                                        <table class="table table-part">
                                            <tr>
                                                <th>Product Dimensions</th>
                                                <td>15 x 15 x 3 cm; 250 Grams</td>
                                            </tr>
                                            <tr>
                                                <th>Date First Available</th>
                                                <td>5 April 2021</td>
                                            </tr>
                                            <tr>
                                                <th>Manufacturer‏</th>
                                                <td>Aditya Birla Fashion and Retail Limited</td>
                                            </tr>
                                            <tr>
                                                <th>ASIN</th>
                                                <td>B06Y28LCDN</td>
                                            </tr>
                                            <tr>
                                                <th>Item model number</th>
                                                <td>AMKP317G04244</td>
                                            </tr>
                                            <tr>
                                                <th>Department</th>
                                                <td>Men</td>
                                            </tr>
                                            <tr>
                                                <th>Item Weight</th>
                                                <td>250 G</td>
                                            </tr>
                                            <tr>
                                                <th>Item Dimensions LxWxH</th>
                                                <td>15 x 15 x 3 Centimeters</td>
                                            </tr>
                                            <tr>
                                                <th>Net Quantity</th>
                                                <td>1 U</td>
                                            </tr>
                                            <tr>
                                                <th>Included Components‏</th>
                                                <td>1-T-shirt</td>
                                            </tr>
                                            <tr>
                                                <th>Generic Name</th>
                                                <td>T-shirt</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane fade overflow-auto" id="nav-guide">
                                <div class="table-responsive">
                                    <table class="table table-pane mb-0">
                                        <tbody>
                                            <tr class="bg-color">
                                                <th class="my-2">US Sizes</th>
                                                <td>6</td>
                                                <td>6.5</td>
                                                <td>7</td>
                                                <td>8</td>
                                                <td>8.5</td>
                                                <td>9</td>
                                                <td>9.5</td>
                                                <td>10</td>
                                                <td>10.5</td>
                                                <td>11</td>
                                            </tr>
                                            <tr>
                                                <th>Euro Sizes</th>
                                                <td>39</td>
                                                <td>39</td>
                                                <td>40</td>
                                                <td>40-41</td>
                                                <td>41</td>
                                                <td>41-42</td>
                                                <td>42</td>
                                                <td>42-43</td>
                                                <td>43</td>
                                                <td>43-44</td>
                                            </tr>
                                            <tr class="bg-color">
                                                <th>UK Sizes</th>
                                                <td>5.5</td>
                                                <td>6</td>
                                                <td>6.5</td>
                                                <td>7</td>
                                                <td>7.5</td>
                                                <td>8</td>
                                                <td>8.5</td>
                                                <td>9</td>
                                                <td>10.5</td>
                                                <td>11</td>
                                            </tr>
                                            <tr>
                                                <th>Inches</th>
                                                <td>9.25"</td>
                                                <td>9.5"</td>
                                                <td>9.625"</td>
                                                <td>9.75"</td>
                                                <td>9.9735"</td>
                                                <td>10.125"</td>
                                                <td>10.25"</td>
                                                <td>10.5"</td>
                                                <td>10.765"</td>
                                                <td>10.85</td>
                                            </tr>
                                            <tr class="bg-color">
                                                <th>CM</th>
                                                <td>23.5</td>
                                                <td>24.1</td>
                                                <td>24.4</td>
                                                <td>25.4</td>
                                                <td>25.7</td>
                                                <td>26</td>
                                                <td>26.7</td>
                                                <td>27</td>
                                                <td>27.3</td>
                                                <td>27.5</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="question">
                                <div class="question-answer">
                                    <ul>
                                        <li>
                                            <div class="que">
                                                <i class="fas fa-question"></i>
                                                <div class="que-details">
                                                    <h6>Is it compatible with all WordPress themes?</h6>
                                                    <p class="font-light">If you want to see a demonstration version of
                                                        the premium plugin, you can see that in this page. If you want
                                                        to see a demonstration version of the premium plugin, you can
                                                        see that in this page. If you want to see a demonstration
                                                        version of the premium plugin, you can see that in this page.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="que">
                                                <i class="fas fa-question"></i>
                                                <div class="que-details">
                                                    <h6>How can I try the full-featured plugin? </h6>
                                                    <p class="font-light">Compatibility with all themes is impossible,
                                                        because they are too many, but generally if themes are developed
                                                        according to WordPress and WooCommerce guidelines, YITH plugins
                                                        are compatible with them. Compatibility with all themes is
                                                        impossible, because they are too many, but generally if themes
                                                        are developed according to WordPress and WooCommerce guidelines,
                                                        YITH plugins are compatible with them.</p>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="que">
                                                <i class="fas fa-question"></i>
                                                <div class="que-details">
                                                    <h6>Is it compatible with all WordPress themes?</h6>
                                                    <p class="font-light">If you want to see a demonstration version of
                                                        the premium plugin, you can see that in this page. If you want
                                                        to see a demonstration version of the premium plugin, you can
                                                        see that in this page. If you want to see a demonstration
                                                        version of the premium plugin, you can see that in this page.
                                                    </p>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="review">
                                <div class="row g-4">
                                    <div class="col-lg-4">
                                        <div class="product-ratings">
                                            <h4>Customer Reviews</h4>

                                            <div class="average-rating">
                                                <x-star-rating :rating="$product->averageRating()" />
                                                <span>{{ number_format($product->averageRating(), 1) }} out of 5</span>
                                                <span>({{ $product->totalRatings() }} ratings)</span>
                                            </div>

                                            @auth
                                                <div class="user-rating">
                                                    <p>Your Rating:</p>
                                                    @php
                                                        $userRating = $product->ratings
                                                            ->where('user_id', auth()->id())
                                                            ->first();
                                                    @endphp
                                                    <div class="stars">
                                                        @for ($i = 1; $i <= 5; $i++)
                                                            <i class="{{ $userRating && $i <= $userRating->rating ? 'fas' : 'far' }} fa-star theme-color"
                                                                data-rating="{{ $i }}"
                                                                data-product-id="{{ $product->id }}"></i>
                                                        @endfor
                                                    </div>
                                                </div>
                                            @endauth

                                            <div class="reviews">
                                                @foreach ($product->ratings()->with('user')->latest()->get() as $rating)
                                                    <div class="review">
                                                        <x-star-rating :rating="$rating->rating" :maxRating="5" />
                                                        <p>{{ $rating->comment }}</p>
                                                        <small>By {{ $rating->user->name }} on
                                                            {{ $rating->created_at->format('M d, Y') }}</small>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-8">
                                        @auth
                                            <div class="review-box">
                                                <h4>Write a Review</h4>
                                                <form id="reviewForm" action="{{ route('product.rating.store') }}"
                                                    method="POST">
                                                    @csrf
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                                                    <div class="mb-3">
                                                        <p class="d-inline-block me-2">Your Rating:</p>
                                                        <div class="rating-input">
                                                            @for ($i = 1; $i <= 5; $i++)
                                                                <i class="far fa-star rating-star"
                                                                    data-value="{{ $i }}"></i>
                                                            @endfor
                                                            <input type="hidden" name="rating" id="ratingValue"
                                                                value="0" required>
                                                        </div>
                                                        @error('rating')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label class="form-label" for="comment">Review</label>
                                                        <textarea class="form-control" name="comment" id="comment" rows="4"
                                                            placeholder="Share your experience with this product" required></textarea>
                                                        @error('comment')
                                                            <span class="text-danger">{{ $message }}</span>
                                                        @enderror
                                                    </div>

                                                    <button type="submit" class="btn btn-primary">Submit Review</button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="alert alert-info">
                                                <p>Please <a href="{{ route('login') }}">login</a> to submit your review.</p>
                                            </div>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ratio_asos section-b-space overflow-hidden">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="mb-lg-4 mb-3">Customers Also Bought These</h2>
                    <div class="product-wrapper product-style-2 slide-4 p-0 light-arrow bottom-space">
                        @foreach ($rproducts as $rproduct)
                            <div>
                                <div class="product-box">
                                    <div class="img-wrapper">
                                        <div class="front">
                                            <a href="{{ route('shop.product.details', ['slug' => $rproduct->slug]) }}">
                                                <img src="{{ asset('storage/products/' . $rproduct->image) }}"
                                                    class="bg-img blur-up lazyload" alt="">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="{{ route('shop.product.details', ['slug' => $rproduct->slug]) }}">
                                                <img src="{{ asset('assets/images/fashion/product/back/' . $rproduct->image) }}"
                                                    class="bg-img blur-up lazyload" alt="">
                                            </a>
                                        </div>
                                        <div class="cart-wrap">
                                            <ul>
                                                <li>
                                                    <a href="#" class="add-card"
                                                        data-product-id="{{ $product->id }}">
                                                        <i data-feather="shopping-cart"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('shop.product.details', ['slug' => $rproduct->slug]) }}"
                                                        data-bs-toggle="modal" data-bs-target="#quick-view">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:void(0)" class="wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-details">
                                        <div class="rating-details">
                                            <span class="font-light grid-content">{{ $rproduct->category->name }}</span>
                                            <a href="#" class="add-card" data-product-id="{{ $product->id }}">
                                                <i data-feather="shopping-cart"></i>
                                            </a>
                                        </div>
                                        <div class="main-price">
                                            <a href="{{ route('shop.product.details', ['slug' => $rproduct->slug]) }}"
                                                class="font-default">
                                                <h5>{{ $rproduct->name }}</h5>
                                            </a>
                                            <div class="listing-content">
                                                <span class="font-light">{{ $rproduct->category->name }}</span>
                                                <p class="font-light">{{ $rproduct->short_description }}</p>
                                            </div>
                                            <h3 class="theme-color">
                                                @if ($rproduct->sale_price)
                                                    ${{ $rproduct->sale_price }}
                                                    <del>${{ $rproduct->regular_price }}</del>
                                                @else
                                                    ${{ $rproduct->regular_price }}
                                                @endif
                                            </h3>
                                            <button onclick="location.href = 'cart.html';" class="btn listing-content">Add
                                                To Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Rating stars interaction for the review form
            const stars = document.querySelectorAll('.rating-star');
            const ratingInput = document.getElementById('ratingValue');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = parseInt(this.getAttribute('data-value'));
                    ratingInput.value = value;

                    // Update star display
                    stars.forEach((s, index) => {
                        if (index < value) {
                            s.classList.remove('far');
                            s.classList.add('fas', 'theme-color');
                        } else {
                            s.classList.remove('fas', 'theme-color');
                            s.classList.add('far');
                        }
                    });
                });

                // Hover effect
                star.addEventListener('mouseover', function() {
                    const value = parseInt(this.getAttribute('data-value'));
                    stars.forEach((s, index) => {
                        if (index < value) {
                            s.classList.add('hover');
                        } else {
                            s.classList.remove('hover');
                        }
                    });
                });

                star.addEventListener('mouseout', function() {
                    const currentRating = parseInt(ratingInput.value);
                    stars.forEach((s, index) => {
                        s.classList.remove('hover');
                        if (index < currentRating) {
                            s.classList.remove('far');
                            s.classList.add('fas', 'theme-color');
                        } else {
                            s.classList.remove('fas', 'theme-color');
                            s.classList.add('far');
                        }
                    });
                });
            });

            // For the existing user rating display (if you want to allow rating updates)
            const userRatingStars = document.querySelectorAll('.user-rating .stars .fa-star');
            if (userRatingStars.length > 0) {
                userRatingStars.forEach(star => {
                    star.addEventListener('click', function() {
                        const rating = this.getAttribute('data-rating');
                        const productId = this.getAttribute('data-product-id');

                        fetch('/rate-product', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({
                                    product_id: productId,
                                    rating: rating
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Update the displayed stars
                                    userRatingStars.forEach((s, index) => {
                                        if (index < rating) {
                                            s.classList.remove('far');
                                            s.classList.add('fas', 'theme-color');
                                        } else {
                                            s.classList.remove('fas', 'theme-color');
                                            s.classList.add('far');
                                        }
                                    });

                                    // Optionally update the average rating display
                                    if (data.averageRating) {
                                        document.querySelector(
                                                '.average-rating span:first-child')
                                            .textContent =
                                            data.averageRating + ' out of 5';
                                    }
                                }
                            });
                    });
                });
            }

            // AJAX form submission for the review form
            const reviewForm = document.getElementById('reviewForm');
            if (reviewForm) {
                reviewForm.addEventListener('submit', function(e) {
                    e.preventDefault();

                    fetch(this.action, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            },
                            body: JSON.stringify({
                                product_id: this.product_id.value,
                                rating: this.rating.value,
                                comment: this.comment.value
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Refresh the page to show the new review
                                window.location.reload();
                            } else {
                                alert('There was an error submitting your review.');
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                        });
                });
            }
        });
    </script>
@endpush
