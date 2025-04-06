<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReviewController;

// Public Auth Routes
Route::get('/signup', [AuthController::class, 'showUserSignup']);
Route::post('/signup', [AuthController::class, 'userSignup']);

Route::get('/login', [AuthController::class, 'showUserLogin'])->name('login');
Route::post('/login', [AuthController::class, 'userLogin']);
Route::get('/logout', [AuthController::class, 'logout']);

// Admin login
Route::get('/admin/login', [AuthController::class, 'showAdminLogin']);
Route::post('/admin/login', [AuthController::class, 'adminLogin']);

// Dashboards
Route::get('/user/dashboard', [AuthController::class, 'userDashboard']);
Route::get('/admin/dashboard', [AuthController::class, 'adminDashboard']);

// Admin product routes
Route::get('/admin/products', [ProductController::class, 'index']);
Route::get('/admin/products/create', [ProductController::class, 'create']);
Route::post('/admin/products/store', [ProductController::class, 'store']);
Route::get('/admin/products/edit/{id}', [ProductController::class, 'edit']);
Route::post('/admin/products/update/{id}', [ProductController::class, 'update']);
Route::get('/admin/products/delete/{id}', [ProductController::class, 'delete']);

// User product views
Route::get('/user/products/cat', [ProductController::class, 'userCatProducts']);
Route::get('/user/products/dog', [ProductController::class, 'userDogProducts']);

// Cart Routes
Route::post('/cart/add', [CartController::class, 'addToCart']);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/cart/items', [CartController::class, 'getCartItems']);
Route::post('/cart/update/{id}', [CartController::class, 'updateCartItem']);
Route::post('/cart/remove-selected', [CartController::class, 'removeSelectedItems']);
Route::post('/cart/buy-selected', [CartController::class, 'buySelectedItems']);

// Order Routes
Route::post('/order/create', [OrderController::class, 'createOrderFromItems']);
Route::get('/orders/active', [OrderController::class, 'getActiveOrders']);
Route::post('/orders/update/{orderId}', [OrderController::class, 'updateOrderStatus']);
Route::get('/orders/history', [OrderController::class, 'getOrderHistory']);

// Admin Order Routes
Route::get('/admin/orders', [OrderController::class, 'getAllOrders'])->name('admin.orders');
Route::get('/admin/orders/{orderId}', [OrderController::class, 'getOrderDetails'])->name('admin.orders.details');
Route::put('/admin/orders/update/{orderId}', [OrderController::class, 'updateOrderStatus'])->name('admin.orders.update');

// Review Routes
Route::get('/user/products/{id}/review', [ProductController::class, 'showProductForReview']);
Route::get('/review/{product_id}/{order_id}', [ReviewController::class, 'showReviewForm'])->name('review.form');
Route::post('/review/submit', [ReviewController::class, 'submitReview'])->name('review.submit');
Route::get('/product/{product_id}/reviews', [ProductController::class, 'getProductReviews']);
Route::get('/user/reviews', [ReviewController::class, 'getUserReviews']);

// Admin Review Routes (New)
Route::prefix('admin')->group(function () {
    Route::get('/reviews', [ReviewController::class, 'adminIndex'])->name('admin.reviews');
    Route::post('/reviews/delete/{id}', [ReviewController::class, 'adminDelete'])->name('admin.reviews.delete');
});
