<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WeaponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserCashController;

Route::get('/', function ()
{
    return view('welcome');
})->name('home');


Route::get('/England', function ()
{
    return view('England');
})->name('England');

Route::get('/Soviet_Union', function ()
{
    return view('Soviet_Union');

})->name('Soviet_Union');

Route::get('/Germany', function ()
{
    return view('Germany');
})->name('Germany');


Route::get('/Switzerland', function ()
{
    session(['selected_country' => 'Switzerland']);
    return view('Switzerland');
})->name('Switzerland');

Route::get('/emails/qr/{filename}',[QrCodeController::class,'convertCsvToQr'])
    ->middleware(['auth','verified'])
    ->name('emails.qr');
Route::post('/emails/qr/{filename}',[QrCodeController::class,'convertCsvToQr'])
    ->middleware(['auth','verified'])
    ->name('emails.qr.post');
Route::get('cart', [CartController::class, 'index'])
    ->middleware(['auth'])
    ->name('cart.index');
Route::get('/weapons/index', [WeaponController::class, 'index'])
    ->middleware(['auth'])
    ->name('weapons.index'); 
Route::get('orders', [OrderController::class, 'index'])
    ->middleware(['auth'])
    ->name('orders.index');
Route::get('orders/user_orders', [OrderController::class, 'showByUser'])
    ->middleware(['auth'])
    ->name('orders.user_orders');
Route::get('orders/send-order', [OrderController::class, 'showSendOrderForm'])
    ->middleware(['auth'])
    ->name('orders.send-order-form');
Route::post('orders/send-email', [OrderController::class, 'sendOrderEmail'])
    ->middleware(['auth'])
    ->name('orders.send-email');
Route::get('weapons/show/{weapon}', [WeaponController::class, 'show'])
    ->middleware(['auth'])
    ->name('weapons.show');
Route::get('weapons/create', [WeaponController::class, 'create'])
    ->middleware(['auth'])
    ->name('weapons.create');
Route::post('weapons/store', [WeaponController::class, 'store'])
    ->middleware(['auth'])
    ->name('weapons.store');
Route::get('weapons/{weapon}/edit', [WeaponController::class, 'edit'])
    ->middleware(['auth'])
    ->name('weapons.edit');
Route::put('weapons/{weapon}', [WeaponController::class, 'update'])
    ->middleware(['auth'])
    ->name('weapons.update');
Route::post('carts/add/{weapon}', [CartController::class, 'addToCart'])
    ->middleware(['auth'])
    ->name('cart.add');
Route::delete('cart/remove/{order}', [CartController::class, 'remove'])
    ->middleware(['auth'])
    ->name('cart.remove');
Route::delete('cart/clear', [CartController::class, 'clear'])
    ->middleware(['auth'])
    ->name('cart.clear');
Route::post('cart/checkout', [CartController::class, 'checkout'])
    ->middleware(['auth'])
    ->name('cart.checkout');

Route::post('user/add-funds', [UserCashController::class, 'addFunds'])
    ->middleware(['auth'])
    ->name('user.add-funds');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
