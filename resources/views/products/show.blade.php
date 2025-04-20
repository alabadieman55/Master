@extends('layouts.admin')

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
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">
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
                                            ${{ number_format($product->regular_price - $product->discount, 2) }}
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
