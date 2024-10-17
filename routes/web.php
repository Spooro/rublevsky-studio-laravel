<?php

use App\Mail\Placed;
use App\Mail\OrderPlaced;
use App\Mail\NewOrderNotification;
use App\Livewire\CartPage;
use App\Livewire\WorkPage;
use App\Livewire\StorePage;
use App\Livewire\CancelPage;
use App\Livewire\ContactPage;
use App\Livewire\SuccessPage;
use App\Livewire\CheckoutPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\Auth\LoginPage;

use App\Livewire\Auth\RegisterPage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\ProductDetailPage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\Auth\ForgotPasswordPage;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

Route::get('/', WorkPage::class)->name('work');
Route::get('/mail', function () {
    $order = Order::findOrFail(1); // Get the order with ID 1
    return new OrderPlaced($order);
});

// Add this new route for testing the admin notification email
Route::get('/admin-mail', function () {
    $order = Order::findOrFail(1); // Get the order with ID 1
    return new NewOrderNotification($order);
});

Route::get('/contact', ContactPage::class)->name('contact');
Route::get('/store', StorePage::class)->name('store');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/store/{slug}', ProductDetailPage::class)->name('store.product');





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
    Route::get('/checkout', CheckoutPage::class)->name('checkout');
    Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
    Route::get('/my-orders/{order_id}', MyOrderDetailPage::class)->name('my-orders.show');
    Route::get('/success', SuccessPage::class)->name('success');
    Route::get('/cancel', CancelPage::class)->name('cancel');
});
