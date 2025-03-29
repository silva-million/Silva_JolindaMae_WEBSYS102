@extends('layout.user')

@section('content')
    <div class="container py-4">
        <!-- Search Bar -->
        <div class="mb-4">
            <form action="{{ url('/user/products/cat') }}" method="GET" class="d-flex justify-content-start">
                <div class="input-group" style="max-width: 300px;">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="bi bi-search"></i>
                    </span>
                    <input type="text" name="search" class="form-control border-start-0" placeholder="Search product..."
                        value="{{ request()->input('search') }}">
                </div>
            </form>
        </div>

        <!-- Product Grid -->
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @forelse($catProducts as $product)
                <div class="col">
                    <!-- Card with clickable area to open modal -->
                    <div class="card h-100 shadow-sm product-card"
                        style="border-radius: 10px; cursor: pointer; width: 350px;" data-bs-toggle="modal"
                        data-bs-target="#productModal{{ $product->id }}">
                        <div
                            style="height: 200px; background-color: #FCFCFC; display: flex; align-items: center; justify-content: center; border-top-left-radius: 10px; border-top-right-radius: 10px;">
                            @if ($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}"
                                    style="max-height: 100%; max-width: 100%; object-fit: contain;">
                            @else
                                <span class="text-muted">No image</span>
                            @endif
                        </div>
                        <div class="card-body">
                            <h5 class="card-title" style="color: #5A604D; font-weight: bold;">
                                {{ $product->name }}</h5>
                            <p class="card-text mb-0" style="color: #CB997E; font-size: 20px; font-weight: 500;">
                                ₱{{ number_format($product->price, 2) }}
                            </p><br>
                            <p class="card-text" style="color: #333; font-size: 14px;">
                                {{ $product->quantity }} pcs in stock
                            </p>
                        </div>
                    </div>

                    <!-- Product Details Modal -->
                    <div class="modal fade" id="productModal{{ $product->id }}" tabindex="-1"
                        aria-labelledby="productModalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header" style="background-color: #6B705C; color: white;">
                                    <h5 class="modal-title" id="productModalLabel{{ $product->id }}">{{ $product->name }}
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-0">
                                    <div class="row g-0">
                                        <!-- Left Side: Product Details (75%) -->
                                        <div class="col-md-8 p-4"
                                            style="background-color: #FCFCFC; max-height: 500px; overflow-y: auto;">
                                            <!-- Product Image -->
                                            <div class="text-center mb-4">
                                                @if ($product->image)
                                                    <img src="{{ asset('storage/' . $product->image) }}"
                                                        alt="{{ $product->name }}"
                                                        style="max-height: 250px; max-width: 100%; object-fit: contain; background-color: #FCFCFC; border-radius: 10px;">
                                                @else
                                                    <div
                                                        style="height: 250px; background-color: #e0e0e0; display: flex; align-items: center; justify-content: center; border-radius: 10px;">
                                                        <span class="text-muted">No image</span>
                                                    </div>
                                                @endif
                                            </div>
                                            <!-- Product Name -->
                                            <h5 style="color: #5A604D; font-weight: bold;">{{ $product->name }}</h5>
                                            <!-- Stock -->
                                            <p style="color: #333; font-size: 14px;">{{ $product->quantity }} pcs in stock
                                            </p>
                                            <!-- Description -->
                                            <p style="color: #5A604D; font-weight: bold;">Description</p>
                                            <p style="color: #666; font-size: 14px; white-space: pre-wrap;">
                                                {{ $product->description }}</p>
                                        </div>
                                        <!-- Right Side: Price, Quantity Selector, Total, Buttons (25%) -->
                                        <div class="col-md-4 p-4 d-flex flex-column"
                                            style="background-color: #f6f6f6; min-height: 500px;">
                                            <!-- Price and Quantity Selector at the top -->
                                            <div>
                                                <p style="color: #CB997E; font-size: 20px; font-weight: 500;">
                                                    ₱{{ number_format($product->price, 2) }}
                                                </p>
                                                <!-- Quantity Selector -->
                                                <div class="input-group mb-3" style="max-width: 150px;">
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        onclick="updateQuantity('quantity{{ $product->id }}', -1, {{ $product->price }})">-</button>
                                                    <input type="number" id="quantity{{ $product->id }}" name="quantity"
                                                        class="form-control text-center" value="1" min="1"
                                                        max="{{ $product->quantity }}" readonly>
                                                    <button type="button" class="btn btn-outline-secondary"
                                                        onclick="updateQuantity('quantity{{ $product->id }}', 1, {{ $product->price }})">+</button>
                                                </div>
                                            </div>
                                            <!-- Spacer to push Total and Buttons to the bottom -->
                                            <div class="flex-grow-1"></div>
                                            <!-- Total Amount and Buttons at the bottom -->
                                            <div>
                                                <p class="mb-3">
                                                    <strong>Total:</strong>
                                                    <span id="total{{ $product->id }}"
                                                        style="color: #CB997E;">₱{{ number_format($product->price, 2) }}</span>
                                                </p>
                                                <form>
                                                    <button type="button" onclick="addToCart({{ $product->id }})"
                                                        class="btn btn-outline-secondary w-100">Add to Cart</button>
                                                </form>
                                                <form>
                                                    <button type="button" class="btn w-100 mt-2"
                                                        style="background-color: #6B705C; color: white; border: none;"
                                                        onclick="showOrderConfirmationModal({{ $product->id }})">Buy
                                                        now</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center text-muted">
                    <p>No cat food products available.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@section('scripts')
    <!-- jQuery (Ensure only one instance) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- JavaScript Logic -->
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const cards = document.querySelectorAll('.product-card');

        cards.forEach(card => {
            card.addEventListener('click', function () {
                // Remove active class from all cards
                cards.forEach(c => c.classList.remove('active'));
                // Add active class to the clicked card
                this.classList.add('active');
            });
        });

        // Remove active class when modal is closed
        document.querySelectorAll('.modal').forEach(modal => {
            modal.addEventListener('hidden.bs.modal', function () {
                cards.forEach(card => card.classList.remove('active'));
            });
        });
    });

    function updateQuantity(inputId, change, price) {
        const input = document.getElementById(inputId);
        let quantity = parseInt(input.value) + change;
        const max = parseInt(input.max);

        // Ensure quantity stays within the valid range
        if (quantity < 1) quantity = 1;
        if (quantity > max) quantity = max;

        // ✅ Update input value
        input.value = quantity;

        // ✅ Recalculate total based on updated quantity
        const total = price * quantity;
        const productId = inputId.replace('quantity', '');
        document.getElementById('total' + productId).textContent = '₱' + total.toFixed(2);
    }

    function addToCart(productId) {
        const quantity = document.getElementById('quantity' + productId).value;

        $.ajax({
            url: "/cart/add",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                product_id: productId,
                quantity: quantity
            },
            success: function (response) {
                if (response.success) {
                    // ✅ Close the modal
                    const modalEl = document.getElementById('productModal' + productId);
                    const modal = bootstrap.Modal.getInstance(modalEl);
                    modal.hide();

                    // ✅ Update cart count dynamically
                    const countSpan = document.getElementById("cart-count");
                    if (countSpan) {
                        countSpan.textContent = response.count;
                    }

                    // ✅ Show confirmation message
                    alert("Item added to cart successfully!");
                }
            },
            error: function (xhr) {
                if (xhr.status === 401) {
                    alert("Please log in to add items to your cart.");
                    window.location.href = "/login";
                } else {
                    alert("Something went wrong while adding the item!");
                }
            }
        });
    }
</script>
@endsection
