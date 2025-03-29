@extends('layout.user')

@section('content')
<div class="container-fluid">
    <div class="row align-items-center" style="min-height: 80vh;">
        <!-- Left Section: Text and Button -->
        <div class="col-md-6 ps-5">
            <h1 class="display-4 fw-bold" style="color: #333;">
                Wagging Wonders:<br>Where Purrfect Care Meets Happy Pets!
            </h1>
            <p class="lead mt-3" style="color: #666;">
                Explore a curated selection of essentials for dogs and cats, all in one place.
            </p>
            <button class="btn mt-4 px-4 py-2" style="background-color: #CB997E; color: white; border: none;">
                Shop Now
            </button>
        </div>
        <!-- Right Section: Image Placeholder -->
        <div class="col-md-6 text-center">
            <img src="{{ asset('images/image2.png') }}" alt="Dog and Cat" style="max-height: 650px; width: 100%; object-fit: contain;">
        </div>
    </div>
</div>
@endsection
