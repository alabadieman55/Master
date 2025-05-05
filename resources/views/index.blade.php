@extends('layouts.base')
@section('content')
    <section class="pt-0 poster-section">
        <div class="poster-image slider-for custome-arrow classic-arrow">
            <div>
                <img src="assets/images/furniture-images/poster/1234.png" class="img-fluid blur-up lazyload" alt="">
            </div>
            <div>
                <img src="assets/images/furniture-images/poster/bb.png" class="img-fluid blur-up lazyload" alt="">
            </div>
            <div>
                <img src="assets/images/furniture-images/poster/456.png" class="img-fluid blur-up lazyload" alt="">
            </div>
        </div>
        <div class="slider-nav image-show">
            <div>
                <div class="poster-img">
                    <img src="assets/images/furniture-images/poster/tf1.png" class="img-fluid blur-up lazyload"
                        alt="">
                    <div class="overlay-color">
                        <i class="fas fa-plus theme-color"></i>
                    </div>
                </div>
            </div>
            <div>
                <div class="poster-img">
                    <img src="assets/images/furniture-images/poster/tf2.png" class="img-fluid blur-up lazyload"
                        alt="">
                    <div class="overlay-color">
                        <i class="fas fa-plus theme-color"></i>
                    </div>
                </div>

            </div>
            <div>
                <div class="poster-img">
                    <img src="assets/images/furniture-images/poster/tf.png" class="img-fluid blur-up lazyload"
                        alt="">
                    <div class="overlay-color">
                        <i class="fas fa-plus theme-color"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="left-side-contain">
            <div class="banner-left">
                <h4>Sale <span class="theme-color">20% Off</span></h4>
                <h1>EmaN<span>Hijabs</span></h1>


                <p>BUY ONE GET ONE <span class="theme-color">FREE</span></p>
                <h2>JD10.00 <span class="theme-color"><del>JD12.00</del></span></h2>

            </div>
        </div>


    </section>
    <!-- banner section start -->
    <section class="ratio2_1 banner-style-2">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">
                    <div class="collection-banner p-bottom p-center text-center">
                        <a href="/shop" class="banner-img">
                            <img src="assets/images/fashion/banner/WhatsApp.jpg" class="bg-img blur-up lazyload"
                                alt="">
                        </a>
                        <div class="banner-detail">

                        </div>
                        <a href="/shop" class="contain-banner">
                            <div class="banner-content with-big">

                                <span>BUY ONE GET ONE FREE</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="collection-banner p-bottom p-center text-center">
                        <a href="/shop" class="banner-img">
                            <img src="assets/images/fashion/banner/WhatsApp1.jpg" class="bg-img blur-up lazyload"
                                alt="">
                        </a>
                        <div class="banner-detail">

                        </div>
                        <a href="/shop" class="contain-banner">
                            <div class="banner-content with-big">

                                <span>New offer 50% off</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="collection-banner p-bottom p-center text-center">
                        <a href="/shop" class="banner-img">
                            <img src="assets/images/fashion/banner/WhatsApp2.jpg" class="bg-img blur-up lazyload"
                                alt="">
                        </a>
                        <div class="banner-detail">

                        </div>
                        <a href="shop" class="contain-banner">
                            <div class="banner-content with-big">

                                <span>New offer 10% off</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner section end -->

    <section class="ratio_asos overflow-hidden">
        <div class="container p-sm-0">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="title-3 text-center">
                        <h2>The Gifted Hijab</h2>
                        <h5 class="theme-color">"Perfect hijab gift sets for every occasion"
                        </h5>
                    </div>
                </div>
            </div>
            <style>
                .r-price {
                    display: flex;
                    flex-direction: row;
                    gap: 20px;
                }

                .r-price .main-price {
                    width: 100%;
                }

                .r-price .rating {
                    padding-left: auto;
                }

                .product-style-3.product-style-chair .product-title {
                    text-align: left;
                    width: 100%;
                }

                @media (max-width:600px) {

                    .product-box p,
                    .product-box a {
                        text-align: left;
                    }

                    .product-style-3.product-style-chair .main-price {
                        text-align: right !important;
                    }
                }
            </style>
            <div class="row g-sm-4 g-3">
                @foreach ($packages as $package)
                    <div class="col-xl-2 col-lg-2 col-6">
                        <div class="product-box">
                            <div class="img-wrapper">
                                <a href="{{ route('shop.product.details', ['slug' => $package->slug]) }}">
                                    <img src="{{ asset('storage/products/' . $package->image) }}"
                                        class="w-100 bg-img blur-up lazyload" alt="">
                                </a>
                                <div class="circle-shape"></div>
                                <span class="background-text">Furniture</span>
                                <div class="label-block">
                                    @if ($package->discount != null)
                                        <span
                                            class="label label-theme">{{ number_format(($package->discount / $package->regular_price) * 100) }}%
                                            off</span>
                                    @endif
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="#" class="add-card" data-product-id="{{ $package->id }}">
                                                <i data-feather="shopping-cart"></i>
                                            </a>


                                        </li>
                                        <li>
                                            <a href="{{ route('shop.product.details', ['slug' => $package->slug]) }}">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="add-wishlist" data-product-id="{{ $package->id }}">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-style-3 product-style-chair">
                                <div class="product-title d-block mb-0">
                                    <div class="r-price">
                                        <div class="theme-color">
                                            {{ number_format($package->regular_price - $package->discount, 2) }}JD
                                        </div>
                                        <div class="product">
                                            <!-- other product details -->
                                            <div class="rating">
                                                <x-star-rating :rating="$package->averageRating()" />
                                            </div>
                                        </div>
                                    </div>
                                    <p class="font-light mb-sm-2 mb-0">{{ $package->short_description }}</p>
                                    <a href="product/details.html" class="font-default">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
    </section>
    <br><br>
    <div class="container mt-5 mb-3">
        <div class="row">
            <div class="col-12 text-center">
                <h2 class="section-title">Your Hijab, Your Style</h2>
            </div>
        </div>
    </div>
    <section class="ratio2_1 banner-style-2">
        <div class="container">
            <div class="row gy-4">
                <div class="col-lg-4 col-md-6">

                    <div class="collection-banner p-bottom p-center text-center">
                        <a href="shop-left-sidebar.html" class="banner-img">

                            <img src="assets/images/fashion/banner/001.jpg" class="bg-img blur-up lazyload"
                                alt="">
                        </a>
                        <!-- <div class="banner-detail">
                                                                                                                                                                                            <a href="javacript:void(0)" class="heart-wishlist">
                                                                                                                                                                                                <i class="far fa-heart"></i>
                                                                                                                                                                                            </a>
                                                                                                                                                                                            <span class="font-dark-30">26% <span>OFF</span></span>
                                                                                                                                                                                        </div> -->
                        <a href="shop-left-sidebar.html" class="contain-banner">
                            <!-- <div class="banner-content with-big">

                                                                                                                                                                                                <span>BUY ONE GET ONE FREE</span>
                                                                                                                                                                                            </div> -->
                        </a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="collection-banner p-bottom p-center text-center">
                        <a href="shop-left-sidebar.html" class="banner-img">
                            <img src="assets/images/fashion/banner/220.jpg" class="bg-img blur-up lazyload"
                                alt="">
                        </a>
                        <div class="banner-detail">
                            <!-- <a href="javacript:void(0)" class="heart-wishlist"> -->
                            <!-- <i class="far fa-heart"></i> -->
                            </a>
                            <!-- <span class="font-dark-30">50% <span>OFF</span></span> -->
                        </div>
                        <!-- <a href="shop-left-sidebar.html" class="contain-banner"> -->
                        <div class="banner-content with-big">

                            <!-- <span>New offer 50% off</span> -->
                        </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="collection-banner p-bottom p-center text-center">
                        <a href="shop-left-sidebar.html" class="banner-img">
                            <img src="assets/images/fashion/banner/003.jpg" class="bg-img blur-up lazyload"
                                alt="">
                        </a>
                        <!-- <div class="banner-detail">
                                                                                                                                                                                            <a href="javacript:void(0)" class="heart-wishlist">
                                                                                                                                                                                                <i class="far fa-heart"></i>
                                                                                                                                                                                            </a>
                                                                                                                                                                                            <span class="font-dark-30">36% <span>OFF</span></span>
                                                                                                                                                                                        </div> -->
                        <a href="shop-left-sidebar.html" class="contain-banner">
                            <!-- <div class="banner-content with-big">

                                                                                                                                                                                                <span>New offer 10% off</span>
                                                                                                                                                                                            </div> -->
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- category section start -->
    <section class="category-section ratio_40">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title title-2 text-center">
                        <h2>Our Categories</h2>
                        <h5 class="text-color">Our collection</h5>
                    </div>
                </div>
            </div>
            <div class="row gy-3">
                <div class="col-xxl-2 col-lg-3">
                    <div class="category-wrap category-padding category-block theme-bg-color">
                        <div>
                            <h2 class="light-text">Top</h2>
                            <h2 class="top-spacing">Our Top</h2>
                            <span>Categories</span>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-10 col-lg-9">
                    <div class="category-wrapper category-slider1 white-arrow category-arrow">
                        @foreach ($categories as $category)
                            <div>
                                <a href="/shop" class="category-wrap category-padding">
                                    <img src="{{ asset('storage/' . $category->image) }}" class="bg-img blur-up lazyload"
                                        alt="category image">
                                    <div class="category-content category-text-1">
                                        <h3 class="theme-color">{{ $category->name }}</h3>
                                        <span class="text-dark">{{ $category->slug }}</span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- category section end -->
    <style>
        .products-c .bg-size {
            background-position: center 0 !important;
        }
    </style>

    <section class="ratio_asos overflow-hidden pb-5">
        <div class="px-0 container-fluid p-sm-0">
            <div class="row m-0">
                <div class="col-12 p-0">
                    <div class="title-3 text-center">
                        <h2>Fashion Top Deals</h2>
                        <h5 class="theme-color">Our Collection</h5>
                    </div>
                </div>
            </div>

            <div class="row m-0"> <!-- Row for product grid -->
                @foreach ($productsDiscount as $discount)
                    <div class="col-lg-3 col-md-4 col-sm-6 p-2"> <!-- Adjust column width -->
                        <div class="product-box">
                            <div class="img-wrapper">
                                <a href="{{ route('shop.product.details', ['slug' => $discount->slug]) }}">
                                    <img src="{{ asset('storage/products/' . $discount->image) }}"
                                        class="w-100 bg-img blur-up lazyload" alt="">
                                </a>
                                <div class="circle-shape"></div>
                                <span class="background-text">Fashion</span>
                                <div class="label-block">
                                    <span
                                        class="label label-theme">{{ number_format(($discount->discount / $discount->regular_price) * 100) }}%
                                        Off</span>
                                </div>
                                <div class="cart-wrap">
                                    <ul>
                                        <li>
                                            <a href="#" class="add-card" data-product-id="{{ $discount->id }}">
                                                <i data-feather="shopping-cart"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('shop.product.details', ['slug' => $discount->slug]) }}"
                                                data-bs-toggle="modal" data-bs-target="#quick-view">
                                                <i data-feather="eye"></i>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#" class="add-wishlist"
                                                data-product-id="{{ $discount->id }}">
                                                <i data-feather="heart"></i>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product-style-3 product-style-chair">
                                <div class="product-title d-block mb-0">
                                    <div class="r-price">
                                        <div class="theme-color">
                                            {{ number_format($discount->regular_price - $discount->discount, 2) }}JD
                                        </div>

                                        <div class="product">
                                            <!-- other product details -->
                                            <div class="rating">
                                                <x-star-rating :rating="$discount->averageRating()" />
                                            </div>
                                        </div>

                                    </div>
                                    <p class="font-light mb-sm-2 mb-0">{{ $discount->category->name }}
                                    </p>
                                    <a href="product/details.html" class="font-default">
                                        <h5>{{ $discount->name }}</h5>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div id="qvmodal"></div>
    {{-- <form id="moveToCartForm-{{ $package->id }}" method="POST" action="{{ route('moveToCart') }}" style="display:none;">
    @csrf
    <input type="hidden" name="product_id" value="{{ $package->id }}">
    <input type="hidden" id="mrowId-{{ $package->id }}" name="rowId" value="">
</form> --}}

    <script>
        function addProductToWishlist(id, name, quantity, price) {
            $.ajax({
                type: 'POST',
                url: "{{ route('wishlist.add') }}",
                data: {
                    "_token": "{{ csrf_token() }}", // Include CSRF token
                    id: id,
                    name: name,
                    quantity: quantity,
                    price: price,
                },
                success: function(data) {
                    if (data.status == 200) {
                        getCartWishlistCount(); // Update the wishlist count
                        $.notify({
                            icon: 'fa fa-check',
                            title: "Success!",
                            message: "Item successfully added to your wishlist!"
                        });
                    } else {
                        console.error('Error:', data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }
    </script>
@endsection
