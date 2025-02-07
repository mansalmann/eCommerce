<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;

Route::get('/', [HomeController::class, 'showHomePage'])->name('home');

Route::middleware(['auth'])->group(function(){
    Route::get('/products', [ProductController::class, 'showProductsPage'])->name('products');
    Route::get('/products/{product}', [ProductController::class, 'showProductDetailPage'])->name('product-detail');
    
    Route::get('/cart', [OrderController::class, 'showCartPage'])->name('cart');
    Route::get('/checkout', [OrderController::class, 'showCheckoutPage'])->name('checkout');
    
    Route::get('orders', [OrderController::class, 'showUserOrderPage'])->name('user-orders');
    Route::get('orders/{orderId}', [OrderController::class, 'showUserOrderDetailPage'])->name('user-detail-order');
    Route::get('orders/status/success', [OrderController::class, 'showOrderSuccessPage'])->name('order-success');
    Route::get('orders/status/canceled', [OrderController::class, 'showOrderCanceledPage'])->name('order-canceled');
    Route::get('logout', function(){
        auth()->logout();
        return redirect('/');
    })->name('logout');
});

// Auth Routes
Route::middleware(['guest'])->group( function(){
    Route::get('login', [AuthController::class, 'showLoginPage'])->name('login');
    Route::get('register', [AuthController::class, 'showRegisterPage'])->name('register');
    Route::get('forgot-password', [AuthController::class, 'showForgotPasswordPage'])->name('forgot-password');
    Route::get('reset-password', [AuthController::class, 'showResetPasswordPage'])->name('reset-password');
});
