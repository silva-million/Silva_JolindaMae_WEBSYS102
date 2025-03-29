<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    // Admin products
    public function index() {
        $products = DB::table('products')->get();
        return view('admin.products.index', compact('products'));
    }

    public function create() {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'category' => 'required|in:Dog Food,Cat Food',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        DB::table('products')->insert([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category' => $request->category,
            'image' => $imagePath,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return redirect('/admin/products')->with('success', 'Product added!');
    }

    public function edit($id) {
        $product = DB::table('products')->find($id);
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
        }

        DB::table('products')->where('id', $id)->update([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'category' => $request->category,
            'image' => $imagePath,
            'updated_at' => now()
        ]);

        return redirect('/admin/products')->with('success', 'Product updated!');
    }

    public function delete($id) {
        DB::table('products')->where('id', $id)->delete();
        return redirect('/admin/products')->with('success', 'Product deleted!');
    }

    // User products
    public function userCatProducts(Request $request) {
        $search = $request->input('search');
        $query = DB::table('products')->where('category', 'Cat Food');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $catProducts = $query->get();
        return view('user.products.cat', compact('catProducts'));
    }

    public function userDogProducts(Request $request) {
        $search = $request->input('search');
        $query = DB::table('products')->where('category', 'Dog Food');

        if ($search) {
            $query->where('name', 'like', '%' . $search . '%');
        }

        $dogProducts = $query->get();
        return view('user.products.dog', compact('dogProducts'));
    }

    // Show Product Modal for Review
    public function showProductForReview($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        $user_id = session('user_id');

        // Check if the user has purchased the product
        $hasOrdered = DB::table('orders')
            ->join('order_items', 'orders.id', '=', 'order_items.order_id')
            ->where('order_items.product_id', $id)
            ->where('orders.user_id', $user_id)
            ->whereIn('orders.status', ['completed', 'received'])
            ->exists();

        if ($hasOrdered) {
            return view('product.review', compact('product')); // Show review form view
        } else {
            return response()->json(['message' => 'You can only review products you have purchased.'], 400);
        }
    }


// Submit Review
public function submitReview(Request $request, $id)
{
    $request->validate([
        'review' => 'required|string|max:1000',
        'rating' => 'required|integer|min:1|max:5',
    ]);

    $user_id = session('user_id');

    // Insert the review into the database
    DB::table('reviews')->insert([
        'product_id' => $id,
        'user_id' => $user_id,
        'review' => $request->input('review'),
        'rating' => $request->input('rating'),
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    return redirect()->route('product.review', ['id' => $id])->with('success', 'Review submitted successfully.');
}

}
