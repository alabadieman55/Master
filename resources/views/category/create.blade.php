@extends('layouts.app')

@section('content')
    <style>
        /* Orange Theme CSS for Category Form */
        :root {
            --orange-primary: #ff7700;
            --orange-secondary: #ff9e44;
            --orange-light: #fff0e6;
            --orange-dark: #cc5500;
            --text-dark: #333333;
            --text-light: #ffffff;
        }

        /* Card Styling */
        .card {
            border: none;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(255, 119, 0, 0.1);
            overflow: hidden;
            margin-top: 30px;
        }

        .card-header {
            background-color: var(--orange-primary);
            color: var(--text-light);
            padding: 15px 20px;
        }

        .card-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 20px;
        }

        .card-body {
            padding: 25px;
            background-color: #ffffff;
        }

        /* Button Styling */
        .btn-primary {
            background-color: var(--orange-primary);
            border-color: var(--orange-primary);
            color: white;
            padding: 10px 20px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--orange-dark);
            border-color: var(--orange-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(255, 119, 0, 0.2);
        }

        .btn-secondary {
            background-color: white;
            border: 2px solid var(--orange-primary);
            color: var(--orange-primary);
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover, .btn-secondary:focus {
            background-color: var(--orange-light);
            color: var(--orange-dark);
            transform: translateY(-2px);
        }

        /* Form Controls */
        .form-control {
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            padding: 12px;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--orange-secondary);
            box-shadow: 0 0 0 0.2rem rgba(255, 119, 0, 0.25);
        }

        .form-group label {
            color: var(--text-dark);
            font-weight: 500;
            margin-bottom: 8px;
            display: block;
            font-size: 15px;
        }

        /* Alert Styling */
        .alert-danger {
            background-color: #fff0e6;
            border-color: #ffdac2;
            color: #cc5500;
            border-radius: 6px;
        }

        .alert-danger ul {
            padding-left: 20px;
            margin-bottom: 0;
        }

        /* File Input Customization */
        input[type="file"] {
            padding: 8px;
        }

        /* Animation for Form Submission */
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        button[type="submit"]:active {
            animation: pulse 0.3s ease-in-out;
        }

        /* Container Background */
        .container {
            background-color: #fafafa;
            padding-bottom: 40px;
            padding-top: 20px;
        }

        /* Responsive Adjustments */
        @media (max-width: 768px) {
            .card-header {
                padding: 12px 15px;
            }
            
            .card-header h3 {
                font-size: 18px;
            }
            
            .card-body {
                padding: 20px 15px;
            }
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h3>Create Category</h3>
                            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Back to List</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('categories.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group mb-3">
                                <label for="name">Name:</label>
                                <input type="text" name="name" id="name" class="form-control"
                                    value="{{ old('name') }}" required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="image">Image:</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Create Category</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection