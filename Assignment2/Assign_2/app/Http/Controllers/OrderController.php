<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function mainView()
    {
        return view('master');
    }

    public function customerView($customerId, $name, $address)
    {
        return view('customer', compact('customerId', 'name', 'address'));
    }

    public function itemView($itemNo, $name, $price)
    {
        return view('item', compact('itemNo', 'name', 'price'));
    }

    public function orderView($customerId, $name, $orderNo, $date)
    {
        return view('order', compact('customerId', 'name', 'orderNo', 'date'));
    }

    public function orderDetailsView($transNo, $orderNo, $itemId, $name, $price, $qty)
    {
        return view('orderdetails', compact('transNo', 'orderNo', 'itemId', 'name', 'price', 'qty'));
    }
}
