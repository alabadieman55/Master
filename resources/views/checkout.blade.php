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
                    <h3>Checkout</h3>
                    <nav>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="/">
                                    <i class="fas fa-home"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section Start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-8">
                    <form id="payment-form" class="needs-validation">
                        @csrf
                        <div id="billingAddress" class="row g-4">
                            <h3 class="mb-3 theme-color">Billing address</h3>
                            <div class="col-md-6">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    placeholder="Enter Full Name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone"
                                    placeholder="Enter Phone Number" required>
                            </div>
                            <div class="col-md-6">
                                <label for="locality" class="form-label">Locality</label>
                                <input type="text" class="form-control" id="locality" name="locality"
                                    placeholder="Locality">
                            </div>
                            <div class="col-md-6">
                                <label for="landmark" class="form-label">Landmark</label>
                                <input type="text" class="form-control" id="landmark" name="landmark"
                                    placeholder="Landmark">
                            </div>

                            <div class="col-md-12">
                                <label for="address" class="form-label">Address</label>
                                <textarea class="form-control" id="address" name="address" required></textarea>
                            </div>

                            <div class="col-md-3">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" placeholder="City"
                                    required>
                            </div>

                            <div class="col-md-3">
                                <label for="country" class="form-label">Country</label>
                                <select class="form-select custome-form-select" id="country" name="country" required>
                                    <option>India</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="state" class="form-label">State</label>
                                <select class="form-select custome-form-select" id="state" name="state" required>
                                    <option selected="" disabled="" value="">Choose...</option>
                                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                                    <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                    <!-- Other states... -->
                                    <option value="West Bengal">West Bengal</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label for="zip" class="form-label">Zip</label>
                                <input type="text" class="form-control" id="zip" name="zip"
                                    placeholder="123456" required>
                            </div>

                            <div class="col-md-12 form-check ps-0 mt-3 custome-form-check"
                                style="padding-left:15px !important;">
                                <input class="checkbox_animated check-it" type="checkbox" name="sameAsBilling"
                                    id="sameAsBilling">
                                <label class="form-check-label checkout-label" for="sameAsBilling">Shipping address is
                                    same as Billing Address</label>
                            </div>
                        </div>

                        <div id="shippingAddress" class="row g-4 mt-5">
                            <h3 class="mb-3 theme-color">Shipping address</h3>
                            <!-- Shipping address fields (same structure as billing) -->
                            <!-- These fields should be hidden/shown based on the sameAsBilling checkbox -->
                        </div>

                        <div class="form-check ps-0 mt-3 custome-form-check">
                            <input class="checkbox_animated check-it" type="checkbox" name="saveAddress"
                                id="saveAddress">
                            <label class="form-check-label checkout-label" for="saveAddress">Save this information for
                                next time</label>
                        </div>

                        <hr class="my-lg-5 my-4">

                        <h3 class="mb-3">Payment</h3>

                        <div class="d-block my-3">
                            <div class="form-check custome-radio-box">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="stripe"
                                    checked>
                                <label class="form-check-label" for="stripe">Credit/Debit Card (Stripe)</label>
                            </div>
                            <div class="form-check custome-radio-box">
                                <input class="form-check-input" type="radio" name="paymentMethod" id="cod">
                                <label class="form-check-label" for="cod">COD</label>
                            </div>
                        </div>

                        <div id="card-element-container" class="my-3">
                            <!-- Stripe Elements will be inserted here -->
                            <div id="card-element" class="form-control"></div>
                            <div id="card-errors" class="text-danger mt-2" role="alert"></div>
                        </div>

                        <button id="submit-button" class="btn btn-solid-default mt-4" type="submit">
                            <div class="spinner hidden" id="spinner"></div>
                            <span id="button-text">Pay Now</span>
                        </button>
                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="your-cart-box">
                        <h3 class="mb-3 d-flex text-capitalize">Your cart<span
                                class="badge bg-theme new-badge rounded-pill ms-auto bg-dark">{{ count($cartItems ?? []) }}</span>
                        </h3>
                        <ul class="list-group mb-3">
                            @if (isset($cartItems) && count($cartItems) > 0)
                                @foreach ($cartItems as $item)
                                    <li class="list-group-item d-flex justify-content-between lh-condensed">
                                        <div>
                                            <h6 class="my-0">{{ $item->name }}</h6>
                                            <small class="text-muted" name="quantity">Quantity:{{ $item->qty }}</small>
                                        </div>
                                        <span class="text-muted">{{ $item->price * $item->qty }}JOD</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">No items in cart</h6>
                                    </div>
                                    <span class="text-muted">$0.00</span>
                                </li>
                            @endif

                            <li class="list-group-item d-flex justify-content-between lh-condensed active">
                                <div class="text-dark">
                                    <h6 class="my-0">Tax</h6>
                                    <small></small>
                                </div>
                                <span> {{ Cart::instance('cart')->tax() }}JOD </span>
                            </li>
                            <li class="list-group-item d-flex lh-condensed justify-content-between">
                                <span class="fw-bold">Total (JOD)</span>
                                <strong>{{ Cart::instance('cart')->total() }}JOD</strong>
                            </li>
                        </ul>

                        <form class="card border-0">
                            <div class="input-group custome-imput-group">
                                <input type="text" class="form-control" placeholder="Promo code">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-solid-default rounded-0">Redeem</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Create a Stripe client
            const stripe = Stripe('{{ config('services.stripe.key') }}');
            const elements = stripe.elements();

            // Custom styling for the card Element
            const style = {
                base: {
                    color: '#32325d',
                    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: '#aab7c4'
                    }
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            // Create an instance of the card Element
            const cardElement = elements.create('card', {
                style: style
            });

            // Add an instance of the card Element into the `card-element` div
            cardElement.mount('#card-element');

            // Handle form submission
            const form = document.getElementById('payment-form');
            const submitButton = document.getElementById('submit-button');
            const cardErrors = document.getElementById('card-errors');
            const spinner = document.getElementById('spinner');
            const buttonText = document.getElementById('button-text');

            // Toggle shipping address fields based on sameAsBilling checkbox
            const sameAsBillingCheckbox = document.getElementById('sameAsBilling');
            const shippingAddressDiv = document.getElementById('shippingAddress');

            sameAsBillingCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    shippingAddressDiv.style.display = 'none';
                } else {
                    shippingAddressDiv.style.display = 'flex';
                }
            });

            // Toggle payment method fields
            const stripeRadio = document.getElementById('stripe');
            const codRadio = document.getElementById('cod');
            const cardElementContainer = document.getElementById('card-element-container');

            stripeRadio.addEventListener('change', function() {
                if (this.checked) {
                    cardElementContainer.style.display = 'block';
                    buttonText.textContent = 'Pay Now';
                }
            });

            codRadio.addEventListener('change', function() {
                if (this.checked) {
                    cardElementContainer.style.display = 'none';
                    buttonText.textContent = 'Place Order';
                }
            });

            form.addEventListener('submit', async function(event) {
                event.preventDefault();

                // Disable the submit button to prevent repeated clicks
                submitButton.disabled = true;
                spinner.classList.remove('hidden');
                buttonText.textContent = 'Processing...';

                // Check if COD is selected
                if (codRadio.checked) {
                    // Handle COD payment method
                    form.action = '{{ route('checkout.place-order') }}';
                    form.method = 'POST';
                    form.submit();
                    return;
                }

                // Create PaymentIntent on the server
                const response = await fetch('{{ route('checkout.create-payment-intent') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        name: document.getElementById('name').value,
                        phone: document.getElementById('phone').value,
                        address: document.getElementById('address').value,
                        city: document.getElementById('city').value,
                        state: document.getElementById('state').value,
                        zip: document.getElementById('zip').value,
                        sameAsBilling: document.getElementById('sameAsBilling').checked,
                        // Include other form fields as needed
                    })
                });

                const data = await response.json();

                if (data.error) {
                    showError(data.error);
                    return;
                }

                const clientSecret = data.clientSecret;

                // Confirm the payment with the card Element
                const result = await stripe.confirmCardPayment(clientSecret, {
                    payment_method: {
                        card: cardElement,
                        billing_details: {
                            name: document.getElementById('name').value,
                            phone: document.getElementById('phone').value,
                            address: {
                                line1: document.getElementById('address').value,
                                city: document.getElementById('city').value,
                                state: document.getElementById('state').value,
                                postal_code: document.getElementById('zip').value,
                                country: document.getElementById('country').value
                            }
                        }
                    }
                });

                if (result.error) {
                    // Show error to your customer
                    showError(result.error.message);
                } else {
                    // The payment succeeded!
                    window.location.href = '{{ route('checkout.success') }}?payment_intent=' + result
                        .paymentIntent.id;
                }
            });

            function showError(errorMessage) {
                cardErrors.textContent = errorMessage;
                submitButton.disabled = false;
                spinner.classList.add('hidden');
                buttonText.textContent = 'Pay Now';
            }

            // Add some basic styles
            const style = document.createElement('style');
            style.innerHTML = `
            .hidden {
                display: none;
            }
            .spinner {
                display: inline-block;
                width: 20px;
                height: 20px;
                border: 3px solid rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                border-top-color: #fff;
                animation: spin 1s ease-in-out infinite;
                margin-right: 10px;
            }
            @keyframes spin {
                to { transform: rotate(360deg); }
            }
        `;
            document.head.appendChild(style);
        });
    </script>
@endsection
