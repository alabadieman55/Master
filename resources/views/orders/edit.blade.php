@extends('layouts.admin')

@section('content')
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
                                    value="{{ $order->delivered_date ? $order->delivered_date->format('Y-m-d') : '' }}">
                            </div>

                            <div class="form-group">
                                <label for="canceled_date">Canceled Date</label>
                                <input type="date" name="canceled_date" id="canceled_date" class="form-control"
                                    value="{{ $order->canceled_date ? $order->canceled_date->format('Y-m-d') : '' }}">
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
