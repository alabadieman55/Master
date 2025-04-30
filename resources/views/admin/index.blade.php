@extends('layouts.admin')

@section('content')
    <div class="page-header">
        <h1 class="page-title">Dashboard</h1>
        <ul class="breadcrumb">
            <li>Home</li>
            <li>Dashboard</li>
        </ul>
    </div>

    <div class="stats-cards">
        <div class="card stat-card">
            <div class="stat-icon bg-primary">
                <i class="fas fa-shopping-bag"></i>
            </div>
            <div class="stat-details">
                <h3>{{ $orders }}</h3>
                <p>Total Orders</p>
            </div>
        </div>

        <div class="card stat-card">
            <div class="stat-icon bg-success">
                <i class="fas fa-dollar-sign"></i>
            </div>
            <div class="stat-details">
                <h3>${{ $revenue }}</h3>
                <p>Total Revenue</p>
            </div>
        </div>

        <div class="card stat-card">
            <div class="stat-icon bg-warning">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-details">
                <h3>{{ $users }}</h3>
                <p>Total Customers</p>
            </div>
        </div>

        <div class="card stat-card">
            <div class="stat-icon bg-info">
                <i class="fas fa-tshirt"></i>
            </div>
            <div class="stat-details">
                <h3>{{ $products }}</h3>
                <p>Total Products</p>
            </div>
        </div>
    </div>

    <div class="dashboard-row">
        <div class="card recent-orders">
            <div class="card-header">
                <h3>Recent Orders</h3>
                <a href="{{ route('admin.orders.index') }}" class="card-header-action">View All</a>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer</th>
                        <th>Date</th>
                        <th>Amount</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($ordersMain as $orderMain)
                        <tr>
                            <td>#ORD-{{ $orderMain->id }}</td>
                            <td>{{ $orderMain->name }}</td>
                            <td>{{ $orderMain->created_at->format('M d, Y') }}</td>
                            <td>${{ number_format($orderMain->total, 2) }}</td>
                            <td>
                                <span class="status status-{{ strtolower($orderMain->status) }}">
                                    {{ $orderMain->status }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="card">
            <div class="card-header">
                <h3>Top Selling Products</h3>
            </div>
            <div class="top-products">
                <!-- Your top products content here -->
            </div>
        </div>
    </div>
@endsection
