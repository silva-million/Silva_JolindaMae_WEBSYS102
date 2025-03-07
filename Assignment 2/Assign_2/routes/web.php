<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/master', [OrderController::class, 'mainView'])->name('main.view');
Route::get('/customer/{customerId}/{name}/{address}', [OrderController::class, 'customerView'])->name('customer.view');
Route::get('/item/{itemNo}/{name}/{price}', [OrderController::class, 'itemView'])->name('item.view');
Route::get('/order/{customerId}/{name}/{orderNo}/{date}', [OrderController::class, 'orderView'])->name('order.view');
Route::get('/orderdetails/{transNo}/{orderNo}/{itemId}/{name}/{price}/{qty}',[OrderController::class, 'orderDetailsView'])->name('order.details.view');