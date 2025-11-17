<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrdersController;

// Routes API pour Products
Route::apiResource('products', ProductController::class);

// Routes API pour Customers
Route::apiResource('customers', CustomerController::class);

// Routes API pour Orders
Route::apiResource('orders', OrdersController::class);
