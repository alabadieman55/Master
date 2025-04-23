@extends('layouts.app')
<style>



    /* Orange Theme CSS for Product Form */

/* Global Variables */
:root {
  --orange-primary: #FF7A00;
  --orange-light: #FFB266;
  --orange-dark: #CC6100;
  --orange-pale: #FFF0E5;
  --text-dark: #333333;
  --text-light: #FFFFFF;
  --border-color: #E0E0E0;
  --success-color: #28a745;
  --error-color: #dc3545;
  --bg-light: #F9F9F9;
}

/* Main Layout Styling */
.dashboard-content {
  background-color: var(--bg-light);
  padding: 20px;
}

.card {
  border-radius: 8px;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
  border: none;
  margin-bottom: 25px;
  overflow: hidden;
}

.card-header {
  background-color: var(--orange-primary);
  color: var(--text-light);
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 15px 20px;
  border-bottom: none;
}

.card-header h3 {
  margin: 0;
  font-weight: 600;
}

.card-body {
  padding: 25px;
  background-color: #FFFFFF;
}

/* Page Header */
.page-header {
  margin-bottom: 25px;
}

.page-title {
  color: var(--orange-dark);
  font-weight: 700;
  margin-bottom: 10px;
}

/* Breadcrumb */
.breadcrumb {
  background-color: transparent;
  padding: 0;
  margin-bottom: 0;
  display: flex;
  list-style: none;
}

.breadcrumb li {
  display: inline-block;
  font-size: 14px;
  color: var(--text-dark);
}

.breadcrumb li:not(:last-child)::after {
  content: "/";
  margin: 0 8px;
  color: #999;
}

.breadcrumb li:last-child {
  color: var(--orange-primary);
  font-weight: 500;
}

/* Form Elements */
.form-label {
  font-weight: 500;
  color: var(--text-dark);
  margin-bottom: 5px;
}

.form-control {
  border: 1px solid var(--border-color);
  border-radius: 5px;
  padding: 10px 12px;
  font-size: 15px;
  transition: all 0.3s ease;
}

.form-control:focus {
  border-color: var(--orange-primary);
  box-shadow: 0 0 0 3px rgba(255, 122, 0, 0.15);
}

textarea.form-control {
  min-height: 150px;
}

.input-group-text {
  background-color: var(--orange-light);
  color: var(--text-light);
  border: 1px solid var(--orange-light);
}

.text-danger {
  color: var(--error-color) !important;
}

.text-muted {
  font-size: 13px;
  margin-top: 5px;
}

/* Select Styling */
select.form-control {
  cursor: pointer;
  appearance: none;
  -webkit-appearance: none;
  -moz-appearance: none;
  background-image: url("data:image/svg+xml;charset=UTF-8,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%23FF7A00' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3e%3cpolyline points='6 9 12 15 18 9'%3e%3c/polyline%3e%3c/svg%3e");
  background-repeat: no-repeat;
  background-position: right 10px center;
  background-size: 16px;
  padding-right: 30px;
}

/* Validation Styling */
.is-invalid {
  border-color: var(--error-color);
}

.invalid-feedback {
  color: var(--error-color);
  font-size: 13px;
  margin-top: 5px;
}

/* Checkbox Styling */
.form-check-input {
  cursor: pointer;
}

.form-check-input:checked {
  background-color: var(--orange-primary);
  border-color: var(--orange-primary);
}

.form-check-label {
  cursor: pointer;
  user-select: none;
}

/* File Upload Styling */
input[type="file"].form-control {
  padding: 8px;
}

/* Button Styling */
.btn {
  font-weight: 500;
  padding: 10px 20px;
  border-radius: 6px;
  display: inline-flex;
  align-items: center;
  transition: all 0.2s ease;
}

.btn i {
  margin-right: 8px;
}

.btn-primary {
  background-color: var(--orange-primary);
  border-color: var(--orange-primary);
  color: var(--text-light);
}

.btn-primary:hover, .btn-primary:focus {
  background-color: var(--orange-dark);
  border-color: var(--orange-dark);
  box-shadow: 0 4px 10px rgba(255, 122, 0, 0.25);
}

.btn-secondary {
  background-color: transparent;
  border-color: var(--orange-primary);
  color: var(--orange-primary);
}

.btn-secondary:hover, .btn-secondary:focus {
  background-color: var(--orange-pale);
  color: var(--orange-dark);
}

/* Section Separators */
.row + .row {
  margin-top: 15px;
}

.mt-4 {
  margin-top: 20px !important;
}

/* Editor Styling (for WYSIWYG) */
.ck-editor__editable {
  min-height: 200px !important;
}

.ck.ck-editor__editable:focus {
  border-color: var(--orange-primary) !important;
}

.ck.ck-toolbar {
  border-color: var(--border-color) !important;
}

.ck.ck-button.ck-on {
  background-color: var(--orange-pale) !important;
  color: var(--orange-dark) !important;
}

/* Responsive Adjustments */
@media (max-width: 768px) {
  .card-header {
    flex-direction: column;
    align-items: flex-start;
  }
  
  .card-header a {
    margin-top: 15px;
  }
  
  .row {
    margin-left: -10px;
    margin-right: -10px;
  }
  
  .col-md-4, .col-md-6, .col-md-8 {
    padding-left: 10px;
    padding-right: 10px;
  }
}
</style>
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
                <a href="{{ route('products.index') }}" class="btn btn-">
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
                        <button type="submit" class="btn btn primary">
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
