<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AttributeController;

Route::view('/', 'welcome');
Route::view('/product-detail', 'product-detail');
Route::view('/product', 'product');


// User Dashboard
Route::middleware(['auth'])->controller(UserController::class)->group(function () {
    Route::get('/account', 'index')->name('user-account.index');
});


// Admin Dashboard Routes
Route::middleware(['auth', 'auth.admin'])->prefix('admin/dashboard')->group(function () {
    Route::view('/', 'admin.content.index')->name('dashboard');

    Route::get('products/{product}/edit-meta-fields', [ProductController::class, 'editSeo'])->name('products.seo.edit');
    Route::put('products/{product}/update-meta-fields', [ProductController::class, 'updateSeo'])->name('products.seo.update');
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('orders', OrderController::class)->except(['create', 'store', 'edit']);
    Route::resource('customers', UserController::class);
    Route::resource('brands', BrandController::class);
    Route::resource('attributes', AttributeController::class)->except(['show']);

    // Profile Routes
    Route::get('/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('admin.profile.update');
    Route::put('/profile/password', [ProfileController::class, 'updatePassword'])->name('admin.profile.password');
});