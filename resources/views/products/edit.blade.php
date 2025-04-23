@extends('layouts.app')

@section('content')
    <div class="dashboard-content">
        <div class="page-header">
            <h1 class="page-title">Edit Product</h1>
            <ul class="breadcrumb">
                <li>Home</li>
                <li>Products</li>
                <li>Edit</li>
            </ul>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Product Information</h3>
                <a href="{{ route('products.index') }}" class="btn btn-">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Product Name <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror"
                                    id="name" name="name" value="{{ old('name', $product->name) }}" required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="short_description" class="form-label">Short Description <span
                                        class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('short_description') is-invalid @enderror"
                                    id="short_description" name="short_description"
                                    value="{{ old('short_description', $product->short_description) }}" required
                                    maxlength="255">
                                @error('short_description')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="description" class="form-label">Description <span
                                        class="text-danger">*</span></label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                    rows="5" required>{{ old('description', $product->description) }}</textarea>
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
                                            {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
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
                                    <input type="number" step="0.01"
                                        class="form-control @error('regular_price') is-invalid @enderror" id="regular_price"
                                        name="regular_price" value="{{ old('regular_price', $product->regular_price) }}"
                                        required>
                                </div>
                                @error('regular_price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>


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
                                    name="SKU" value="{{ old('SKU', $product->SKU) }}" required maxlength="100">
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
                                                {{ old('stock_status', $product->stock_status) == 'instock' ? 'selected' : '' }}>
                                                In Stock</option>
                                            <option value="outofstock"
                                                {{ old('stock_status', $product->stock_status) == 'outofstock' ? 'selected' : '' }}>
                                                Out of Stock</option>
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
                                            name="quantity" value="{{ old('quantity', $product->quantity) }}" required>
                                        @error('quantity')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="featured" name="featured"
                                        {{ old('featured', $product->featured) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="featured">
                                        Featured Product
                                    </label>
                                </div>
                            </div>

                            <div class="form-group mb-3">
                                <label for="image" class="form-label">Main Image</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror"
                                    id="image" name="image" accept="image/jpeg,image/png,image/jpg,image/gif">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @if ($product->image)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/products/' . $product->image) }}" alt="Current Image"
                                            class="img-thumbnail" style="max-height: 100px;">
                                    </div>
                                @endif
                            </div>

                            <div class="form-group mb-3">
                                <label for="images" class="form-label">Additional Images</label>
                                <input type="file" class="form-control @error('images') is-invalid @enderror"
                                    id="images" name="images[]" multiple
                                    accept="image/jpeg,image/png,image/jpg,image/gif">
                                @error('images')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror

                                @if ($product->images)
                                    <div class="mt-2">
                                        @foreach (json_decode($product->images) as $image)
                                            <div class="d-inline-block position-relative me-2 mb-2">
                                                <img src="{{ asset('storage/products/' . $image) }}"
                                                    alt="Additional Image" class="img-thumbnail"
                                                    style="max-height: 80px;">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm position-absolute top-0 end-0"
                                                    onclick="deleteImage('{{ $image }}')">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            function deleteImage(filename) {
                if (confirm('Are you sure you want to delete this image?')) {
                    fetch('{{ route('products.delete-image', $product) }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Content-Type': 'application/json',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                filename: filename
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                location.reload();
                            }
                        });
                }
            }
        </script>
    @endpush
@endsection
