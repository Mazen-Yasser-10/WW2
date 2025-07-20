<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WeaponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserCashController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/email/verify/{id}/{hash}', VerifyEmailController::class)
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', function (EmailVerificationRequest $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'verification-link-sent');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/emails/qr/{filename}',[QrCodeController::class,'convertCsvToQr'])
    ->middleware(['auth','verified'])
    ->name('emails.qr');
Route::post('/emails/qr/{filename}',[QrCodeController::class,'convertCsvToQr'])
    ->middleware(['auth','verified'])
    ->name('emails.qr.post');
Route::get('cart', [CartController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('cart.index');
Route::get('/weapons/index', [WeaponController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('weapons.index'); 
Route::get('orders', [OrderController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('orders.index');
Route::get('orders/user_orders', [OrderController::class, 'showByUser'])
    ->middleware(['auth', 'verified'])
    ->name('orders.user_orders');

// Routes requiring admin or government access
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('orders/send-order', [OrderController::class, 'showSendOrderForm'])
        ->middleware('admin.or.government')
        ->name('orders.send-order-form');
    
    Route::post('orders/send-email', [OrderController::class, 'sendOrderEmail'])
        ->middleware('admin.or.government')
        ->name('orders.send-email');
    
    Route::get('weapons/create', [WeaponController::class, 'create'])
        ->middleware('admin.or.government')
        ->name('weapons.create');
    
    Route::post('weapons/store', [WeaponController::class, 'store'])
        ->middleware('admin.or.government')
        ->name('weapons.store');
    
    Route::get('weapons/{weapon}/edit', [WeaponController::class, 'edit'])
        ->middleware('admin.or.government')
        ->name('weapons.edit');
    
    Route::put('weapons/{weapon}', [WeaponController::class, 'update'])
        ->middleware('admin.or.government')
        ->name('weapons.update');
});

Route::get('weapons/show/{weapon}', [WeaponController::class, 'show'])
    ->middleware(['auth', 'verified'])
    ->name('weapons.show');
Route::post('carts/add/{weapon}', [CartController::class, 'addToCart'])
    ->middleware(['auth', 'verified'])
    ->name('cart.add');
Route::delete('cart/remove/{order}', [CartController::class, 'remove'])
    ->middleware(['auth', 'verified'])
    ->name('cart.remove');
Route::delete('cart/clear', [CartController::class, 'clear'])
    ->middleware(['auth', 'verified'])
    ->name('cart.clear');
Route::post('cart/checkout', [CartController::class, 'checkout'])
    ->middleware(['auth', 'verified'])
    ->name('cart.checkout');

Route::post('user/add-funds', [UserCashController::class, 'addFunds'])
    ->middleware(['auth', 'verified'])
    ->name('user.add-funds');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
