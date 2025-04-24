@extends('layouts.base')
@section('content')
    @push('styles')
        <link id="color-link" rel="stylesheet" type="text/css" href="assets/css/demo2.css">
        <style>
            nav svg {
                height: 20px;

            }

            .product-box .product-details h5 {

                width: 100%;

            }
        </style>
    @endpush
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
                    <h3>Shop</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="route('app.index)">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Shop</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 category-side col-md-4">
                    <div class="category-option">
                        <div class="button-close mb-3">
                            <button class="btn p-0"><i data-feather="arrow-left"></i> Close</button>
                        </div>
                        <div class="accordion category-name" id="accordionExample">
                            <div class="accordion-item category-rating">
                                <h2 class="accordion-header" id="headingTwo">

                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse show"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body category-scroll">

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item category-color">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseThree">
                                        Color
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse show"
                                    aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class="category-list">
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)">
                                                    <i class="fas fa-check"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item category-price">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseFour">Price</button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse show"
                                    aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <div class="range-slider category-list">
                                            <input type="text" class="js-range-slider" id="js-range-price"
                                                value="">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item category-price">
                                <h2 class="accordion-header" id="headingFive">

                                </h2>

                                <div id="collapseFive" class="accordion-collapse collapse show"
                                    aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">

                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item category-rating">
                                <h2 class="accordion-heafr" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSix">
                                        Category
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse show" aria-labelledby="headingOne">
                                    <div class="accordion-body category-scroll">
                                        <ul class="category-list">
                                            @foreach ($categories as $category)
                                                <li>
                                                    <div class="form-check ps-0 custome-form-check">
                                                        <input class="checkbox_animated check-it"
                                                            id="ct{{ $category->id }}" name="categories"
                                                            @if (in_array($category->id, explode(',', $q_categories))) checked="checked" @endif
                                                            type="checkbox" value="{{ $category->id }}"
                                                            onchange="filiterproductesByCategory(this)">
                                                        <label class="form-check-label">{{ $category->name }}</label>
                                                        <p class="font-light">({{ $category->products->count() }})</p>
                                                    </div>
                                                </li>
                                            @endforeach










                                        </ul>
                                    </div>
                                </div>
                            </div>

                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingSeven">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseSeven">
                                        Discount Range
                                    </button>
                                </h2>
                                <div id="collapseSeven" class="accordion-collapse collapse show"
                                    aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul class="category-list">
                                            @foreach ($discounts as $discountPercent)
                                                <li>
                                                    <div class="form-check ps-0 custome-form-check">
                                                        <input class="checkbox_animated check-it" type="checkbox"
                                                            id="discount-{{ $discountPercent }}"
                                                            onchange="filterByDiscount(this, {{ $discountPercent }})">
                                                        <label class="form-check-label"
                                                            for="discount-{{ $discountPercent }}">
                                                            {{ $discountPercent }}% OFF
                                                        </label>
                                                    </div>
                                                </li>
                                            @endforeach



                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="category-product col-lg-9 col-12 ratio_30">

                    <div class="row g-4">
                        <!-- label and featured section -->
                        <div class="col-md-12">
                            <ul class="short-name">


                            </ul>
                        </div>

                        <div class="col-12">
                            <div class="filter-options">
                                <div class="select-options">
                                    <div class="page-view-filter">
                                        <div class="dropdown select-featured">
                                            <select class="form-select" name="orderby" id="orderby">
                                                <option value="-1" {{ $order == -1 ? 'selected' : '' }}>Sort BY
                                                </option>
                                                <option value="1" {{ $order == 1 ? 'selected' : '' }}>Date, New To Old
                                                </option>
                                                <option value="2" {{ $order == 2 ? 'selected' : '' }}>Date, Old To
                                                    New
                                                </option>
                                                <option value="3" {{ $order == 3 ? 'selected' : '' }}>Price, Low To
                                                    High
                                                </option>
                                                <option value="4" {{ $order == 4 ? 'selected' : '' }}>Price, High To
                                                    Low
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="dropdown select-featured">
                                        <select class="form-select" name="size" id="pagesize">
                                            <option value="12" {{ $size == 12 ? 'selected' : '' }}>12 Products Per
                                                Page
                                            </option>
                                            <option value="24" {{ $size == 24 ? 'selected' : '' }}>24 Products Per
                                                Page
                                            </option>
                                            <option value="52" {{ $size == 52 ? 'selected' : '' }}>52 Products Per
                                                Page
                                            </option>
                                            <option value="100" {{ $size == 100 ? 'selected' : '' }}>100 Products Per
                                                Page
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="grid-options d-sm-inline-block d-none">
                                    <ul class="d-flex">
                                        <li class="two-grid">
                                            <a href="javascript:void(0)">
                                                <img src="assets/svg/grid-2.svg" class="img-fluid blur-up lazyload"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li class="three-grid d-md-inline-block d-none">
                                            <a href="javascript:void(0)">
                                                <img src="assets/svg/grid-3.svg" class="img-fluid blur-up lazyload"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li class="grid-btn active d-lg-inline-block d-none">
                                            <a href="javascript:void(0)">
                                                <img src="assets/svg/grid.svg" class="img-fluid blur-up lazyload"
                                                    alt="">
                                            </a>
                                        </li>
                                        <li class="list-btn">
                                            <a href="javascript:void(0)">
                                                <img src="assets/svg/list.svg" class="img-fluid blur-up lazyload"
                                                    alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- label and featured section -->

                    <!-- Prodcut setion -->
                    <div
                        class="row g-sm-4 g-3 row-cols-lg-4 row-cols-md-3 row-cols-2 mt-1 custom-gy-5 product-style-2 ratio_asos product-list-section">
                        @foreach ($products as $product)
                            <div>
                                <div class="product-box">
                                    <div class="img-wrapper">
                                        <div class="front">
                                            <a href="{{ route('shop.product.details', ['slug' => $product->slug]) }}">
                                                <img src="{{ asset('storage/products/' . $product->image) }}"
                                                    class="bg-img blur-up lazyload" alt="">
                                            </a>
                                        </div>
                                        <div class="back">
                                            <a href="{{ route('shop.product.details', ['slug' => $product->slug]) }}">
                                                <img src="assets/images/fashion/product/back/{{ $product->image }}"
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
                                                    <a href="javascript:void(0)">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" class="add-wishlist"
                                                        data-product-id="{{ $product->id }}">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-details">
                                        <div class="rating-details">
                                            <span class="font-light grid-content">{{ $product->category->name }}</span>
                                            <ul class="rating mt-0">
                                                <li>
                                                    <i class="fas fa-star theme-color"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star theme-color"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                                <li>
                                                    <i class="fas fa-star"></i>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="main-price">
                                            <a href="{{ route('shop.product.details', ['slug' => $product->slug]) }}"
                                                class="font-default">
                                                <h5 class="ms-0">{{ $product->name }}</h5>
                                            </a>
                                            <div class="listing-content">
                                                <span class="font-light">{{ $product->category->name }}</span>
                                                <p class="font-light">{{ $product->short_description }}</p>
                                            </div>
                                            <h3 class="theme-color">
                                                {{ number_format($product->regular_price - $product->discount, 2) }}</h3>
                                            <button class="btn listing-content">Add To Cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach




                    </div>
                    {{ $products->withQuerystring()->links('pagination.default') }}

                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section end -->
    <!-- Subscribe Section Start -->
    <section class="subscribe-section section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-6">
                    <div class="subscribe-details">
                        <h2 class="mb-3">Subscribe Our News</h2>
                        <h6 class="font-light">Subscribe and receive our newsletters to follow the news about our fresh
                            and fantastic Products.</h6>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 mt-md-0 mt-3">
                    <div class="subsribe-input">
                        <div class="input-group">
                            <input type="text" class="form-control subscribe-input" placeholder="Your Email Address">
                            <button class="btn btn-solid-default" type="button">Button</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Subscribe Section End -->
    <form id="frmFilter" method="GET" action="{{ route('shop.index') }}">
        <input type="hidden" name="page" id="page" value="{{ $page }}" />
        <input type="hidden" name="size" id="size" value="{{ $size }}" />
        <input type="hidden" name="order" id="order" value="{{ $order }}" />
        <input type="hidden" name="categories" id="categories" value="{{ $q_categories }}" />
        <input type="hidden" name="prange" id="prange" value="{{ $prange }}" />
        <input type="hidden" name="discount" id="discount" value="{{ request('discount', '') }}" />
    </form>
