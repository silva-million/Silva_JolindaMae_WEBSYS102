<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    // Show review form for a user
    public function showReviewForm($product_id, $order_id)
    {
        $user_id = session('user_id');

        // Check if user purchased this product with status Received or Completed
        $order = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('order_items.product_id', $product_id)
            ->where('orders.user_id', $user_id)
            ->whereIn('orders.status', ['received', 'completed'])
            ->where('orders.id', $order_id)
            ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'You cannot review a product you have not purchased or it is not yet completed.');
        }

        // Check if already reviewed
        $existingReview = DB::table('reviews')
            ->where('product_id', $product_id)
            ->where('user_id', $user_id)
            ->first();

        if ($existingReview) {
            return redirect('/user')->with('error', 'You have already reviewed this product.');
        }

        // Get product details
        $product = DB::table('products')->where('id', $product_id)->first();

        return view('user.products.review', compact('product', 'order'));
    }

    // Submit a review
    public function submitReview(Request $request)
    {
        $request->validate([
            'product_id' => 'required',
            'order_id' => 'required',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);

        $user_id = session('user_id');

        // Double-check if the user has purchased this product
        $order = DB::table('order_items')
            ->join('orders', 'order_items.order_id', '=', 'orders.id')
            ->where('order_items.product_id', $request->product_id)
            ->where('orders.user_id', $user_id)
            ->whereIn('orders.status', ['received', 'completed'])
            ->where('orders.id', $request->order_id)
            ->first();

        if (!$order) {
            return redirect()->back()->with('error', 'You cannot review a product you have not purchased or it is not yet completed.');
        }

        // Prevent duplicate reviews
        $existingReview = DB::table('reviews')
            ->where('product_id', $request->product_id)
            ->where('user_id', $user_id)
            ->first();

        if ($existingReview) {
            return redirect('/user')->with('error', 'You have already reviewed this product.');
        }

        // Insert review
        DB::table('reviews')->insert([
            'product_id' => $request->product_id,
            'user_id' => $user_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect('/user/dashboard')->with('success', 'Thank you for your review!');
    }

    // Get reviews for a specific user (for the user sidebar)
    public function getUserReviews()
    {
        $userId = session('user_id');

        $reviews = DB::table('reviews')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->where('reviews.user_id', $userId)
            ->select('products.name as product_name', 'reviews.rating', 'reviews.comment', 'reviews.created_at')
            ->get();

        return response()->json($reviews);
    }

    // Admin: Show all reviews
    public function adminIndex()
    {
        $reviews = DB::table('reviews')
            ->join('products', 'reviews.product_id', '=', 'products.id')
            ->join('users', 'reviews.user_id', '=', 'users.id')
            ->select(
                'reviews.id',
                'products.name as product_name',
                'users.name as user_name',
                'reviews.rating',
                'reviews.comment',
                'reviews.created_at'
            )
            ->orderBy('reviews.created_at', 'desc')
            ->get();

        return view('admin.reviews', compact('reviews'));
    }

    // Admin: Delete a review
    public function adminDelete($id)
    {
        // Check if the review exists
        $review = DB::table('reviews')->where('id', $id)->first();

        if (!$review) {
            return redirect()->route('admin.reviews')->with('error', 'Review not found.');
        }

        // Delete the review
        DB::table('reviews')->where('id', $id)->delete();

        return redirect()->route('admin.reviews')->with('success', 'Review deleted successfully!');
    }
}
