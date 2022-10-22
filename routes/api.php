<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoriesController;
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
