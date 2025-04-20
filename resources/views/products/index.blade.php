@extends('layouts.admin')

@section('content')
    <div class="dashboard-content">
        <div class="page-header">
            <h1 class="page-title">Products</h1>
            <ul class="breadcrumb">
                <li>Home</li>
                <li>Products</li>
            </ul>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <div class="card-header">
                <h3>All Products</h3>
                <a href="{{ route('products.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Add New Product
                </a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Category</th>
                                <th>SKU</th>
                                <th>Price</th>
                                <th>Discount</th>
                                <th>Stock</th>
                                <th>Quantity</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $product->id }}</td>
                                    <td>
                                        <img src="{{ asset('storage/products/' . $product->image) }}"
                                            alt="{{ $product->name }}" width="50">
                                    </td>
                                    <td>{{ $product->name }}</td>
                                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                                    <td>{{ $product->SKU }}</td>
                                    <td>${{ number_format($product->regular_price, 2) }}</td>
                                    <td>
                                        @if ($product->discount)
                                            ${{ number_format($product->discount, 2) }}
                                            ({{ number_format(($product->discount / $product->regular_price) * 100, 2) }}%)
                                        @else
                                            -
                                        @endif
                                    </td>
                                    <td>
                                        @if ($product->stock_status === 'instock')
                                            <span class="badge bg-success">In Stock</span>
                                        @else
                                            <span class="badge bg-danger">Out of Stock</span>
                                        @endif
                                    </td>
                                    <td style="text-align: center">{{ $product->quantity }}</td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-info"
                                                title="View">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-primary"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('products.destroy', $product) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Delete"
                                                    onclick="return confirm('Are you sure you want to delete this product?')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="10" class="text-center">No products found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="pagination-links">
                    {{ $products->withQuerystring()->links('pagination.default') }}
                </div>
            </div>
        </div>
    </div>
@endsection
