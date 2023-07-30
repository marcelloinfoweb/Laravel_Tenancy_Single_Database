<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShippingOptionsController;
use App\Http\Controllers\Front\AuthenticateController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\CheckoutController;
use App\Http\Controllers\Front\MyOrdersController;
use App\Http\Controllers\Front\StoreController;
use App\Http\Controllers\ProfileController;
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

Route::domain('{subdomain}.localhost')->group(function () {
    Route::get('/', [StoreController::class, 'index'])->name('front.store');

    Route::prefix('cart')->name('cart.')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('index');
        Route::get('add/{product}', [CartController::class, 'add'])->name('add');
        Route::get('remove/{product}', [CartController::class, 'remove'])->name('remove');
        Route::get('cancel', [CartController::class, 'cancel'])->name('cancel');
        Route::post('shipping', [CartController::class, 'shipping'])->name('store-shipping');
    });

    Route::prefix('checkout')->middleware('auth.stores')->name('checkout.')->group(function () {
        Route::get('/', [CheckoutController::class, 'checkout'])->name('checkout');
        Route::post('/process', [CheckoutController::class, 'process'])->name('process');
        Route::get('/thanks', [CheckoutController::class, 'thanks'])->name('thanks');
    });

    Route::name('sign.')->group(function () {
        Route::get('/sign-in', [AuthenticateController::class, 'index'])->name('index');
        Route::post('/sign-in', [AuthenticateController::class, 'signIn'])->name('in');
        Route::post('/sign-up', [AuthenticateController::class, 'signUp'])->name('up');
    });

    Route::get('/my-orders', [MyOrdersController::class, 'index'])
        ->name('my.orders')
        ->middleware('auth');

    Route::get('logout', [AuthenticateController::class, 'logout'])->name('up');
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('acl')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('products', ProductController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('shippings', ShippingOptionsController::class);
    });
});

require __DIR__ . '/auth.php';
