<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WeaponController;

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

Route::get('/Switzerland', function () // 4
{
    return view('Switzerland');
})->name('Switzerland');

Route::get('/emails/qr',[QrCodeController::class,'convertCsvToQr'])
    ->middleware(['auth','verified'])
    ->name('emails.qr');
Route::get('cart', [CartController::class, 'index'])
    ->middleware(['auth'])
    ->name('cart');

Route::get('/market/national', [WeaponController::class, 'nationalMarket'])
    ->middleware(['auth'])
    ->name('market');

Route::get('/market/international', [WeaponController::class, 'internatinalMarket'])
    ->middleware(['auth'])
  
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
