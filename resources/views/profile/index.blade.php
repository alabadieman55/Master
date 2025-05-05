@extends('layouts.admin')

@section('content')
    <div class="admin-profile-container">
        <div class="profile-card">
            <div class="profile-header">
                <h4>My Profile</h4>
            </div>

            <div class="profile-body">
                <div class="profile-section">
                    <div class="profile-avatar">
                        <div class="avatar-circle">
                            <i class="fas fa-user-circle"></i>
                        </div>
                        <h5>{{ Auth::user()->name }}</h5>
                        <span class="profile-badge {{ Auth::user()->Utype == 'ADM' ? 'admin-badge' : 'user-badge' }}">
                            {{ Auth::user()->Utype == 'ADM' ? 'Admin' : 'User' }}
                        </span>
                    </div>

                    <div class="profile-details">
                        <div class="info-row">
                            <div class="info-label">Name:</div>
                            <div class="info-value">{{ $user->name }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Email:</div>
                            <div class="info-value">{{ $user->email }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Member Since:</div>
                            <div class="info-value">{{ $user->created_at->format('M d, Y') }}</div>
                        </div>

                        <div class="info-row">
                            <div class="info-label">Last Login:</div>
                            <div class="info-value">
                                {{ $user->last_login ? $user->last_login->format('M d, Y H:i') : 'Never' }}</div>
                        </div>
                    </div>
                </div>

                <div class="activity-section">
                    <h5>Recent Activity</h5>
                    <div class="activity-card">
                        <div class="activity-icon login-icon">
                            <i class="fas fa-sign-in-alt"></i>
                        </div>
                        <div class="activity-details">
                            <p class="activity-title">Last Login</p>
                            <p class="activity-time">{{ now()->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <div class="profile-actions">
                    <a href="{{ route('home') }}" class="btn back-btn">
                        <i class="fas fa-arrow-left"></i> Back to Dashboard
                    </a>
                    <a href="{{ route('profile.edit') }}" class="btn edit-btn">
                        <i class="fas fa-edit"></i> Edit Profile
                    </a>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Admin Profile Styling with Orange Color Scheme */
        .admin-profile-container {
            padding: 2rem;
            background-color: #f9f7f5;
            min-height: calc(100vh - 60px);
        }

        .profile-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            max-width: 900px;
            margin: 0 auto;
        }

        .profile-header {
            background-color: #ff8c00;
            /* Changed to orange */
            color: white;
            padding: 1.2rem 1.5rem;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .profile-header h4 {
            margin: 0;
            font-size: 1.25rem;
            font-weight: 600;
        }

        .profile-body {
            padding: 1.5rem;
        }

        .profile-section {
            display: flex;
            margin-bottom: 2rem;
            gap: 2rem;
        }

        @media (max-width: 768px) {
            .profile-section {
                flex-direction: column;
                align-items: center;
            }
        }

        .profile-avatar {
            text-align: center;
            padding: 1rem;
            flex: 0 0 200px;
        }

        .avatar-circle {
            width: 120px;
            height: 120px;
            background-color: #fef7ef;
            /* Lighter orange background */
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
        }

        .avatar-circle i {
            font-size: 3.5rem;
            color: #ff8c00;
            /* Orange icon */
        }

        .profile-badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            margin-top: 0.5rem;
        }

        .admin-badge {
            background-color: #ff4500;
            /* Darker orange for admin */
            color: white;
        }

        .user-badge {
            background-color: #ff8c00;
            /* Orange for user */
            color: white;
        }

        .profile-details {
            flex: 1;
        }

        .info-row {
            display: flex;
            padding: 0.75rem 0;
            border-bottom: 1px solid #f9eee0;
            /* Light orange border */
        }

        .info-label {
            flex: 0 0 140px;
            font-weight: 600;
            color: #714a1b;
            /* Dark orange-brown text */
        }

        .info-value {
            flex: 1;
            color: #2d3748;
        }

        .activity-section {
            margin-bottom: 2rem;
        }

        .activity-section h5 {
            margin-bottom: 1rem;
            color: #714a1b;
            /* Dark orange-brown text */
            font-weight: 600;
        }

        .activity-card {
            display: flex;
            align-items: center;
            padding: 1rem;
            background-color: #fef7ef;
            /* Light orange background */
            border-radius: 8px;
            margin-bottom: 0.75rem;
        }

        .activity-icon {
            flex: 0 0 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            color: white;
        }

        .login-icon {
            background-color: #ff8c00;
            /* Orange icon background */
        }

        .activity-details {
            flex: 1;
        }

        .activity-title {
            margin: 0 0 0.25rem;
            font-weight: 500;
            color: #2d3748;
        }

        .activity-time {
            margin: 0;
            font-size: 0.875rem;
            color: #976834;
            /* Medium orange-brown text */
        }

        .profile-actions {
            display: flex;
            justify-content: space-between;
            margin-top: 1rem;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-weight: 500;
            transition: all 0.2s;
            cursor: pointer;
            text-decoration: none;
        }

        .btn i {
            margin-right: 0.5rem;
        }

        .back-btn {
            background-color: #fef7ef;
            /* Light orange background */
            color: #976834;
            /* Medium orange-brown text */
            border: 1px solid #ffddb3;
            /* Light orange border */
        }

        .back-btn:hover {
            background-color: #ffecd7;
            /* Slightly darker orange on hover */
        }

        .edit-btn {
            background-color: #ff8c00;
            /* Orange button */
            color: white;
            border: none;
        }

        .edit-btn:hover {
            background-color: #ff7300;
            /* Darker orange on hover */
        }
    </style>
@endsection
