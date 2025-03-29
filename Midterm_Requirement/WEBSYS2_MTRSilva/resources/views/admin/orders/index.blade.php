@extends('layout.admin')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4" style="color: #6B705C;">Order Management</h2>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        {{-- Active Orders --}}
        <h4 class="mt-4 mb-3">📦 Active Orders</h4>
        <div class="table-responsive mb-5">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>Order ID</th>
                        <th>Customer Name</th>
                        <th>Total Price (₱)</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th style="width: 150px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $activeOrders = $orders->whereIn('status', ['pending', 'processing']);
                    @endphp

                    @forelse($activeOrders as $order)
                        <tr>
                            <td class="fw-semibold">{{ $order->id }}</td>
                            <td>{{ $order->customer_name }}</td>
                            <td class="text-center">₱{{ number_format($order->total_price, 2) }}</td>
                            <td class="text-center">{{ ucfirst($order->status) }}</td>
                            <td class="text-center">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                            <td class="text-center">
                                <button type="button" class="btn btn-sm btn-info mb-1" data-bs-toggle="modal" data-bs-target="#orderDetailsModal{{ $order->id }}">
                                    View Details
                                </button>

                                <form action="/admin/orders/update/{{ $order->id }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT') <!-- Use POST method for the route -->
                                    <select name="status" class="form-select" onchange="this.form.submit()">
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                                        <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                        <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted">No active orders yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Completed Orders --}}
<h4 class="mb-3">✔ Completed Orders</h4>
<div class="table-responsive">
    <table class="table table-bordered table-hover align-middle">
        <thead class="table-light text-center">
            <tr>
                <th>Order ID</th>
                <th>Customer Name</th>
                <th>Total Price (₱)</th>
                <th>Status</th>
                <th>Created At</th>
                <th style="width: 150px;">Actions</th>
            </tr>
        </thead>
        <tbody>
            @php
                // Include both 'completed' and 'received' orders in the completed orders list
                $completedOrders = $orders->whereIn('status', ['completed', 'received']);
            @endphp

            @forelse($completedOrders as $order)
                <tr>
                    <td class="fw-semibold">{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td class="text-center">₱{{ number_format($order->total_price, 2) }}</td>
                    <td class="text-center">{{ ucfirst($order->status) }}</td>
                    <td class="text-center">{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-sm btn-info mb-1" data-bs-toggle="modal"
                            data-bs-target="#orderDetailsModal{{ $order->id }}">
                            View Details
                        </button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">No completed orders yet.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>


    {{-- Order Details Modals --}}
    @foreach ($orders as $order)
        <div class="modal fade" id="orderDetailsModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="orderDetailsModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="orderDetailsModalLabel{{ $order->id }}">Order Details - Order
                            #{{ $order->id }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h5>Customer: {{ $order->customer_name }}</h5>
                        <p><strong>Total Price: </strong>₱{{ number_format($order->total_price, 2) }}</p>
                        <p><strong>Status: </strong>{{ ucfirst($order->status) }}</p>
                        <p><strong>Created At: </strong>{{ \Carbon\Carbon::parse($order->created_at)->format('M d, Y') }}
                        </p>

                        <h6 class="mt-4">Order Items:</h6>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Quantity</th>
                                    <th>Price (₱)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($order->orderItems as $item)
                                    <tr>
                                        <td>{{ $item->product_name }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td>₱{{ number_format($item->price, 2) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
