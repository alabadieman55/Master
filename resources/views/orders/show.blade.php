@extends('layouts.admin')

@section('content')
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
