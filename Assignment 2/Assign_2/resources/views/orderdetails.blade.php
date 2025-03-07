@extends('master')

@section('title', 'Order Details View')
@section('content')
    <h2>Order Details</h2>
    <form>
        <div class="form-group">
            <label for="transNo">Trans No:</label>
            <input type="text" class="form-control" id="transNo" value="{{ $transNo ?? '' }}" readonly />
        </div>

        <div class="form-group">
            <label for="orderNo">Order No:</label>
            <input type="text" class="form-control" id="orderNo" value="{{ $orderNo ?? '' }}" readonly />
        </div>

        <div class="form-group">
            <label for="itemId">Item ID:</label>
            <input type="text" class="form-control" id="itemId" value="{{ $itemId ?? '' }}" readonly />
        </div>

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name" value="{{ $name ?? '' }}" readonly />
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" id="price" value="{{ $price ?? '' }}" readonly />
        </div>

        <div class="form-group">
            <label for="qty">Qty:</label>
            <input type="text" class="form-control" id="qty" value="{{ $qty ?? '' }}" readonly />
        </div>
    </form>
@endsection