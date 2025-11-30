<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PremiumController;
use App\Http\Controllers\PricingController;
use App\Http\Controllers\LegalController;
use App\Http\Controllers\ShopifyWebhookController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PaymentProviderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Pricing Page (Public)
Route::get('/pricing', [PricingController::class, 'index'])->name('pricing');

// Legal Pages (Public)
Route::get('/terms', [LegalController::class, 'terms'])->name('legal.terms');
Route::get('/privacy', [LegalController::class, 'privacy'])->name('legal.privacy');
Route::get('/refund', [LegalController::class, 'refund'])->name('legal.refund');

// Google OAuth Routes
Route::get('/auth/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('google.login');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);

// Shopify Webhook (no auth middleware)
Route::post('/webhooks/shopify', [ShopifyWebhookController::class, 'handle'])->name('shopify.webhook');

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('topics.index');
    })->name('dashboard');

    // Topics Management
    Route::get('/topics', [TopicController::class, 'index'])->name('topics.index');
    Route::get('/topics/create', [TopicController::class, 'create'])->name('topics.create');
    Route::post('/topics', [TopicController::class, 'store'])->name('topics.store');
    Route::get('/topics/{topic}', [TopicController::class, 'show'])->name('topics.show');
    Route::post('/topics/{topic}/toggle', [TopicController::class, 'toggleComplete'])->name('topics.toggle');
    Route::delete('/topics/{topic}', [TopicController::class, 'destroy'])->name('topics.destroy');

    // Notes Management
    Route::post('/topics/{topic}/notes', [NoteController::class, 'store'])->name('notes.store');
    Route::put('/topics/{topic}/notes/{note}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/topics/{topic}/notes/{note}', [NoteController::class, 'destroy'])->name('notes.destroy');

    // Premium Subscription
    Route::get('/premium', [PremiumController::class, 'index'])->name('premium.index');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes (Only for admins)
Route::middleware(['auth', App\Http\Middleware\EnsureUserIsAdmin::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    
    // Users Management
    Route::get('/users', [AdminController::class, 'users'])->name('users.index');
    Route::get('/users/{user}', [AdminController::class, 'showUser'])->name('users.show');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::patch('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    
    // Payment Providers Management
    Route::get('/payment-providers', [PaymentProviderController::class, 'index'])->name('payment-providers.index');
    Route::get('/payment-providers/create', [PaymentProviderController::class, 'create'])->name('payment-providers.create');
    Route::post('/payment-providers', [PaymentProviderController::class, 'store'])->name('payment-providers.store');
    Route::get('/payment-providers/{paymentProvider}/edit', [PaymentProviderController::class, 'edit'])->name('payment-providers.edit');
    Route::patch('/payment-providers/{paymentProvider}', [PaymentProviderController::class, 'update'])->name('payment-providers.update');
    Route::delete('/payment-providers/{paymentProvider}', [PaymentProviderController::class, 'destroy'])->name('payment-providers.destroy');
});

require __DIR__.'/auth.php';
