{{-- resources/views/checkout/success.blade.php --}}
@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header bg-success text-white">
                        Payment Successful!
                    </div>
                    <div class="card-body">
                        <h4 class="mb-4">Thank you for your order!</h4>

                        <div class="alert alert-success">
                            <p>Your payment was processed successfully.</p>
                        </div>



                        <a href="/shop" class="btn btn-primary">
                            Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
