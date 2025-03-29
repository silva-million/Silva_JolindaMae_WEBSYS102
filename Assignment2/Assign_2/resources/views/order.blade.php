@extends('master')

@section('title', 'Order View')

@section('content')
    <h2>Order</h2>
    <form>
        <div class="form-group">
            <label for="customerId">Customer ID:</label>
            <input type="text" class="form-control" id="customerId" value="{{ $customerId ?? '' }}" readonly />
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" value="{{ $name ?? '' }}" readonly />
        </div>

        <div class="form-group">
            <label for="orderNo">Order No:</label>
            <input type="text" class="form-control" id="orderNo" value="{{ $orderNo ?? '' }}" readonly />
        </div>

        <div class="form-group">
            <label for="date">Date:</label>
            <input type="text" class="form-control" id="date" value="{{ $date ?? '' }}" readonly />
        </div>
    </form>
@endsection