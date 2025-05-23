@extends('layouts.admin')

@section('content')
<style>




    /* Orange Theme Order Edit Styles */
.container {
    max-width: 1000px;
    margin: 2rem auto;
    padding: 0 15px;
}

.card {
    border: none;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
}

.card-header {
    background: linear-gradient(135deg, #ff8c00, #ff6b00);
    padding: 1.5rem;
    border-bottom: none;
}

.card-header h3 {
    margin: 0;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.card-body {
    padding: 2rem;
    background-color: #fff;
}

h4 {
    color: #ff6b00;
    margin-bottom: 1.5rem;
    padding-bottom: 0.5rem;
    border-bottom: 2px solid #ffe8d6;
    font-weight: 600;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-control {
    border: 1px solid #ddd;
    border-radius: 6px;
    padding: 0.75rem 1rem;
    transition: all 0.3s;
}

.form-control:focus {
    border-color: #ff8c00;
    box-shadow: 0 0 0 0.25rem rgba(255, 140, 0, 0.25);
}

label {
    font-weight: 500;
    color: #555;
    margin-bottom: 0.5rem;
    display: block;
}

textarea.form-control {
    min-height: 120px;
}

.btn {
    padding: 0.75rem 1.5rem;
    border-radius: 6px;
    font-weight: 500;
    letter-spacing: 0.5px;
    transition: all 0.3s;
    border: none;
    margin-right: 1rem;
}

.btn-primary {
    background: linear-gradient(135deg, #ff8c00, #ff6b00);
    box-shadow: 0 2px 10px rgba(255, 107, 0, 0.3);
}

.btn-primary:hover {
    background: linear-gradient(135deg, #ff6b00, #ff8c00);
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(255, 107, 0, 0.4);
}

.btn-secondary {
    background-color: #f8f9fa;
    color: #555;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
}

.btn-secondary:hover {
    background-color: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
}

/* Date input styling */
input[type="date"] {
    padding: 0.75rem 1rem;
    background-color: #fff;
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .card-body {
        padding: 1.5rem;
    }

    .row {
        flex-direction: column;
    }

    .col-md-6 {
        width: 100%;
    }

    .btn {
        width: 100%;
        margin-bottom: 1rem;
    }
}

/* Animation for status change */
@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.02); }
    100% { transform: scale(1); }
}

.card {
    animation: pulse 0.5s ease-in-out;
}
</style>
    <div class="container">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3>Edit Order #{{ $order->id }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4>Order Status</h4>
                            <div class="form-group">
                                <label for="status">Status</label>
                                <select name="status" id="status" class="form-control">
                                    @foreach ($statuses as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ $order->status == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="payment_status">Payment Status</label>
                                <select name="payment_status" id="payment_status" class="form-control">
                                    @foreach ($paymentStatuses as $value => $label)
                                        <option value="{{ $value }}"
                                            {{ $order->payment_status == $value ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <h4>Dates</h4>
                            <div class="form-group">
                                <label for="delivered_date">Delivered Date</label>
                                <input type="date" name="delivered_date" id="delivered_date" class="form-control"
                                    value="{{ $order->delivered_date ? (is_string($order->delivered_date) ? \Carbon\Carbon::parse($order->delivered_date)->format('Y-m-d') : $order->delivered_date->format('Y-m-d')) : '' }}">
                            </div>

                            <div class="form-group">
                                <label for="canceled_date">Canceled Date</label>
                                <input type="date" name="canceled_date" id="canceled_date" class="form-control"
                                    value="{{ $order->canceled_date ? (is_string($order->canceled_date) ? \Carbon\Carbon::parse($order->canceled_date)->format('Y-m-d') : $order->canceled_date->format('Y-m-d')) : '' }}">
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="notes">Admin Notes</label>
                        <textarea name="notes" id="notes" rows="3" class="form-control">{{ $order->notes }}</textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Order
                        </button>
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusSelect = document.getElementById('status');

            statusSelect.addEventListener('change', function() {
                if (this.value === 'delivered') {
                    document.getElementById('delivered_date').valueAsDate = new Date();
                } else if (this.value === 'canceled') {
                    document.getElementById('canceled_date').valueAsDate = new Date();
                }
            });
        });
    </script>
@endsection
