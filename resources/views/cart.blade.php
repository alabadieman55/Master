@extends('layouts.base')
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
                    <h3>Cart</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('app.index') }}">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Cart</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container">
            @if ($cartItems->count() > 0)
                <div class="row">
                    <div class="col-md-12 text-center">
                        <table class="table cart-table">
                            <thead>
                                <tr class="table-head">
                                    <th scope="col">image</th>
                                    <th scope="col">product name</th>
                                    <th scope="col">price</th>
                                    <th scope="col">quantity</th>
                                    <th scope="col">total</th>
                                    <th scope="col">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cartItems as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('shop.product.details', ['slug' => $item->product->slug]) }}">
                                                <img src="{{ asset('storage/products/' . $item->product->image) }}"
                                                    class="blur-up lazyloaded" alt="{{ $item->product->name }}">
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('shop.product.details', ['slug' => $item->product->slug]) }}">
                                                {{ $item->product->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <h2>${{ $item->price }}</h2>
                                        </td>
                                        <td>
                                            <div class="qty-box">
                                                <div class="input-group">
                                                    <input type="number" name="quantity" data-id="{{ $item->id }}"
                                                        onchange="updatequantity(this)" class="form-control input-number"
                                                        value="{{ $item->quantity }}" min="1">
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <h2 class="td-color">${{ number_format($cartTotal, 2) }}</h2>
                                        </td>
                                        <td>
                                            <a href="javascript:void(0)" onclick="removeCartItem('{{ $item->id }}')">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                    <div class="col-12 mt-md-5 mt-4">
                        <div class="row">
                            <div class="col-sm-7 col-5 order-1">
                                <div class="left-side-button text-end d-flex d-block justify-content-end">
                                    <a href="javascript:void(0)" onclick="clearCart()"
                                        class="text-decoration-underline theme-color d-block text-capitalize">clear
                                        all items</a>
                                </div>
                            </div>
                            <div class="col-sm-5 col-7">
                                <div class="left-side-button float-start">
                                    <a href="{{ route('shop.index') }}"
                                        class="btn btn-solid-default btn fw-bold mb-0 ms-0">
                                        <i class="fas fa-arrow-left"></i> Continue Shopping</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="cart-checkout-section">
                        <div class="row g-4">
                            <div class="col-lg-4 col-sm-6">
                                <div class="promo-section">
                                    <form class="row g-3">
                                        <div class="col-7">
                                            <input type="text" class="form-control" id="number"
                                                placeholder="Coupon Code">
                                        </div>
                                        <div class="col-5">
                                            <button class="btn btn-solid-default rounded btn">Apply Coupon</button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 ">
                                <div class="checkout-button">
                                    <a href="checkout" class="btn btn-solid-default btn fw-bold">
                                        Check Out <i class="fas fa-arrow-right ms-1"></i></a>
                                </div>
                            </div>

                            <div class="col-lg-4">
                                <div class="cart-box">
                                    <div class="cart-box-details">
                                        <div class="total-details">
                                            <div class="top-details">
                                                <h3>Cart Totals</h3>
                                                <h6>Sub Total <span>{{ number_format($cartTotal, 2) }}JOD</span></h6>
                                                @php
                                                    $taxRate = 0.16; // 16% tax
                                                    $tax = $cartTotal * $taxRate;
                                                    $total = $cartTotal + $tax;
                                                @endphp
                                                <h6>Tax (16%) <span>{{ number_format($tax, 2) }}JOD</span></h6>
                                                <h6>Total <span>{{ number_format($total, 2) }}JOD</span></h6>

                                            </div>
                                            <div class="bottom-details">
                                                <a href="checkout">Process Checkout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="col-md-12 text-center"></div>
                <h3>Your Cart is Empty</h3>
                <h2 class="mt-3"> Add Items to it Now.</h2>
                <a href="{{ route('shop.index') }}" class="btn btn-warning mt-5">Shop Now</a>
            @endif
        </div>
    </section>
    <form id="updateCartQty" action="{{ route('cart.update', ['id' => '__ID__']) }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" id="cartItemId" />
        <input type="hidden" name="quantity" id="quantity" />
    </form>

    <form id="deleteFromCart" action="{{ route('cart.remove', ['id' => '__ID__']) }}" method="POST">
        @csrf
        @method('DELETE')
        <input type="hidden" name="id" id="cartItemId_D" />
    </form>


    <form id="clearCart" action="{{ route('cart.clear') }}" method="POST">
        @csrf
        @method('DELETE')
    </form>


@endsection
@push('scripts')
    <script>
        function updatequantity(element) {
            // Get the item ID from the data-id attribute
            const id = element.getAttribute('data-id');
            // Get the new quantity value
            const quantity = element.value;

            // Call the function to update the cart
            updateCartQuantity(id, quantity);
        }



        function updateCartQuantity(id, quantity) {
            // Set the form values
            document.getElementById('cartItemId').value = id;
            document.getElementById('quantity').value = quantity;

            // Get the form element
            const form = document.getElementById('updateCartQty');

            // Replace the placeholder in the action URL
            form.action = form.action.replace('__ID__', id);

            // Submit the form via AJAX
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update cart count in UI if needed
                        if (document.querySelector('.cart-count')) {
                            document.querySelector('.cart-count').textContent = data.cartCount;
                        }

                        // Reload the page to reflect the updated cart totals
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error updating cart:', error));
        }

        function removeCartItem(id) {
            // Set the form value
            document.getElementById('cartItemId_D').value = id;

            // Get the form element
            const form = document.getElementById('deleteFromCart');

            // Replace the placeholder in the action URL
            form.action = form.action.replace('__ID__', id);

            // Submit the form via AJAX
            const formData = new FormData(form);

            fetch(form.action, {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Reload the page to show updated cart
                        window.location.reload();
                    }
                })
                .catch(error => console.error('Error removing item from cart:', error));
        }

        function clearCart() {
            if (confirm('Are you sure you want to clear your entire cart?')) {
                document.getElementById('clearCart').submit();
            }
        }
    </script>
@endpush
