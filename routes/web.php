<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MidtransWebhookController;
use App\Http\Controllers\PartnerController;
use App\Http\Controllers\ProductAdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PurchaseController;
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
    Route::get('/purchases/{product}/{assetKey?}', [PurchaseController::class, 'start'])
        ->where('assetKey', 'primary|secondary')
        ->name('purchases.start');
    Route::get('/purchases/finish/{orderId}/{assetKey?}', [PurchaseController::class, 'finish'])
        ->where('assetKey', 'primary|secondary')
        ->name('purchases.finish');
    Route::get('/products/{product}/download/{assetKey?}', [PurchaseController::class, 'download'])
        ->where('assetKey', 'primary|secondary')
        ->name('products.download');

    Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard.index');
    Route::resource('projects', ProjectController::class);
    Route::resource('products', ProductAdminController::class)
        ->parameters(['products' => 'product'])
        ->except(['show']);
    Route::resource('partners', PartnerController::class);
    Route::resource('categories', CategoryController::class)->except(['show']);
});

Auth::routes();
