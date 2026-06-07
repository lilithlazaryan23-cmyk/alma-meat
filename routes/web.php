<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\WarehouseController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about/atenk', [PageController::class, 'atenk'])->name('about.atenk');
Route::get('/about/luma', [PageController::class, 'luma'])->name('about.luma');
Route::get('/about/marila', [PageController::class, 'marila'])->name('about.marila');
Route::get('/recipes', [PageController::class, 'recipes'])->name('recipes');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->middleware('throttle:10,1')->name('register.store');
Route::post('/login', [AuthController::class, 'login'])->middleware('throttle:30,1')->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::post('/products/like', [ProductController::class, 'like'])->middleware('auth.user')->name('products.like');

Route::middleware('auth.user')->group(function () {
    Route::get('/cart', [PageController::class, 'cart'])->name('cart');
    Route::post('/checkout', [PageController::class, 'checkout'])->name('checkout');
});

Route::prefix('admin')->name('admin.')->middleware('auth.admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/warehouse', [WarehouseController::class, 'index'])->name('warehouse');
    Route::get('/products', [AdminProductController::class, 'list'])->name('products');
    Route::get('/brand', [BrandController::class, 'index'])->name('brand');
    Route::get('/products/add', [AdminProductController::class, 'addForm'])->name('products.add');
    Route::post('/products/add', [AdminProductController::class, 'store'])->name('products.store');
    Route::get('/products/search', [AdminProductController::class, 'search'])->name('products.search');
    Route::post('/products/store-ajax', [AdminProductController::class, 'storeAjax'])->name('products.store-ajax');
});

Route::post('/admin/logout', [AuthController::class, 'adminLogout'])->name('admin.logout');
