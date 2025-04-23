@extends('layouts.admin')
<style>
    
    /* General Styles */
    :root {
        --primary-orange: #FF6B35;
        --orange-hover: #E05D2E;
        --secondary-gray: #6C757D;
        --light-bg: #F8F9FA;
        --dark-text: #333333;
        --medium-text: #444444;
        --light-text: #6C757D;
        --success-green: #28A745;
        --danger-red: #DC3545;
    }

    /* Card Styling */
    .card {
        border-radius: 12px;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        border: none;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .card-header {
        background-color: var(--light-bg);
        border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        padding: 20px 25px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .card-header h3 {
        margin: 0;
        color: var(--dark-text);
        font-weight: 700;
        font-size: 1.5rem;
    }

    .card-body {
        padding: 30px;
    }

    /* Button Styling - Orange Theme */
    .btn {
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn i {
        font-size: 0.9em;
    }

    .btn-primary {
        background-color: var(--primary-orange);
        color: white;
        box-shadow: 0 4px 12px rgba(255, 107, 53, 0.25);
    }

    .btn-primary:hover, .btn-primary:focus {
        background-color: var(--orange-hover);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(255, 107, 53, 0.35);
    }

    .btn-secondary {
        background-color: var(--secondary-gray);
        color: white;
        box-shadow: 0 4px 12px rgba(108, 117, 125, 0.15);
    }

    .btn-secondary:hover, .btn-secondary:focus {
        background-color: #5A6268;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(108, 117, 125, 0.25);
    }

    .action-buttons {
        display: flex;
        gap: 12px;
    }

    /* Product Image Styling */
    .product-main-image {
        margin-bottom: 25px;
        overflow: hidden;
        border-radius: 10px;
    }

    .product-main-image img {
        width: 100%;
        height: auto;
        max-height: 400px;
        object-fit: contain;
        transition: transform 0.5s ease;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .product-main-image:hover img {
        transform: scale(1.03);
    }

    .product-gallery {
        margin-top: 30px;
    }

    .product-gallery h5 {
        color: var(--medium-text);
        margin-bottom: 15px;
        font-weight: 600;
    }

    .product-gallery .img-thumbnail {
        width: 100%;
        height: 100px;
        object-fit: cover;
        border-radius: 6px;
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid #e9ecef;
    }

    .product-gallery .img-thumbnail:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        border-color: var(--primary-orange);
    }

    /* Product Details Styling */
    .product-details h4 {
        color: var(--dark-text);
        font-weight: 700;
        margin-bottom: 20px;
        font-size: 1.8rem;
    }

    .product-details h5 {
        color: var(--primary-orange);
        font-weight: 600;
        padding-bottom: 8px;
        margin-top: 30px;
        margin-bottom: 20px;
        position: relative;
        font-size: 1.3rem;
    }

    .product-details h5:after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 50px;
        height: 3px;
        background-color: var(--primary-orange);
    }

    .text-muted {
        color: var(--light-text) !important;
    }

    .fw-bold {
        color: var(--dark-text);
        font-weight: 600 !important;
    }

    /* Stock Status Badges */
    .badge {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .bg-success {
        background-color: var(--success-green) !important;
    }

    .bg-danger {
        background-color: var(--danger-red) !important;
    }

    /* Pricing Styling */
    .text-danger {
        color: var(--danger-red) !important;
    }

    .text-success {
        color: var(--success-green) !important;
    }

    /* Meta Info Styling */
    .meta-info {
        background-color: var(--light-bg);
        padding: 20px;
        border-radius: 10px;
        margin-top: 30px;
        border-left: 4px solid var(--primary-orange);
    }

    .meta-info div {
        margin-bottom: 8px;
    }

    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .card-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
            padding: 15px;
        }
        
        .action-buttons {
            width: 100%;
            flex-direction: column;
            gap: 10px;
        }
        
        .btn {
            width: 100%;
            justify-content: center;
        }
        
        .product-details h4 {
            font-size: 1.5rem;
        }
    }

    /* Additional Orange Elements */
    .breadcrumb {
        padding: 0;
        background: transparent;
        font-size: 0.9rem;
    }

    .breadcrumb li {
        color: var(--light-text);
    }

    .breadcrumb li:not(:last-child):after {
        content: '/';
        margin: 0 8px;
        color: var(--light-text);
    }

    .breadcrumb li:last-child {
        color: var(--primary-orange);
        font-weight: 500;
    }
</style>

@section('content')
    <div class="dashboard-content">
        <div class="page-header">
            <h1 class="page-title">Product Details</h1>
            <ul class="breadcrumb">
                <li>Home</li>
                <li>Products</li>
                <li>{{ $product->name }}</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>{{ $product->name }}</h3>
                <div class="action-buttons">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-text-primary ">
                        <i class="fas fa-arrow-left"></i> Back to Products
                    </a>
                </div>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- Product Images -->
                    <div class="col-md-5">
                        <div class="product-main-image mb-4">
                            <img src="{{ asset('storage/products/' . $product->image) }}" alt="{{ $product->name }}"
                                class="img-fluid rounded" style="max-height: 400px; width: auto;">
                        </div>

                        @if ($product->images && count(json_decode($product->images)) > 0)
                            <div class="product-gallery">
                                <h5>Additional Images</h5>
                                <div class="row">
                                    @foreach (json_decode($product->images) as $image)
                                        <div class="col-4 col-md-3 mb-3">
                                            <img src="{{ asset('storage/products/' . $image) }}"
                                                alt="Product Image {{ $loop->iteration }}" class="img-thumbnail"
                                                style="height: 100px; width: 100%; object-fit: cover;">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    <!-- Product Details -->
                    <div class="col-md-7">
                        <div class="product-details">
                            <div class="mb-4">
                                <h4 class="mb-3">{{ $product->name }}</h4>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="text-muted me-3">SKU:</span>
                                    <span class="fw-bold">{{ $product->SKU }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="text-muted me-3">Category:</span>
                                    <span class="fw-bold">{{ $product->category->name ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <div class="pricing mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="text-muted me-3">Regular Price:</span>
                                    <span class="fw-bold">${{ number_format($product->regular_price, 2) }}</span>
                                </div>
                                @if ($product->discount)
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-muted me-3">Discount:</span>
                                        <span class="fw-bold text-danger">
                                            ${{ number_format($product->discount, 2) }}
                                            ({{ number_format(($product->discount / $product->regular_price) * 100, 2) }}%
                                            off)
                                        </span>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <span class="text-muted me-3">Sale Price:</span>
                                        <span class="fw-bold text-success">
                                            {{ number_format($product->regular_price - $product->discount, 2) }}JD
                                        </span>
                                    </div>
                                @endif
                            </div>

                            <div class="stock-info mb-4">
                                <div class="d-flex align-items-center mb-2">
                                    <span class="text-muted me-3">Stock Status:</span>
                                    @if ($product->stock_status === 'instock')
                                        <span class="bg-success" style="color: white;font-weight: bold">In Stock</span>
                                    @else
                                        <span class="bg-danger"style="color: white;font-weight: bold">Out of Stock</span>
                                    @endif
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="text-muted me-3">Quantity Available:</span>
                                    <span class="fw-bold">{{ $product->quantity }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <span class="text-muted me-3">Featured:</span>
                                    <span class="fw-bold">{{ $product->featured ? 'Yes' : 'No' }}</span>
                                </div>
                            </div>

                            <div class="product-description mb-4">
                                <h5>Short Description</h5>
                                <p class="text-muted">{{ $product->short_description }}</p>

                                <h5>Full Description</h5>
                                <div class="text-muted">
                                    {!! $product->description !!}
                                </div>
                            </div>

                            <div class="meta-info">
                                <div class="d-flex">
                                    <span class="text-muted me-3">Created:</span>
                                    <span>{{ $product->created_at->format('M d, Y H:i') }}</span>
                                </div>
                                <div class="d-flex">
                                    <span class="text-muted me-3">Last Updated:</span>
                                    <span>{{ $product->updated_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .product-details h5 {
            border-bottom: 1px solid #eee;
            padding-bottom: 8px;
            margin-top: 20px;
            margin-bottom: 15px;
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }
    </style>
@endpush
