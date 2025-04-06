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
            <button class="btn mt-4 px-4 py-2" style="background-color: #CB997E; color: white; border: none;" onclick="window.location.href='/user/products/cat'">
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

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    preloadOrders();
    preloadHistory();
    preloadReviews();
});

// ✅ Preload Orders
function preloadOrders() {
    $.ajax({
        url: '/orders/active',
        method: 'GET',
        success: function(response) {
            const ordersContainer = document.getElementById('my-orders');
            if (!ordersContainer) return; // prevent error if sidebar is not present
            ordersContainer.innerHTML = '';
            if (response.length > 0) {
                response.forEach(order => {
                    ordersContainer.innerHTML += `
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6>Order #${order.id} - ${order.status}</h6>
                                <p>Total: ₱${order.total_price}</p>
                                <button class="btn btn-success btn-sm" onclick="markAsReceived(${order.id})">Mark as Received</button>
                            </div>
                        </div>
                    `;
                });
            } else {
                ordersContainer.innerHTML = '<p>No ongoing orders.</p>';
            }
        }
    });
}

// ✅ Preload History
function preloadHistory() {
    $.ajax({
        url: '/orders/history',
        method: 'GET',
        success: function(response) {
            const historyContainer = document.getElementById('my-history');
            if (!historyContainer) return;
            historyContainer.innerHTML = '';
            if (response.length > 0) {
                response.forEach(order => {
                    let productsHTML = '';
                    order.products.forEach(product => {
                        const buttonText = product.review_exists ? 'View Review' : 'Review';
                        productsHTML += `
                            <div>
                                <p>${product.name} - ₱${product.price}</p>
                                <button class="btn btn-primary review-btn" data-order-id="${order.id}" data-product-id="${product.product_id}">
                                    ${buttonText}
                                </button>
                            </div>
                        `;
                    });
                    historyContainer.innerHTML += `
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6>Order #${order.id} - ${order.status}</h6>
                                <p>Total: ₱${order.total_price}</p>
                                ${productsHTML}
                            </div>
                        </div>
                    `;
                });

                // Attach review button click event
                $('.review-btn').on('click', function() {
                    const productId = $(this).data('product-id');
                    const orderId = $(this).data('order-id');
                    const buttonText = $(this).text().trim();

                    if (buttonText === 'View Review') {
                        const offcanvas = new bootstrap.Offcanvas(document.getElementById('reviewsSidebar'));
                        offcanvas.show();
                        preloadReviews();
                    } else {
                        window.location.href = `/review/${productId}/${orderId}`;
                    }
                });

            } else {
                historyContainer.innerHTML = '<p>No completed or received orders.</p>';
            }
        }
    });
}

// ✅ Preload Reviews
function preloadReviews() {
    $.ajax({
        url: '/user/reviews',
        method: 'GET',
        success: function(response) {
            const reviewsContainer = document.getElementById('my-reviews');
            if (!reviewsContainer) return;
            reviewsContainer.innerHTML = '';
            if (response.length > 0) {
                response.forEach(review => {
                    reviewsContainer.innerHTML += `
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6>${review.product_name}</h6>
                                <p>Rating: ${'⭐'.repeat(review.rating)}</p>
                                <p>${review.comment}</p>
                                <small class="text-muted">${new Date(review.created_at).toLocaleDateString()}</small>
                            </div>
                        </div>
                    `;
                });
            } else {
                reviewsContainer.innerHTML = '<p>No reviews yet.</p>';
            }
        }
    });
}

// ✅ Mark order as received
function markAsReceived(orderId) {
    $.ajax({
        url: `/orders/update/${orderId}`,
        method: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            status: 'received'
        },
        success: function() {
            alert('Order marked as received!');
            preloadOrders();
            preloadHistory();
        },
        error: function() {
            alert('Failed to mark as received.');
        }
    });
}
</script>
@endsection
