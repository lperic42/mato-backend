<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\SubcategoriesController;
use App\Http\Controllers\Api\ProductController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('categories', [CategoriesController::class, 'index'])->name('categories.index');
Route::post('categories', [CategoriesController::class, 'store'])->name('categories.store');
Route::get('categories/{category}', [CategoriesController::class, 'show'])->name('categories.show');
Route::put('categories/{category}', [CategoriesController::class, 'update'])->name('categories.update');
Route::delete('categories', [CategoriesController::class, 'delete'])->name('categories.delete');

Route::get('subcategories', [SubcategoriesController::class, 'index'])->name('subcategories.index');
Route::post('subcategories', [SubcategoriesController::class, 'store'])->name('subcategories.store');
Route::get('subcategories/{subcategory}', [SubcategoriesController::class, 'show'])->name('subcategories.show');
Route::put('subcategories/{subcategory}', [SubcategoriesController::class, 'update'])->name('subcategories.update');
Route::delete('subcategories', [SubcategoriesController::class, 'delete'])->name('subcategories.delete');

Route::get('products', [ProductController::class, 'index'])->name('products.index');
Route::post('products', [ProductController::class, 'store'])->name('products.store');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::put('products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('products', [ProductController::class, 'delete'])->name('products.delete');
