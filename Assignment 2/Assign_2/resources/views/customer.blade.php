
@extends('master')

@section('title', 'Customer View')

@section('content')
    <h2>Customer</h2>
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
            <label for="address">Address:</label>
            <input type="text" class="form-control" id="address" value="{{ $address ?? '' }}" readonly />
        </div>
    </form>
@endsection