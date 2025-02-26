<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\SubcategoriesController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


// web
Route::get("/admin/sanpham", function () {
    return view('product');
});
Route::get("/admin/sanpham", [ProductsController::class, 'getProducts']);

Route::get("/admin", function () {
    return view("welcome");
});
Route::get("/admin/danhmuc", [CategoriesController::class, 'getCategory']);


// API
Route::get("/api/sanpham", [ProductsController::class, 'index']);
Route::get("/api/sanpham/{id}", [ProductsController::class, 'show']);
Route::get("/api/danhmuc", [CategoriesController::class, 'index']);
Route::get("/api/danhmuccon", [SubcategoriesController::class, 'index']);


Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/login', [UserController::class, 'login']);








