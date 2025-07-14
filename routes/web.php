<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WeaponController;
use App\Http\Controllers\OrderController;

Route::get('/', function ()
{
    return view('welcome');
})->name('home');


Route::get('/England', function () // 1
{
    return view('England');
})->name('England');

Route::get('/Soviet_Union', function () // 2
{
    return view('Soviet_Union');

})->name('Soviet_Union');

Route::get('/Germany', function () // 3
{
    return view('Germany');

})->name('Germany');

Route::resource('orders', OrderController::class);


Route::get('/Switzerland', function ()
{
    return view('Switzerland');
})->name('Switzerland');

Route::get('/emails/qr',[QrCodeController::class,'convertCsvToQr'])
    ->middleware(['auth','verified'])
    ->name('emails.qr');
Route::get('cart', [CartController::class, 'index'])
    ->middleware(['auth'])
    ->name('cart');
Route::get('/weapons/index', [WeaponController::class, 'index'])
    ->middleware(['auth'])
    ->name('weapons.index'); 
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
