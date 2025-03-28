<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\ShipController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




// web
Route::get("/admin", [DashboardController::class, 'getTotal']);
Route::get("/admin/product", [ProductsController::class, 'getProducts']);
Route::get("/admin/category", [CategoriesController::class, 'getCategory']);
Route::get("/admin/user", [UserController::class, 'getUser']);
Route::get("/admin/order", [OrderController::class, 'getAllOrder']);



// API

// product
Route::get("/api/sanpham", [ProductsController::class, 'index']);
Route::get("/api/sanpham/{id}", [ProductsController::class, 'show']);


// category
Route::get("/api/danhmuc", [CategoriesController::class, 'index']);
Route::get("/api/danhmuccon", [SubcategoriesController::class, 'index']);



// auth
Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/login', [UserController::class, 'login']);
Route::get("/api/decode_token", [UserController::class, 'decoded'])->middleware(Auth::class);






// user
Route::get("/user", [UserController::class, 'index'])->middleware(Auth::class);



// payment
Route::post("/api/zalopay", [PaymentController::class, 'zalopay']);
Route::post("/api/vnpay", [PaymentController::class, 'vnpay']);
Route::post("/api/momo", [PaymentController::class,'momo']);

Route::post("/api/vnpay-return", [PaymentController::class, 'vnpayReturn']);
Route::post("/api/zalopay-return", [PaymentController::class, 'zalopayReturn']);


// Order
Route::post("/api/order", [OrderController::class, 'create']);
Route::get("/api/get_order_by_user/{id}", [OrderController::class, 'getOrderByUser']);
Route::get("/api/get_order_by_id/{id}", [OrderController::class, 'getOrderByID']);


// Ship
Route::get("/api/ship", [ShipController::class, 'index']);
