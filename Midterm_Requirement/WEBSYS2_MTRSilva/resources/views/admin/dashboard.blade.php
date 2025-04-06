@extends('layout.admin')

@section('content')
<div class="container admin-section">
    <h2 class="mb-4">Welcome, {{ $name }} 🐾</h2>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card dashboard-card h-100 p-4 d-flex flex-column">
                <h5>Manage Products</h5>
                <p class="flex-grow-1">Add, update, or delete items for dogs and cats.</p>
                <a href="{{ url('/admin/products') }}" class="btn btn-primary mt-auto">Go to Products</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card dashboard-card h-100 p-4 d-flex flex-column">
                <h5>View Orders</h5>
                <p class="flex-grow-1">Check customer orders and update statuses.</p>
                <a href="{{ url('/admin/orders') }}" class="btn btn-primary mt-auto">View Orders</a>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card dashboard-card h-100 p-4 d-flex flex-column">
                <h5>Customer Reviews</h5>
                <p class="flex-grow-1">See what your pet-loving customers are saying.</p>
                <a href="{{ route('admin.reviews') }}" class="btn btn-primary mt-auto">Manage Reviews</a>
            </div>
        </div>
    </div>
</div>
@endsection
