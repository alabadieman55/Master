@extends('layouts.app')

@section('content')
    <div class="dashboard-content">
        <div class="page-header">
            <h1 class="page-title">Add New Product</h1>
            <ul class="breadcrumb">
                <li>Home</li>
                <li>Products</li>
                <li>Add New</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Product Information</h3>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Product Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="short_description" class="form-label">Short Description <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('short_description') is-invalid @enderror"
                                    id="short_description" name="short_description" value="{{ old('short_description') }}"
                                    required>
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="5" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group mb-3">
                                <label for="category_id" class="form-label">Category <span
                                        class="text-danger">*</span></label>
                                <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                                    name="category_id" required>
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="regular_price" class="form-label">Regular Price <span
                                        class="text-danger">*</span></label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control @error('regular_price') is-invalid @enderror" id="regular_price"
                                        name="regular_price" value="{{ old('regular_price') }}" required>
                                </div>
                                @error('regular_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Discount Field Added Here -->
                            <div class="form-group mb-3">
                                <label for="discount" class="form-label">Discount Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" step="0.01" min="0"
                                        class="form-control @error('discount') is-invalid @enderror" id="discount"
                                        name="discount" value="{{ old('discount') }}">
                                </div>
                                <small class="text-muted">Leave empty for no discount</small>
                                @error('discount')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="SKU" class="form-label">SKU <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('SKU') is-invalid @enderror" id="SKU"
                                    name="SKU" value="{{ old('SKU') }}" required>
                                @error('SKU')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="stock_status" class="form-label">Stock Status <span
                                                class="text-danger">*</span></label>
                                        <select class="form-control @error('stock_status') is-invalid @enderror"
                                            id="stock_status" name="stock_status" required>
                                            <option value="instock"
                                                {{ old('stock_status') == 'instock' ? 'selected' : '' }}>In Stock</option>
                                            <option value="outofstock"
                                                {{ old('stock_status') == 'outofstock' ? 'selected' : '' }}>Out of Stock
                                            </option>
                                        </select>
                                        @error('stock_status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group mb-3">
                                        <label for="quantity" class="form-label">Quantity <span
                                                class="text-danger">*</span></label>
                                        <input type="number" min="0"
                                            class="form-control @error('quantity') is-invalid @enderror" id="quantity"
                                            name="quantity" value="{{ old('quantity', 1) }}" required>
                                        @error('quantity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="featured" name="featured"
                                        {{ old('featured') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">
                                        Featured Product
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="image" class="form-label">Main Image <span
                                        class="text-danger">*</span></label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image" required>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="images" class="form-label">Additional Images</label>
                                <input type="file" class="form-control @error('images.*') is-invalid @enderror"
                                    id="images" name="images[]" multiple>
                                @error('images.*')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">You can select multiple images at once.</small>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Add WYSIWYG editor for description field
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof ClassicEditor !== 'undefined') {
                ClassicEditor
                    .create(document.querySelector('#description'))
                    .catch(error => {
                        console.error(error);
                    });
            }

            // Optional: Calculate discount percentage automatically
            const regularPrice = document.getElementById('regular_price');
            const discount = document.getElementById('discount');

            if (regularPrice && discount) {
                regularPrice.addEventListener('input', updateDiscountPercentage);
                discount.addEventListener('input', updateDiscountPercentage);
            }

            function updateDiscountPercentage() {
                const price = parseFloat(regularPrice.value);
                const discountValue = parseFloat(discount.value);

                if (price > 0 && discountValue > 0) {
                    const percentage = (discountValue / price) * 100;
                    // You could display this percentage somewhere if needed
                    console.log(`Discount percentage: ${percentage.toFixed(2)}%`);
                }
            }
        });
    </script>
@endpush
