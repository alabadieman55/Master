@extends('layouts.admin')

@section('content')
<style>
    /* Admin Categories Page - Orange Theme */

:root {
  --primary-orange: #ff7a00;
  --light-orange: #ffab58;
  --dark-orange: #e56c00;
  --orange-highlight: #fff1e6;
  --text-dark: #333333;
  --text-light: #ffffff;
  --gray-light: #f5f5f5;
  --gray-medium: #e0e0e0;
  --gray-dark: #888888;
  --success: #2ecc71;
}

/* General Layout */
.dashboard-content {
  padding: 25px;
  background-color: #f8f9fc;
  min-height: 100vh;
}

/* Page Header */
.page-header {
  margin-bottom: 25px;
  padding-bottom: 15px;
  border-bottom: 1px solid var(--gray-medium);
}

.page-title {
  color: var(--primary-orange);
  font-size: 28px;
  font-weight: 600;
  margin-bottom: 10px;
}

/* Breadcrumbs */
.breadcrumb {
  display: flex;
  list-style: none;
  padding: 0;
  margin: 0;
}

.breadcrumb li {
  color: var(--gray-dark);
  font-size: 14px;
}

.breadcrumb li:not(:last-child)::after {
  content: "/";
  margin: 0 8px;
  color: var(--gray-dark);
}

.breadcrumb li:last-child {
  color: var(--dark-orange);
  font-weight: 500;
}

/* Alert Messages */
.alert {
  padding: 12px 20px;
  border-radius: 5px;
  margin-bottom: 20px;
  border-left: 4px solid transparent;
}

.alert-success {
  background-color: rgba(46, 204, 113, 0.15);
  border-left-color: var(--success);
  color: #1e8449;
}

/* Card Styling */
.card {
  background-color: #ffffff;
  border-radius: 8px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
  margin-bottom: 25px;
  overflow: hidden;
}

.card-header {
  background-color: #ffffff;
  padding: 20px;
  border-bottom: 1px solid var(--gray-medium);
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.card-header h3 {
  color: var(--text-dark);
  margin: 0;
  font-size: 18px;
  font-weight: 600;
}

.card-body {
  padding: 20px;
}

/* Buttons */
.btn {
  display: inline-flex;
  align-items: center;
  font-weight: 500;
  text-align: center;
  white-space: nowrap;
  vertical-align: middle;
  cursor: pointer;
  padding: 8px 16px;
  font-size: 14px;
  line-height: 1.5;
  border-radius: 4px;
  transition: all 0.2s ease;
  text-decoration: none;
}

.btn i {
  margin-right: 6px;
}

.btn-primary {
  background-color: var(--primary-orange);
  border: 1px solid var(--primary-orange);
  color: var(--text-light);
}

.btn-primary:hover {
  background-color: var(--dark-orange);
  border-color: var(--dark-orange);
}

.btn-info {
  background-color: #3498db;
  border: 1px solid #3498db;
  color: var(--text-light);
}

.btn-info:hover {
  background-color: #2980b9;
  border-color: #2980b9;
}

.btn-danger {
  background-color: #e74c3c;
  border: 1px solid #e74c3c;
  color: var(--text-light);
}

.btn-danger:hover {
  background-color: #c0392b;
  border-color: #c0392b;
}

.btn-sm {
  padding: 5px 10px;
  font-size: 13px;
}

/* Table Styling */
.table-responsive {
  overflow-x: auto;
}

.table {
  width: 100%;
  margin-bottom: 1rem;
  color: var(--text-dark);
  border-collapse: collapse;
}

.table th {
  padding: 14px 12px;
  vertical-align: middle;
  background-color: var(--orange-highlight);
  color: var(--dark-orange);
  font-weight: 600;
  text-align: left;
  border-bottom: 2px solid var(--light-orange);
}

.table td {
  padding: 14px 12px;
  vertical-align: middle;
  border-bottom: 1px solid var(--gray-medium);
}

.table tr:hover {
  background-color: rgba(255, 122, 0, 0.03);
}

.table img {
  border-radius: 4px;
  object-fit: cover;
  box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
}

/* Action Buttons Group */
.action-buttons {
  display: flex;
  gap: 5px;
}

.action-buttons .btn {
  padding: 6px 8px;
}

.action-buttons i {
  margin-right: 0;
}

/* Empty State */
.text-center {
  text-align: center;
}

/* Pagination */
.pagination-links {
  margin-top: 20px;
}

.pagination-links ul {
  display: flex;
  list-style: none;
  padding: 0;
  margin: 0;
  justify-content: center;
  gap: 5px;
}

.pagination-links li {
  margin: 0;
}

.pagination-links a,
.pagination-links span {
  display: flex;
  align-items: center;
  justify-content: center;
  min-width: 32px;
  height: 32px;
  padding: 0 10px;
  font-size: 14px;
  border-radius: 4px;
  text-decoration: none;
  transition: all 0.2s ease;
}

.pagination-links a {
  background-color: #ffffff;
  color: var(--text-dark);
  border: 1px solid var(--gray-medium);
}

.pagination-links a:hover {
  background-color: var(--orange-highlight);
  color: var(--dark-orange);
  border-color: var(--light-orange);
}

.pagination-links span.current {
  background-color: var(--primary-orange);
  color: var(--text-light);
  border: 1px solid var(--primary-orange);
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .card-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }
  
  .action-buttons {
    flex-wrap: wrap;
  }
  
  .table th, .table td {
    padding: 10px 8px;
    font-size: 13px;
  }
}
</style>
    <div class="dashboard-content">
        <div class="page-header">
            <h1 class="page-title">Products</h1>
            <ul class="breadcrumb">
                <li>Home</li>
                <li>Products</li>
            </ul>
        </div>

        @if (session('success'))
            <div class="alert alert-primary">
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
                                            <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-primary"
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
                                                <button type="submit" class="btn btn-sm btn-primary" title="Delete"
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
