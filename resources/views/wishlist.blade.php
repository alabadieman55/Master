@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1 class="mb-4">My Wishlist</h1>

                <div class="wishlist-container">
                    @if ($wishlistItems->count() > 0)
                        <div class="row">
                            @foreach ($wishlistItems as $item)
                                <div class="col-md-4 col-sm-6 mb-4">
                                    <div class="wishlist-item product-card">
                                        <div class="position-relative">
                                            <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}"
                                                class="img-fluid mb-3">
                                            <a href="#" class="add-wishlist active"
                                                data-product-id="{{ $item->product_id }}">
                                                <i data-feather="heart" fill="currentColor" class="text-danger"></i>
                                            </a>
                                        </div>

                                        <h5 class="product-title">{{ $item->product->name }}</h5>
                                        <p class="product-price">{{ $item->product->formatted_price }}</p>

                                        <div class="wishlist-actions">
                                            <form action="{{ route('wishlist.moveToCart', $item->product_id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-primary">Add to Cart</button>
                                            </form>

                                            <form action="{{ route('wishlist.remove', $item->product_id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-outline-danger">Remove</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="empty-wishlist">
                            <p>Your wishlist is empty</p>
                            <a href="/shop" class="btn btn-primary">Continue Shopping</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('js/wishlist.js') }}"></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/wishlist-styles.css') }}">
@endpush
