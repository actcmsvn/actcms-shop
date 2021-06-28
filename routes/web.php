<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [ProductController::class, 'index'])->name('index');
Route::get('/cart', [ProductController::class, 'cart'])->name('cart');
Route::get('/checkout', [ProductController::class, 'checkout'])->name('checkout');
Route::get('/product/{product_id}', [ProductController::class, 'productPage'])->where('product_id', '[0-9_\-]+')->name('productPage');
Route::get('/success', [ProductController::class, 'success'])->name('success');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard',  [OrderController::class, 'dashboard'])->name('dashboard');
