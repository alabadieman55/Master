@extends('layouts.admin')

@section('content')
<style>
    /* Orange Theme Order Management Styles */
.container {
    max-width: 1200px;
    margin: 2rem auto;
    padding: 0 15px;
}

.card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(255, 107, 0, 0.08);
    border-top: 3px solid #ff6b00;
}

.card-body {
    padding: 2rem;
    background-color: #fff9f2;
}

.table-responsive {
    overflow-x: auto;
}

table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
}

thead th {
    background: linear-gradient(135deg, #ff6b00, #ff8c00);
    color: white;
    font-weight: 500;
    padding: 1rem;
    vertical-align: middle;
    border: none;
}

tbody tr {
    transition: all 0.2s ease;
    background-color: white;
}

tbody tr:hover {
    background-color: #fff3e6;
    transform: translateY(-1px);
    box-shadow: 0 2px 8px rgba(255, 107, 0, 0.1);
}

td {
    padding: 1rem;
    vertical-align: middle;
    border-top: 1px solid #ffe8d6;
}

.badge {
    padding: 0.5em 0.75em;
    font-size: 0.8em;
    font-weight: 600;
    letter-spacing: 0.5px;
    border-radius: 50px;
    text-transform: capitalize;
}

.btn {
    padding: 0.5rem 0.9rem;
    border-radius: 6px;
    font-size: 0.875rem;
    margin-right: 0.5rem;
    transition: all 0.2s;
    border: none;
}

.btn-sm i {
    font-size: 0.875rem;
}

.btn-info {
    background-color: #17a2b8;
    color: white;
}

.btn-info:hover {
    background-color: #138496;
}

.btn-primary {
    background: linear-gradient(135deg, #ff8c00, #ff6b00);
    color: white;
    box-shadow: 0 2px 8px rgba(255, 107, 0, 0.2);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #ff6b00, #ff8c00);
    box-shadow: 0 4px 12px rgba(255, 107, 0, 0.3);
}

.pagination {
    margin-top: 2rem;
    justify-content: center;
}

.page-item.active .page-link {
    background-color: #ff6b00;
    border-color: #ff6b00;
}

.page-link {
    color: #ff6b00;
    border: 1px solid #ffd8b6;
}

.page-link:hover {
    color: #ff4500;
    background-color: #fff3e6;
    border-color: #ffd8b6;
}

/* Status badge colors - Orange Theme */
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

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 1rem;
        background-color: white;
    }

    thead th, td {
        padding: 0.75rem 0.5rem;
    }

    .btn {
        margin-bottom: 0.25rem;
        width: 100%;
    }

    tbody tr:hover {
        transform: none;
        box-shadow: none;
    }
}

/* Animation for better interaction */
@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

.card-body {
    animation: fadeIn 0.4s ease-out;
}
</style>
    <div class="container">
        <h1 class="mb-4">Order Management</h1>

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th>Order ID</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Payment</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->user->name ?? 'Guest' }}</td>
                                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                                    <td>{{ number_format($order->total, 2) }} JOD</td>
                                    <td>
                                        <span
                                            class="badge
                                    @if ($order->status == 'delivered') bg-success
                                    @elseif($order->status == 'canceled') bg-danger
                                    @else bg-primary @endif">
                                            {{ ucfirst($order->status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <span
                                            class="badge
                                    @if ($order->payment_status == 'paid') bg-success
                                    @elseif($order->payment_status == 'failed') bg-danger
                                    @else bg-warning text-dark @endif">
                                            {{ ucfirst($order->payment_status) }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
@endsection
