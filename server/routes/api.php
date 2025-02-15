<?php

use App\Http\Controllers\ProductsController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SubcategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::middleware('api')->group(function () {
    //Product
    Route::get('/products', [ProductsController::class, 'index']);
    Route::get('/products/{id}', [ProductsController::class, 'show']);
    Route::post('/products', [ProductsController::class, 'store']);
    Route::put('/products/{id}', [ProductsController::class, 'update']);
    Route::delete('/products/{id}', [ProductsController::class, 'destroy']);


    //Categories
    Route::get('/categories', [CategoriesController::class, 'index']);

    //SubCategories
    Route::get('/subcategories', [SubcategoryController::class, 'index']); 
    Route::get('/categories/{id}/subcategories', [SubcategoryController::class, 'getByCategory']); 
    Route::post('/subcategories', [SubcategoryController::class, 'store']); 

});
