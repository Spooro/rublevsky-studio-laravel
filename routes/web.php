<?php

use App\Livewire\Auth\ForgotPasswordPage;
use App\Livewire\Auth\LoginPage;
use App\Livewire\Auth\RegisterPage;
use App\Livewire\Auth\ResetPasswordPage;
use App\Livewire\CancelPage;
use App\Livewire\CartPage;
use App\Livewire\CheckoutPage;
use App\Livewire\ContactPage;
use App\Livewire\MyOrderDetailPage;
use App\Livewire\MyOrdersPage;
use App\Livewire\ProductDetailPage;
use App\Livewire\StorePage;
use App\Livewire\SuccessPage;
use App\Livewire\WorkPage;
use Illuminate\Support\Facades\Route;

Route::get('/', WorkPage::class)->name('work');
Route::get('/contact', ContactPage::class)->name('contact');
Route::get('/store', StorePage::class)->name('store');
Route::get('/cart', CartPage::class)->name('cart');
Route::get('/product/{product}', ProductDetailPage::class);
Route::get('/checkout', CheckoutPage::class)->name('checkout');
Route::get('/my-orders', MyOrdersPage::class)->name('my-orders');
Route::get('/my-orders/{order}', MyOrderDetailPage::class);
Route::get('/login', LoginPage::class)->name('login');
Route::get('/register', RegisterPage::class)->name('register');
Route::get('/forgot', ForgotPasswordPage::class)->name('forgot-password');
Route::get('/reset', ResetPasswordPage::class)->name('reset-password');
Route::get('/success', SuccessPage::class)->name('success');
Route::get('/cancel', CancelPage::class)->name('cancel');
