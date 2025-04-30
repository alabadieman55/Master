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
                                <a href="{{ route('app.index') }}">
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

    <!-- Checkout Section Start -->
    <section class="section-b-space">
        <div class="container">
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <div class="row g-4">
                <div class="col-lg-8">
                    <form action="{{ route('checkout.place-order') }}" id="payment-form" method="POST">
                        @csrf

                        <!-- Add billing address fields -->
                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            <div class="col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label for="city" class="form-label">City</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                            <div class="col-md-4">
                                <label for="state" class="form-label">State/Region</label>
                                <input type="text" class="form-control" id="state" name="state" required>
                            </div>
                            <div class="col-md-4">
                                <label for="zip" class="form-label">ZIP Code</label>
                                <input type="text" class="form-control" id="zip" name="zip" required>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label for="country" class="form-label">Country</label>
                            <select class="form-control" id="country" name="country" required>
                                <option value="Jordan">Jordan</option>
                                <!-- Add other countries as needed -->
                            </select>
                        </div>

                        <!-- Payment method selection -->
                        <div class="mb-4">
                            <h5>Payment Method</h5>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="stripe"
                                    value="stripe" checked>
                                <label class="form-check-label" for="stripe">
                                    Credit/Debit Card
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="payment_method" id="cod"
                                    value="cod">
                                <label class="form-check-label" for="cod">
                                    Cash on Delivery
                                </label>
                            </div>
                        </div>

                        <!-- Stripe Card Element -->
                        <div id="card-element-container" class="mb-4">
                            <label for="card-element" class="form-label">Card Details</label>
                            <div id="card-element" class="form-control"></div>
                            <div id="card-errors" role="alert" class="text-danger mt-2"></div>
                        </div>


                        <div class="col-md-12 mt-4">
                            <button id="submit-button" type="submit" class="btn btn-solid-default">
                                <span id="spinner" class="spinner-border spinner-border-sm d-none"
                                    role="status"></span>
                                <span id="button-text">Pay Now</span>
                            </button>
                        </div>
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
                                            <h6 class="my-0">{{ $item->product->name }}</h6>
                                            <small class="text-muted">Quantity: {{ $item->quantity }}</small>
                                        </div>
                                        <span
                                            class="text-muted">{{ number_format($item->product->regular_price * $item->quantity, 2) }}
                                            JOD</span>
                                    </li>
                                @endforeach
                            @else
                                <li class="list-group-item d-flex justify-content-between lh-condensed">
                                    <div>
                                        <h6 class="my-0">No items in cart</h6>
                                    </div>
                                    <span class="text-muted">0.00 JOD</span>
                                </li>
                            @endif

                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Subtotal</h6>
                                </div>

                                <span class="text-muted">{{ number_format($cartTotal, 2) }} JOD</span>
                            </li>
                            @php
                                $taxRate = 0.16; // 16% tax
                                $tax = $cartTotal * $taxRate;
                                $total = $cartTotal + $tax;
                            @endphp

                            <li class="list-group-item d-flex justify-content-between lh-condensed">
                                <div>
                                    <h6 class="my-0">Tax (16%)</h6>
                                </div>
                                <span class="text-muted">{{ number_format($tax ?? 0, 2) }} JOD</span>
                            </li>

                            <li class="list-group-item d-flex lh-condensed justify-content-between bg-light">
                                <span class="fw-bold">Total (JOD)</span>
                                <strong>{{ number_format($total ?? 0, 2) }} JOD</strong>
                            </li>
                        </ul>

                        <form class="card border-0">
                            <div class="input-group custome-input-group">
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

                try {
                    // Create PaymentIntent on the server
                    const response = await fetch('{{ route('checkout.create-payment-intent') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            name: document.getElementById('name').value,
                            email: document.getElementById('email').value,
                            phone: document.getElementById('phone').value,
                            address: document.getElementById('address').value,
                            city: document.getElementById('city').value,
                            state: document.getElementById('state').value,
                            zip: document.getElementById('zip').value,
                            country: document.getElementById('country').value,
                            sameAsBilling: document.getElementById('sameAsBilling')
                                .checked,
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
                                email: document.getElementById('email').value,
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
                        window.location.href = '{{ route('checkout.success') }}?payment_intent=' +
                            result.paymentIntent.id;
                    }
                } catch (error) {
                    showError("An error occurred. Please try again.");
                    console.error(error);
                }
            });

            function showError(errorMessage) {
                cardErrors.textContent = errorMessage;
                submitButton.disabled = false;
                spinner.classList.add('hidden');
                buttonText.textContent = 'Pay Now';
            }
        });
    </script>
@endsection
