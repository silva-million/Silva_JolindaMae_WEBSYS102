<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Function to create an order (User-related function)
    public function createOrderFromItems(Request $request)
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return response()->json(['message' => 'Login required'], 401);
        }

        $items = $request->input('items');
        if (!$items || !is_array($items)) {
            return response()->json(['message' => 'Invalid items'], 400);
        }

        // Calculate total price and fetch product details
        $totalPrice = 0;
        $cartItems = [];
        $skippedItems = [];

        foreach ($items as $item) {
            $product = DB::table('products')->where('id', $item['product_id'])->first();
            if (!$product) {
                $skippedItems[] = $item['product_id'];
                continue; // Skip this item
            }
            $totalPrice += $product->price * $item['quantity'];
            $cartItems[] = (object)[
                'product_id' => $product->id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $item['quantity']
            ];
        }

        // If no valid items remain, return an error
        if (empty($cartItems)) {
            return response()->json(['message' => 'No valid items to order. Skipped items: ' . implode(', ', $skippedItems)], 400);
        }

        // Begin transaction to ensure data consistency
        DB::beginTransaction();
        try {
            // Create order
            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $user_id,
                'total_price' => $totalPrice,
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now()
            ]);

            // Insert order items
            foreach ($cartItems as $item) {
                DB::table('order_items')->insert([
                    'order_id' => $orderId,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->price,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Remove items from cart
            $productIds = array_column($items, 'product_id');
            DB::table('carts')
                ->where('user_id', $user_id)
                ->whereIn('product_id', $productIds)
                ->delete();

            DB::commit();

            $response = ['success' => true, 'order_id' => $orderId];
            if (!empty($skippedItems)) {
                $response['message'] = 'Order placed, but some items were skipped (not found): ' . implode(', ', $skippedItems);
            }

            return response()->json($response);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Failed to create order: ' . $e->getMessage()], 500);
        }
    }

    // Function to show the order confirmation (User-related function)
    public function orderConfirmation($orderId)
    {
        $order = DB::table('orders')
            ->where('id', $orderId)
            ->first();

        $orderItems = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_items.order_id', $orderId)
            ->select('products.name', 'order_items.quantity', 'order_items.price')
            ->get();

        return view('order.confirmation', compact('order', 'orderItems'));
    }

    // Function to get active orders for the logged-in user (User-related function)
    public function getActiveOrders()
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return response()->json(['message' => 'User not logged in'], 401);
        }

        $orders = DB::table('orders')
            ->where('user_id', $user_id)
            ->whereIn('status', ['pending', 'processing',])
            ->get();

        return response()->json($orders);
    }

    // Function to get order history for the logged-in user (User-related function)
    public function getOrderHistory()
    {
        $user_id = session('user_id');
        if (!$user_id) {
            return response()->json(['message' => 'User not logged in'], 401);
        }

        $orders = DB::table('orders')
            ->where('user_id', $user_id)
            ->whereIn('status', ['completed', 'received'])
            ->get();

        $orders = $orders->map(function ($order) {
            $order->products = DB::table('order_items')
                ->join('products', 'order_items.product_id', '=', 'products.id')
                ->where('order_items.order_id', $order->id)
                ->select('products.id as product_id', 'products.name', 'products.price')
                ->get();

            $order->can_review = true;

            return $order;
        });

        return response()->json($orders);
    }

    // Function to update order status (Admin-related function)
    public function updateOrderStatus(Request $request, $orderId)
    {
        // Validate the status input
        $request->validate([
            'status' => 'required|in:pending,processing,received,completed,cancelled',
        ]);

        // Update the status of the order
        DB::table('orders')
            ->where('id', $orderId)
            ->update(['status' => $request->status]);

        return redirect()->route('admin.orders')->with('success', 'Order status updated successfully!');
    }


    // Function to fetch all orders (Admin-related function)
    public function getAllOrders()
{
    // Fetch all orders, including 'completed' and 'received' as completed orders
    $orders = DB::table('orders')
        ->join('users', 'orders.user_id', '=', 'users.id')
        ->select('orders.id', 'users.name as customer_name', 'orders.total_price', 'orders.status', 'orders.created_at')
        ->get();

    // For each order, load the associated order items
    foreach ($orders as $order) {
        $order->orderItems = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_items.order_id', $order->id)
            ->select('products.name as product_name', 'order_items.quantity', 'order_items.price')
            ->get();
    }

    return view('admin.orders.index', compact('orders'));
}



    // Function to view a single order (Admin-related function)
    public function getOrderDetails($orderId)
    {
        // Admin can view detailed order information
        $order = DB::table('orders')
            ->where('id', $orderId)
            ->first();

        $orderItems = DB::table('order_items')
            ->join('products', 'order_items.product_id', '=', 'products.id')
            ->where('order_items.order_id', $orderId)
            ->select('products.name', 'order_items.quantity', 'order_items.price')
            ->get();

        return response()->json(['order' => $order, 'order_items' => $orderItems]);
    }
}
