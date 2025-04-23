@extends('layouts.app')
<style>
    /* Orange Theme for Category Details */

/* Custom Variables */
:root {
  --orange-primary: #ff7700;
  --orange-secondary: #ff9e44;
  --orange-light: #fff0e6;
  --orange-dark: #cc5500;
  --orange-hover: #e66c00;
  --text-dark: #333333;
  --text-light: #ffffff;
  --gray-light: #f8f9fa;
  --border-color: #eeeeee;
}

/* Container Styling */
.container {
  padding-top: 30px;
  padding-bottom: 30px;
}

/* Card Styling */
.card {
  border: none;
  border-radius: 10px;
  box-shadow: 0 5px 15px rgba(255, 119, 0, 0.1);
  overflow: hidden;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card:hover {
  transform: translateY(-5px);
  box-shadow: 0 8px 20px rgba(255, 119, 0, 0.15);
}

.card-header {
  background: linear-gradient(135deg, var(--orange-primary), var(--orange-dark));
  color: var(--text-light);
  border: none;
  padding: 16px 20px;
}

.card-header h3 {
  margin: 0;
  font-weight: 600;
  font-size: 20px;
}

.card-body {
  padding: 25px;
}

/* Image Styling */
.img-fluid {
  border-radius: 6px;
  width: 100%;
  box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
}

.bg-light {
  background-color: var(--gray-light) !important;
  border-radius: 6px;
  color: #888;
  font-weight: 500;
  box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.05);
}

/* Typography */
h4 {
  color: var(--orange-dark);
  font-weight: 600;
  margin-bottom: 15px;
  border-bottom: 2px solid var(--orange-light);
  padding-bottom: 10px;
}

p {
  color: var(--text-dark);
  margin-bottom: 10px;
  font-size: 15px;
}

p:last-of-type {
  margin-bottom: 0;
}

/* Button Styling */
.btn {
  padding: 8px 20px;
  border-radius: 5px;
  font-weight: 500;
  transition: all 0.3s ease;
  border: none;
}

.btn-primary {
  background-color: var(--orange-primary);
  border-color: var(--orange-primary);
  color: white;
}

.btn-primary:hover, .btn-primary:focus {
  background-color: var(--orange-hover);
  border-color: var(--orange-hover);
  box-shadow: 0 4px 8px rgba(255, 119, 0, 0.25);
}

.btn-secondary {
  background-color: white;
  border: 2px solid var(--orange-primary);
  color: var(--orange-primary);
}

.btn-secondary:hover, .btn-secondary:focus {
  background-color: var(--orange-light);
  color: var(--orange-dark);
  border-color: var(--orange-dark);
}

.btn-danger {
  background-color: #f44336;
  transition: all 0.3s ease;
}

.btn-danger:hover, .btn-danger:focus {
  background-color: #d32f2f;
  box-shadow: 0 4px 8px rgba(244, 67, 54, 0.25);
}

/* Spacing for buttons */
.d-inline {
  margin-left: 10px;
}

.mt-3 {
  margin-top: 1.5rem !important;
}

/* Media Queries */
@media (max-width: 767px) {
  .col-md-4 {
    margin-bottom: 20px;
  }
  
  .card-header {
    padding: 12px 15px;
  }
  
  .card-body {
    padding: 20px 15px;
  }
  
  h4 {
    text-align: center;
  }
}

/* Additional Details */
.created-updated {
  font-size: 14px;
  color: #6c757d;
  border-left: 3px solid var(--orange-secondary);
  padding-left: 10px;
  margin-top: 15px;
}

/* Slug styling */
p:nth-child(2) {
  background-color: var(--orange-light);
  display: inline-block;
  padding: 3px 10px;
  border-radius: 4px;
  font-family: monospace;
  font-size: 14px;
}
</style>

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Category Details</h3>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                @if ($category->image)
                                    <img src="{{ asset('storage/' . $category->image) }}" alt="{{ $category->name }}"
                                        class="img-fluid">
                                @else
                                    <div class="bg-light p-5 text">No Image</div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $category->name }}</h4>
                                <p>Slug: {{ $category->slug }}</p>
                                <p>Created At: {{ $category->created_at->format('M d, Y H:i') }}</p>
                                <p>Updated At: {{ $category->updated_at->format('M d, Y H:i') }}</p>

                                <div class="mt-3">
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-primary">Edit</a>
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                                        class="d-inline"
                                        onsubmit="return confirm('Are you sure you want to delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn primary">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
