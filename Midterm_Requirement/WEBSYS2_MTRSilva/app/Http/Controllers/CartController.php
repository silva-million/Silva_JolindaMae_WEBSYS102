<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $user_id = session('user_id'); // using session-based login
        if (!$user_id) {
            return response()->json(['success' => false, 'message' => 'Login required'], 401);
        }

        $product_id = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        if (!$product_id || !$quantity) {
            return response()->json(['success' => false, 'message' => 'Invalid input'], 400);
        }

        $existing = DB::table('carts')
        ->where('user_id', $user_id)
        ->where('product_id', $product_id)
        ->first();

        if ($existing) {
            DB::table('carts')->where('id', $existing->id)->update([
            'quantity' => $existing->quantity + $quantity,
            'updated_at' => now()
            ]);
        } else {
            DB::table('carts')->insert([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => $quantity,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }

        $count = DB::table('carts')->where('user_id', $user_id)->sum('quantity');

        return response()->json(['success' => true, 'count' => $count]);
    }

    public function getCartItems()
{
    $user_id = session('user_id');

    if (!$user_id) {
        return response()->json(['message' => 'User not logged in'], 401);
    }

    // Get all cart items for the user
    $cartItems = DB::table('carts')
        ->where('carts.user_id', $user_id)
        ->get();

    // Fetch product details for valid cart items only
    $cartItemsWithDetails = DB::table('carts')
        ->leftJoin('products', 'carts.product_id', '=', 'products.id')  // Use left join to include invalid products
        ->where('carts.user_id', $user_id)
        ->select('carts.id', 'products.name', 'products.price', 'carts.quantity', 'products.id as product_id')
        ->get();

    return response()->json($cartItemsWithDetails);
}


    public function updateCartItem(Request $request, $id)
{
    $user_id = session('user_id');
    $quantity = $request->input('quantity');

    if (!$user_id) {
        return response()->json(['message' => 'User not logged in'], 401);
    }

    if ($quantity < 1) {
        return response()->json(['message' => 'Invalid quantity'], 400);
    }

    DB::table('carts')
        ->where('id', $id)
        ->where('user_id', $user_id)
        ->update(['quantity' => $quantity]);

    return response()->json(['message' => 'Cart item updated']);
}

    // Remove selected items
public function removeSelectedItems(Request $request)
{
    $user_id = session('user_id');
    $selectedItems = $request->input('selected_items');

    if (!$user_id) {
        return response()->json(['message' => 'User not logged in'], 401);
    }

    DB::table('carts')
        ->where('user_id', $user_id)
        ->whereIn('id', $selectedItems)
        ->delete();

    return response()->json(['message' => 'Selected items removed']);
}

// Buy selected items
    public function buySelectedItems(Request $request)
{
    $user_id = session('user_id');
    $selectedItems = $request->input('selected_items');

    if (!$user_id) {
        return response()->json(['message' => 'User not logged in'], 401);
    }

    // Process the purchase for the selected items (this could include order creation, payment, etc.)
    // For simplicity, assuming the items are just removed after purchase.
    DB::table('carts')
        ->where('user_id', $user_id)
        ->whereIn('id', $selectedItems)
        ->delete();

    return response()->json(['message' => 'Items purchased successfully']);
}
}
