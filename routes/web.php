<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\QuotationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| Locale Switch
|--------------------------------------------------------------------------
*/

Route::get(
    '/locale/{locale}',
    [LocaleController::class, 'switch']
)->name('locale.switch');

/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get(
        '/',
        [DashboardController::class, 'index']
    )->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | Customers
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/ajax/customers',
        [CustomerController::class, 'search']
    )->name('customers.search');

    Route::post(
        '/customers/{id}/restore',
        [CustomerController::class, 'restore']
    )->name('customers.restore');

    Route::resource(
        'customers',
        CustomerController::class
    );

    Route::resource(
        'products',
        ProductController::class
    )->except(['show']);

    Route::get(
        '/settings/company',
        [SettingController::class, 'editCompany']
    )->name('settings.company.edit');

    Route::put(
        '/settings/company',
        [SettingController::class, 'updateCompany']
    )->name('settings.company.update');

    /*
    |--------------------------------------------------------------------------
    | Quotations
    |--------------------------------------------------------------------------
    */

    Route::get(
        '/quotations/{quotation}/preview',
        [QuotationController::class, 'preview']
    )->name('quotations.preview');

    Route::get(
        '/quotations/{quotation}/download',
        [QuotationController::class, 'download']
    )->name('quotations.download');

    Route::resource(
        'quotations',
        QuotationController::class
    );
});

/*
|--------------------------------------------------------------------------
| Breeze Auth Routes
|--------------------------------------------------------------------------
*/

require __DIR__.'/auth.php';