<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [MenuController::class, 'index']);
Route::get('/category/{category}', [CategoryController::class, 'index'])->name('category.index');
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('/cart', function () {
    return view('components.cart');
})->name('cart');

// Protected routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders');
    Route::get('/products/create', [ProductController::class, 'create'])->name('admin.products.create');
    Route::post('/products/store', [ProductController::class, 'store'])->name('admin.products.store');
    Route::get('/products/edit/{product}', [ProductController::class, 'edit'])->name('admin.products.edit');
    Route::put('/products/update/{product}', [ProductController::class, 'update'])->name('admin.products.update');
    Route::delete('/products/delete/{product}', [ProductController::class, 'destroy'])->name('admin.products.delete');
    Route::get('/products', [ProductController::class, 'index'])->name('admin.products.index');
});


