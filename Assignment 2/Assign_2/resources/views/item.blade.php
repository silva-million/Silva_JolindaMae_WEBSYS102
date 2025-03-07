@extends('master')

@section('title', 'Item View')

@section('content')
    <h2>Item</h2><br>
    <form>
        <div class="form-group">
            <label for="itemNo">Item No: </label>
            <input type="text" class="form-control" id="itemNo" value="{{ $itemNo ?? '' }}" readonly >
        </div>

        <div>
            <label for="name">Name: </label>
            <input type="text" class="form-control" id="name" value="{{ $name ?? '' }}" readonly >
        </div>
        <br>
        <div>   
            <label for="price">Price: </label>
            <input type="text" class="form-control" id="price" value="{{ $price ?? '' }}" readonly >
        </div>
        
        
    </form>
@endsection