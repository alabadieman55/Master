@extends('layouts.base')
@section('content')
    <section class="breadcrumb-section section-b-space">
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
                    <h3>User Dashboard</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="index.php">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">User Dashboard</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb section end -->

    <!-- user dashboard section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <ul class="nav nav-tabs custome-nav-tabs flex-column category-option" id="myTab">
                        <li class="nav-item mb-2">
                            <button class="nav-link font-light active" id="tab" data-bs-toggle="tab"
                                data-bs-target="#dash" type="button"><i class="fas fa-angle-right"></i>Dashboard</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="1-tab" data-bs-toggle="tab" data-bs-target="#order"
                                type="button"><i class="fas fa-angle-right"></i>Orders</button>
                        </li>

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="2-tab" data-bs-toggle="tab"
                                data-bs-target="#wishlist" type="button"><i
                                    class="fas fa-angle-right"></i>Wishlist</button>
                        </li>

                        {{-- <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="3-tab" data-bs-toggle="tab" data-bs-target="#save"
                                type="button"><i class="fas fa-angle-right"></i>Saved
                                Address</button>
                        </li> --}}

                        {{-- <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="4-tab" data-bs-toggle="tab" data-bs-target="#pay"
                                type="button"><i class="fas fa-angle-right"></i>Payment</button>
                        </li> --}}

                        <li class="nav-item mb-2">
                            <button class="nav-link font-light" id="5-tab" data-bs-toggle="tab"
                                data-bs-target="#profile" type="button"><i class="fas fa-angle-right"></i>Profile</button>
                        </li>

                        {{-- <li class="nav-item">
                            <button class="nav-link font-light" id="6-tab" data-bs-toggle="tab"
                                data-bs-target="#security" type="button"><i
                                    class="fas fa-angle-right"></i>Security</button>
                        </li> --}}
                    </ul>
                </div>

                <div class="col-lg-9">
                    <div class="filter-button dash-filter dashboard">
                        <button class="btn btn-solid-default btn-sm fw-bold filter-btn">Show Menu</button>
                    </div>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="dash">
                            <div class="dashboard-right">
                                <div class="dashboard">
                                    <div class="page-title title title1 title-effect">
                                        <h2>My Dashboard</h2>
                                    </div>
                                    <div class="welcome-msg">
                                        <h6 class="font-light">Welcome, <span>{{ auth()->user()->name }} !</span></h6>

                                    </div>

                                    <div class="order-box-contain my-4">
                                        <div class="row g-4">
                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="assets/images/svg/box.png"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="assets/images/svg/box1.png"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">total order</h5>
                                                            <h3>{{ $orders }}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="assets/images/svg/sent.png"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="assets/images/svg/sent1.png"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">pending orders</h5>
                                                            <h3>{{ $pendingOrders }}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-4 col-sm-6">
                                                <div class="order-box">
                                                    <div class="order-box-image">
                                                        <img src="assets/images/svg/wishlist.png"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                    <div class="order-box-contain">
                                                        <img src="assets/images/svg/wishlist1.png"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                        <div>
                                                            <h5 class="font-light">wishlist</h5>
                                                            <h3>{{ $wishlists }}</h3>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="box-account box-info">
                                        <div class="box-head">
                                            <h3>Account Information</h3>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="box">
                                                    <div class="box-title">
                                                        <h4>Contact Information</h4>
                                                    </div>
                                                    <div class="box-content">
                                                        <h6 class="font-light">{{ auth()->user()->name }}</h6>
                                                        <h6 class="font-light">{{ auth()->user()->email }}</h6>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                        <div>
                                            {{-- <div class="box address-box">
                                                <div class="box-title">
                                                    <h4>Address Book</h4><a href="javascript:void(0)">Manage
                                                        Addresses</a>
                                                </div> --}}
                                            {{-- <div class="box-content">
                                                    <div class="row g-4">
                                                        <div class="col-sm-6">
                                                            <h6 class="font-light">Default Billing Address</h6>
                                                            <h6 class="font-light">You have not set a default
                                                                billing address.</h6>
                                                            <a href="javascript:void(0)">Edit Address</a>
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <h6 class="font-light">Default Shipping Address</h6>
                                                            <h6 class="font-light">You have not set a default
                                                                shipping address.</h6>
                                                            <a href="javascript:void(0)">Edit Address</a>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane fade table-dashboard dashboard wish-list-section" id="order">
                        <div class="box-head mb-3">
                            <h3>My Order</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table cart-table">
                                <thead>
                                    <tr class="table-head">
                                        <th scope="col">image</th>
                                        <th scope="col">Order Id</th>
                                        <th scope="col">Product Details</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>



                                    @foreach ($ordersData as $order)
                                        <tr>
                                            <td>
                                                @foreach ($order->items as $item)
                                                    <a href="details.php">
                                                        <img src="{{ asset('storage/products/' . $item->product->image) }}"
                                                            class="blur-up lazyload" alt="">
                                                    </a>
                                                @endforeach

                                            </td>
                                            <td>
                                                <p class="mt-0">#1{{ $order->id }}</p>
                                            </td>

                                            <td>
                                                @foreach ($order->items as $item)
                                                    <p class="fs-6 m-0">{{ $item->product->name }}</p>
                                                @endforeach

                                            </td>
                                            <td>
                                                <p class="success-button btn btn-sm">{{ $order->status }}</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">${{ $order->total }}</p>
                                            </td>


                                        </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="tab-pane fade table-dashboard dashboard wish-list-section" id="wishlist">
                        <div class="box-head mb-3">
                            <h3>My Wishlist</h3>
                        </div>
                        <div class="table-responsive">
                            <table class="table cart-table">
                                <thead>

                                    <tr class="table-head">
                                        <th scope="col">image</th>
                                        <th scope="col">Order Id</th>
                                        <th scope="col">Product Details</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($wishlistsData as $wishlist)
                                        <tr>
                                            <td>
                                                <a href="details.php">
                                                    <img src="{{ asset('storage/products/' . $wishlist->image) }}"
                                                        class="blur-up lazyload" alt="">
                                                </a>
                                            </td>

                                            <td>
                                                <p class="m-0">#{{ $wishlist->id }}</p>
                                            </td>

                                            <td>
                                                <p class="fs-6 m-0">{{ $wishlist->product->name }}</p>
                                            </td>
                                            <td>
                                                <p class="theme-color fs-6">${{ $wishlist->price }}</p>
                                            </td>

                                            <td>
                                                <a href="#" class="btn btn-solid-default btn-sm fw-bold add-card"
                                                    data-product-id="{{ $wishlist->product->id }}">
                                                    Move
                                                    to
                                                    Cart</a>
                                            </td>
                                        </tr>
                                    @endforeach








                                </tbody>
                            </table>
                        </div>
                    </div>

                    {{-- <div class="tab-pane fade dashboard" id="save">
                            <div class="box-head">
                                <h3>Save Address</h3>
                                <button class="btn btn-solid-default btn-sm fw-bold ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addAddress"><i class="fas fa-plus"></i>
                                    Add New Address</button>
                            </div>
                            <div class="save-details-box">
                                <div class="row g-3">
                                    <div class="col-xl-4 col-md-6">
                                        <div class="save-details">
                                            <div class="save-name">
                                                <h5>Mark Jugal</h5>
                                                <div class="save-position">
                                                    <h6>Home</h6>
                                                </div>
                                            </div>

                                            <div class="save-address">
                                                <p class="font-light">549 Sulphur Springs Road</p>
                                                <p class="font-light">Downers Grove, IL</p>
                                                <p class="font-light">60515</p>
                                            </div>

                                            <div class="mobile">
                                                <p class="font-light mobile">Mobile No. +1-123-456-7890</p>
                                            </div>

                                            <div class="button">
                                                <a href="javascript:void(0)" class="btn btn-sm">Edit</a>
                                                <a href="javascript:void(0)" class="btn btn-sm">Remove</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <div class="save-details">
                                            <div class="save-name">
                                                <h5>Method Zaki</h5>
                                                <div class="save-position">
                                                    <h6>Office</h6>
                                                </div>
                                            </div>

                                            <div class="save-address">
                                                <p class="font-light">549 Sulphur Springs Road</p>
                                                <p class="font-light">Downers Grove, IL</p>
                                                <p class="font-light">60515</p>
                                            </div>

                                            <div class="mobile">
                                                <p class="font-light mobile">Mobile No. +1-123-456-7890</p>
                                            </div>

                                            <div class="button">
                                                <a href="javascript:void(0)" class="btn btn-sm">Edit</a>
                                                <a href="javascript:void(0)" class="btn btn-sm">Remove</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xl-4 col-md-6">
                                        <div class="save-details">
                                            <div class="save-name">
                                                <h5>Mark Jugal</h5>
                                                <div class="save-position">
                                                    <h6>Home</h6>
                                                </div>
                                            </div>

                                            <div class="save-address">
                                                <p class="font-light">549 Sulphur Springs Road</p>
                                                <p class="font-light">Downers Grove, IL</p>
                                                <p class="font-light">60515</p>
                                            </div>

                                            <div class="mobile">
                                                <p class="font-light mobile">Mobile No. +1-123-456-7890</p>
                                            </div>

                                            <div class="button">
                                                <a href="javascript:void(0)" class="btn btn-sm">Edit</a>
                                                <a href="javascript:void(0)" class="btn btn-sm">Remove</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    {{-- <div class="tab-pane fade dashboard" id="pay">
                            <div class="box-head">
                                <h3>Card & Payment</h3>
                                <button class="btn btn-solid-default btn-sm fw-bold ms-auto" data-bs-toggle="modal"
                                    data-bs-target="#addPayment"><i class="fas fa-plus"></i>
                                    Add New Card</button>
                            </div>

                            <div class="card-details-section">
                                <div class="row g-4">
                                    <div class="col-lg-4 col-sm-6">
                                        <div class="payment-card-detail">
                                            <div class="card-details">
                                                <div class="card-number">
                                                    <h4>XXXX - XXXX - XXXX - 2548</h4>
                                                </div>

                                                <div class="valid-detail">
                                                    <div class="title">
                                                        <span>valid</span>
                                                        <span>thru</span>
                                                    </div>
                                                    <div class="date">
                                                        <h3>12/23</h3>
                                                    </div>
                                                    <div class="primary">
                                                        <span class="badge bg-pill badge-light">primary</span>
                                                    </div>
                                                </div>

                                                <div class="name-detail">
                                                    <div class="name">
                                                        <h5>mark jecno</h5>
                                                    </div>
                                                    <div class="card-img">
                                                        <img src="assets/images/payment-icon/1.jpg"
                                                            class="img-fluid blur-up lazyloaded" alt="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="edit-card">
                                                <a data-bs-toggle="modal" data-bs-target="#addPayment"
                                                    href="javascript:void(0)"><i class="far fa-edit"></i> edit</a>
                                                <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                    delete</a>
                                            </div>
                                        </div>

                                        <div class="edit-card-mobile">
                                            <a data-bs-toggle="modal" data-bs-target="#addPayment"
                                                href="javascript:void(0)"><i class="far fa-edit"></i> edit</a>
                                            <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                delete</a>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6">
                                        <div class="payment-card-detail">
                                            <div class="card-details card-visa">
                                                <div class="card-number">
                                                    <h4>XXXX - XXXX - XXXX - 2548</h4>
                                                </div>

                                                <div class="valid-detail">
                                                    <div class="title">
                                                        <span>valid</span>
                                                        <span>thru</span>
                                                    </div>
                                                    <div class="date">
                                                        <h3>12/23</h3>
                                                    </div>
                                                    <div class="primary">
                                                        <span class="badge bg-pill badge-light">primary</span>
                                                    </div>
                                                </div>

                                                <div class="name-detail">
                                                    <div class="name">
                                                        <h5>mark jecno</h5>
                                                    </div>
                                                    <div class="card-img">
                                                        <img src="assets/images/payment-icon/2.jpg"
                                                            class="img-fluid blur-up lazyloaded" alt="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="edit-card">
                                                <a data-bs-toggle="modal" data-bs-target="#addPayment"
                                                    href="javascript:void(0)"><i class="far fa-edit"></i> edit</a>
                                                <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                    delete</a>
                                            </div>
                                        </div>

                                        <div class="edit-card-mobile">
                                            <a data-bs-toggle="modal" data-bs-target="#addPayment"
                                                href="javascript:void(0)"><i class="far fa-edit"></i> edit</a>
                                            <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                delete</a>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 col-sm-6">
                                        <div class="payment-card-detail">
                                            <div class="card-details dabit-card">
                                                <div class="card-number">
                                                    <h4>XXXX - XXXX - XXXX - 2548</h4>
                                                </div>

                                                <div class="valid-detail">
                                                    <div class="title">
                                                        <span>valid</span>
                                                        <span>thru</span>
                                                    </div>
                                                    <div class="date">
                                                        <h3>12/23</h3>
                                                    </div>
                                                    <div class="primary">
                                                        <span class="badge bg-pill badge-light">primary</span>
                                                    </div>
                                                </div>

                                                <div class="name-detail">
                                                    <div class="name">
                                                        <h5>mark jecno</h5>
                                                    </div>
                                                    <div class="card-img">
                                                        <img src="assets/images/payment-icon/3.jpg"
                                                            class="img-fluid blur-up lazyloaded" alt="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="edit-card">
                                                <a data-bs-toggle="modal" data-bs-target="#addPayment"
                                                    href="javascript:void(0)"><i class="far fa-edit"></i> edit</a>
                                                <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                    delete</a>
                                            </div>
                                        </div>

                                        <div class="edit-card-mobile">
                                            <a data-bs-toggle="modal" data-bs-target="#addPayment"
                                                href="javascript:void(0)"><i class="far fa-edit"></i> edit</a>
                                            <a href="javascript:void(0)"><i class="far fa-minus-square"></i>
                                                delete</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> --}}

                    <div class="tab-pane fade dashboard-profile dashboard" id="profile">
                        <div class="box-head">
                            <h3>Profile</h3>
                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#resetEmail">Edit</a>
                        </div>
                        <ul class="dash-profile">
                            <li>
                                <div class="left">
                                    <h6 class="font-light">Company Name</h6>
                                </div>
                                <div class="right">
                                    <h6>Surfside Media Fashion</h6>
                                </div>
                            </li>

                            <li>
                                <div class="left">
                                    <h6 class="font-light">Country / Region</h6>
                                </div>
                                <div class="right">
                                    <h6>Downers Grove, IL</h6>
                                </div>
                            </li>

                            <li>
                                <div class="left">
                                    <h6 class="font-light">Year Established</h6>
                                </div>
                                <div class="right">
                                    <h6>2018</h6>
                                </div>
                            </li>

                            <li>
                                <div class="left">
                                    <h6 class="font-light">Total Employees</h6>
                                </div>
                                <div class="right">
                                    <h6>101 - 200 People</h6>
                                </div>
                            </li>

                            <li>
                                <div class="left">
                                    <h6 class="font-light">Category</h6>
                                </div>
                                <div class="right">
                                    <h6>Clothing</h6>
                                </div>
                            </li>

                            <li>
                                <div class="left">
                                    <h6 class="font-light">Street Address</h6>
                                </div>
                                <div class="right">
                                    <h6>549 Sulphur Springs Road</h6>
                                </div>
                            </li>
                        @endsection
