<?php

use App\Http\Controllers\Auth\SocialAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CollectionController;
use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/product', [App\Http\Controllers\HomeController::class, 'product'])->name('product');

Route::post('/midtrans/notifications', MidtransWebhookController::class)->name('midtrans.notifications');

Route::middleware('auth')->group(function () {
    Route::get('/account-settings', [App\Http\Controllers\AccountSettingsController::class, 'index'])->name('profile.edit');
    Route::post('/account-settings', [App\Http\Controllers\AccountSettingsController::class, 'update'])->name('profile.update');
    Route::get('/my-collection', [CollectionController::class, 'index'])->name('collection.index');

    Route::get('/purchases/{product}/{assetKey?}', [PurchaseController::class, 'start'])
        ->where('assetKey', 'primary|secondary')
        ->name('purchases.start');
    Route::get('/purchases/finish/{orderId}/{assetKey?}', [PurchaseController::class, 'finish'])
        ->where('assetKey', 'primary|secondary')
        ->name('purchases.finish');
    Route::get('/products/{product}/download/{assetKey?}', [PurchaseController::class, 'download'])
        ->where('assetKey', 'primary|secondary')
        ->name('products.download');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('projects', ProjectController::class);
    Route::resource('products', ProductAdminController::class)
        ->parameters(['products' => 'product'])
        ->except(['show']);
    Route::resource('partners', PartnerController::class);
    Route::resource('categories', CategoryController::class)->except(['show']);
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

Route::get('/auth/{provider}/redirect', [SocialAuthController::class, 'redirect'])
    ->whereIn('provider', ['google', 'apple'])
    ->name('social.redirect');
Route::match(['get', 'post'], '/auth/{provider}/callback', [SocialAuthController::class, 'callback'])
    ->whereIn('provider', ['google', 'apple'])
    ->name('social.callback');

Auth::routes();

