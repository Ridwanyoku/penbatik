<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

    
Route::get('/', [ProductController::class, 'welcome'])->name('welcome');
Route::get('/product/{product}', [ProductController::class, 'show'])->name('product.show');

// User pages
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart & Checkout
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
        Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // payments
    Route::get('/payment/{order}', [CheckoutController::class, 'payment'])->name('payment.index');
    Route::get('/payment/{order}/receipt', [CheckoutController::class, 'receipt'])->name('payment.receipt');
    Route::post('/payment/upload/{order}', [CheckoutController::class, 'uploadReceipt'])->name('payment.upload');

    // orders
    Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('user.orders.index');
    Route::get('/my-orders/{order}', [OrderController::class, 'show'])->name('user.orders.show');
    Route::patch('/my-orders/{order}/complete', [OrderController::class, 'completeOrder'])->name('orders.complete');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



// Admin pages
Route::middleware('auth', 'role:admin', 'verified')->group(function () {
    // Route::get('admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    Route::resource('products', ProductController::class);
    Route::resource('staffs', StaffController::class);

    // transactions
    Route::get('/transactions', [OrderController::class, 'index'])->name('transactions.index');
    Route::patch('/transactions/{order}/confirm', [OrderController::class, 'confirmPayment'])->name('admin.transactions.confirm');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});


// Staff pages
Route::middleware('auth', 'role:staff', 'verified')->group(function () {
    Route::get('staff/dashboard', [StaffController::class, 'dashboard'])->name('staff.dashboard');
});


require __DIR__.'/auth.php';
