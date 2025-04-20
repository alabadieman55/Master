@extends('layouts.app')

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
                                    <div class="bg-light p-5 text-center">No Image</div>
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
                                        <button type="submit" class="btn btn-danger">Delete</button>
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
