<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\QrCodeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\WeaponController;

Route::get('/', function () {
    return view('welcome');
})->name('home');

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
    ->name('market');    

Route::get('/weapons/{id}', [WeaponController::class, 'show'])
->name('weapons.show');
    

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
