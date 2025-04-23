@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow">
                <div class="card-header bg-orange text-white">
                    <h4 class="mb-0">Edit Profile</h4>
                </div>
                
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}">
                        @csrf
                        
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" 
                                   value="{{ old('name', $user->name) }}" required>
                        </div>
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" 
                                   value="{{ old('email', $user->email) }}" required>
                        </div>
                        
                        <hr class="my-4">
                        
                        <h5 class="mb-3">Change Password</h5>
                        
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input type="password" class="form-control" id="current_password" name="current_password">
                        </div>
                        
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="new_password">
                        </div>
                        
                        <div class="mb-4">
                            <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                            <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation">
                        </div>
                        
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('profile.index') }}" class="btn btn-outline-orange">
                                <i class="fas fa-times"></i> Cancel
                            </a>
                            <button type="submit" class="btn btn-orange">
                                <i class="fas fa-save"></i> Save Changes
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
/* Orange Color Scheme */
.bg-orange {
    background-color: #ff8c00 !important;
}

.btn-orange {
    background-color: #ff8c00;
    color: white;
    border: none;
}

.btn-orange:hover {
    background-color: #ff7300;
    color: white;
}

.btn-outline-orange {
    color: #ff8c00;
    border-color: #ff8c00;
    background-color: transparent;
}

.btn-outline-orange:hover {
    background-color: #fff5e9;
    color: #ff7300;
    border-color: #ff7300;
}

.form-control:focus {
    border-color: #ffb255;
    box-shadow: 0 0 0 0.25rem rgba(255, 140, 0, 0.25);
}

.form-label {
    color: #714a1b;
    font-weight: 500;
}

h5 {
    color: #ff8c00;
}

hr {
    border-color: #ffddb3;
}
</style>
@endsection