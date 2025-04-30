@extends('layouts.admin')

@section('content')
<style>
    /* Orange Theme Order Details Styles */
.container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 15px;
}

.card {
    border: none;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 6px 30px rgba(255, 107, 0, 0.1);
    border-top: 4px solid #ff6b00;
}

.card-header {
    background: linear-gradient(135deg, #ff6b00, #ff8c00);
    padding: 1.5rem;
    border-bottom: none;
}

.card-header h3 {
    margin: 0;
    font-weight: 700;
    letter-spacing: 0.5px;
    color: white;
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.1);
}

.card-body {
    padding: 2.5rem;
    background-color: #fff;
}

h4 {
    color: #ff6b00;
    margin-bottom: 1.5rem;
    padding-bottom: 0.75rem;
    border-bottom: 2px solid #ffebd8;
    font-weight: 600;
    font-size: 1.25rem;
}

.row {
    margin-bottom: 2rem;
}

p {
    margin-bottom: 0.75rem;
    color: #555;
    line-height: 1.6;
}

strong {
    color: #333;
    font-weight: 600;
    min-width: 120px;
    display: inline-block;
}

/* Badge Styles */
.badge {
    padding: 0.5em 1em;
    font-size: 0.85em;
    font-weight: 600;
    border-radius: 50px;
    text-transform: capitalize;
    letter-spacing: 0.5px;
}

.bg-success {
    background-color: #28a745 !important;
}

.bg-danger {
    background-color: #dc3545 !important;
}

.bg-primary {
    background-color: #ff6b00 !important;
}

.bg-warning {
    background-color: #ffc107 !important;
}

.text-dark {
    color: #212529 !important;
}

/* Table Styles */
.table-responsive {
    border-radius: 8px;
    overflow: hidden;
    box-shadow: 0 2px 15px rgba(0, 0, 0, 0.05);
}

.table {
    margin-bottom: 0;
}

.table thead {
    background-color: #ff6b00;
    color: white;
}

.table th {
    padding: 1rem;
    font-weight: 500;
    border: none;
}

.table td {
    padding: 1.25rem 1rem;
    vertical-align: middle;
    border-top: 1px solid #ffebd8;
}

.table tbody tr:hover {
    background-color: #fff9f2;
}

/* Product Image */
.d-flex img {
    border-radius: 6px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s;
}

.d-flex img:hover {
    transform: scale(1.05);
}

/* Button Styles */
.btn {
    padding: 0.75rem 1.75rem;
    border-radius: 8px;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.3s;
    border: none;
    margin-right: 1rem;
    font-size: 0.95rem;
}

.btn-primary {
    background: linear-gradient(135deg, #ff6b00, #ff8c00);
    box-shadow: 0 4px 15px rgba(255, 107, 0, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #e55f00, #ff6b00);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(255, 107, 0, 0.4);
}

.btn-secondary {
    background-color: #f8f9fa;
    color: #555;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.btn-secondary:hover {
    background-color: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
}

/* Responsive Adjustments */
@media (max-width: 992px) {
    .card-body {
        padding: 1.75rem;
    }
}

@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem;
    }

    .row {
        flex-direction: column;
    }

    .col-md-6 {
        width: 100%;
        margin-bottom: 1.5rem;
    }

    .btn {
        width: 100%;
        margin-bottom: 1rem;
    }

    .table td, .table th {
        padding: 0.75rem;
    }
}

/* Animation */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.card-body > * {
    animation: fadeIn 0.5s ease-out;
}
</style>
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3>Order #{{ $order->id }}</h3>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h4>Customer Information</h4>
                        <p><strong>Name:</strong> {{ $order->name }}</p>
                        <p><strong>Email:</strong> {{ $order->email }}</p>
                        <p><strong>Phone:</strong> {{ $order->phone }}</p>
                    </div>
                    <div class="col-md-6">
                        <h4>Order Details</h4>
                        <p><strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}</p>
                        <p><strong>Status:</strong>
                            <span
                                class="badge
                            @if ($order->status == 'delivered') bg-success
                            @elseif($order->status == 'canceled') bg-danger
                            @else bg-primary @endif">
                                {{ ucfirst($order->status) }}
                            </span>
                        </p>
                        <p><strong>Payment:</strong>
                            <span
                                class="badge
                            @if ($order->payment_status == 'paid') bg-success
                            @elseif($order->payment_status == 'failed') bg-danger
                            @else bg-warning text-dark @endif">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </p>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <h4>Shipping Address</h4>
                        <p>{{ $order->address }}, {{ $order->city }}</p>
                        <p>{{ $order->state }}, {{ $order->zip }}</p>
                        <p>{{ $order->country }}</p>
                    </div>
                    <div class="col-md-6">
                        <h4>Billing Information</h4>
                        <p><strong>Subtotal:</strong> {{ number_format($order->subtotal, 2) }} JOD</p>
                        <p><strong>Tax:</strong> {{ number_format($order->tax, 2) }} JOD</p>
                        <p><strong>Total:</strong> {{ number_format($order->total, 2) }} JOD</p>
                        <p><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                    </div>
                </div>

                <h4>Order Items</h4>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $item)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ asset('storage/products/' . $item->image) }}" alt="{{ $item->name }}"
                                                width="50" class="me-3">

                                        </div>
                                    </td>
                                    <td>{{ number_format($item->price, 2) }} JOD</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ number_format($item->price * $item->quantity, 2) }} JOD</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-4">
                    <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-primary">
                        <i class="fas fa-edit"></i> Update Order
                    </a>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">
                        <i class="fas fa-arrow-left"></i> Back to Orders
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
