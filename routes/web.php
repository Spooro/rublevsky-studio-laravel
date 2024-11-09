<?php

use App\Mail\Placed;
use App\Models\Order;
use App\Mail\OrderPlaced;
use App\Livewire\CartPage;
use App\Livewire\WorkPage;
use App\Livewire\OrderPage;
use App\Livewire\StorePage;
use App\Livewire\CancelPage;
use App\Livewire\ContactPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\MyAccountPage;
use App\Livewire\Auth\LoginPage;
use App\Mail\NewOrderNotification;
use Illuminate\Support\Facades\DB;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\ProductDetailPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\Auth\ForgotPasswordPage;

Route::get('/', WorkPage::class)->name('work');
Route::get('/contact', ContactPage::class)->name('contact');
Route::get('/store', StorePage::class)->name('store');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/store/{slug}', ProductDetailPage::class)->name('store.product');

Route::get('/checkout', CheckoutPage::class)->name('checkout');
Route::get('/order/{order_id}', OrderPage::class)->name('order.show');
Route::get('/cancel', CancelPage::class)->name('cancel');



Route::get('/mail', function () {
    $order = Order::latest()->firstOrFail();
    return new OrderPlaced($order);
});


Route::get('/admin-mail', function () {
    $order = Order::latest()->firstOrFail();
    return new NewOrderNotification($order);
});


Route::middleware('guest')->group(function () {

    Route::get('/login', LoginPage::class)->name('login');
    Route::get('/register', RegisterPage::class)->name('register');
    Route::get('/forgot', ForgotPasswordPage::class)->name('password.request');
    Route::get('/reset/{token}', ResetPasswordPage::class)->name('password.reset');
});


Route::middleware('auth')->group(function () {
    Route::get('/logout', function () {
        Auth::logout();
        return redirect('/store');
    });
    Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
    Route::get('/my-orders/{order_id}', MyOrderDetailPage::class)->name('my-orders.show');
    Route::get('/my-account', MyAccountPage::class)->name('my-account');
});

// Guest/Public routes

Route::get('/health', function () {
    return response()->json(['status' => 'healthy']);
});