@endsection
@push('scripts')
    <script>
        // Pass PHP variables to JavaScript
        var fromValue = {{ $from }};
        var toValue = {{ $to }};


        $(function() {
            // Initialize the price range slider
            $(".js-range-slider").ionRangeSlider({
                type: "double",
                min: 0,
                max: 500,
                from: fromValue,
                to: toValue,
                grid: true,
                prefix: "$",
                onFinish: function(data) {
                    $("#prange").val(data.from + "," + data.to);
                    $("#frmFilter").submit();
                }
            });

            // Page size change
            $("#pagesize").on("change", function() {
                $("#size").val($(this).val());
                $("#frmFilter").submit();
            });

            // Order by change
            $("#orderby").on("change", function() {
                $("#order").val($(this).val());
                $("#frmFilter").submit();
            });

            // Discount filter
            $("input[id^='discount-']").on("change", function() {
                // Implement discount filtering logic here
                // You'll need to add a 'discount' parameter to your form
            });
        });

        function filiterproductesByCategory(checkbox) {
            var categories = [];
            $("input[name='categories']:checked").each(function() {
                categories.push(this.value);
            });
            $("#categories").val(categories.join(','));
            $("#frmFilter").submit();
        }

        function getCartWishlistCount() {
            $.ajax({
                type: 'GET',
                url: "{{ route('shop.cart.wishlist.count') }}",
                success: function(data) {
                    if (data.status == 200) {
                        $("#cartCount").html(data.cartCount);
                        $("#wishlist-count").html(data.wishlistCount);
                    } else {
                        console.error('Error:', data.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        }

        function filterByDiscount(checkbox, discountPercent) {
            var checkedDiscounts = [];
            $("input[id^='discount-']:checked").each(function() {
                checkedDiscounts.push($(this).attr('id').replace('discount-', ''));
            });
            $("#discount").val(checkedDiscounts.join(','));
            $("#frmFilter").submit();
        }

        $(document).ready(function() {
            feather.replace(); // Initialize feather icons

            $('.add-wishlist').click(function(e) {
                e.preventDefault();

                const button = $(this);
                const productId = button.data('product-id');

                $.ajax({
                    url: '/wishlist/toggle',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // Update UI based on response
                        if (response.status === 'added') {
                            button.addClass('active');
                            // You can also change the icon to a filled heart
                        } else {
                            button.removeClass('active');
                            // Change back to outline heart
                        }

                        // Optional: Show a toast notification
                        toastr.success(response.status === 'added' ?
                            'Added to wishlist' :
                            'Removed from wishlist');
                    },
                    error: function(xhr) {
                        if (xhr.status === 401) {
                            // User not authenticated
                            window.location.href = '/login';
                        } else {
                            toastr.error('Something went wrong');
                        }
                    }
                });
            });
        });

        document.addEventListener("DOMContentLoaded", function() {
            // Get all "Add to Cart" buttons
            const addToCartButtons = document.querySelectorAll(".add-card");

            // Add click event listeners to all "Add to Cart" buttons
            addToCartButtons.forEach((button) => {
                button.addEventListener("click", function(e) {
                    e.preventDefault();

                    // Get product ID from data attribute
                    const productId = this.getAttribute("data-product-id");

                    // Call the addToCart function
                    addToCart(productId, 1); // Assuming quantity of 1
                });
            });
        });

        // Function to send AJAX request to the Laravel controller
        function addToCart(productId, quantity) {
            // Get CSRF token from meta tag
            const token = document
                .querySelector('meta[name="csrf-token"]')
                .getAttribute("content");

            fetch("/cart/add", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": token,
                        Accept: "application/json",
                    },
                    body: JSON.stringify({
                        product_id: productId,
                        quantity: quantity,
                    }),
                })
                .then((response) => {
                    if (response.status === 401) {
                        // User is not logged in
                        showNotification("Login to shop!", "warning");
                        throw new Error("User not authenticated");
                    }
                    return response.json();
                })
                .then((data) => {
                    if (data.success) {
                        // Update the cart counter in the header
                        updateCartCounter(data.cartCount);

                        // Show success notification
                        showNotification("Item added to cart!", "success");
                    } else {
                        showNotification("Failed to add item to cart", "error");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    if (error.message !== "User not authenticated") {
                        showNotification("An error occurred", "error");
                    }
                });
        }

        // Function to update the cart counter display
        function updateCartCounter(count) {
            const cartCounter = document.querySelector(".cart-counter");
            if (cartCounter) {
                cartCounter.textContent = count;
            }
        }

        function showNotification(message, type) {
            const notification = document.createElement("div");
            notification.className = `notification ${type}`;
            notification.textContent = message;
            document.body.appendChild(notification);

            // Add some basic styling
            notification.style.position = "fixed";
            notification.style.top = "20px";
            notification.style.right = "20px";
            notification.style.padding = "10px 20px";
            notification.style.borderRadius = "4px";
            notification.style.zIndex = "1000";

            if (type === "success") {
                notification.style.backgroundColor = "#4CAF50";
                notification.style.color = "white";
            } else {
                notification.style.backgroundColor = "#F44336";
                notification.style.color = "white";
            }

            // Remove notification after 3 seconds
            setTimeout(() => {
                notification.remove();
            }, 3000);
        }
    </script>
@endpush
