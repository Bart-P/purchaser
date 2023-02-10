<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuppliersController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Auth/Login', [
        'canLogin'       => Route::has('login'),
        'canRegister'    => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion'     => PHP_VERSION,
    ]);
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        return Inertia::render('Dashboard');
    })->name('dashboard');

    // INQUIRIES
    Route::get('/inquiries', function () {
        return Inertia::render('Inquiries/Inquiries');
    })->name('inquiries');

    // SUPPLIERS
    Route::get('/suppliers',
               [
                   SuppliersController::class,
                   'index',
               ])->name('suppliers');
    Route::get('/suppliers/create',
               [
                   SuppliersController::class,
                   'create',
               ])->name('suppliers.create');
    Route::get('/suppliers/edit/{id}',
               [
                   SuppliersController::class,
                   'edit',
               ])->name('suppliers.edit');
    Route::post('/suppliers/store',
                [
                    SuppliersController::class,
                    'store',
                ])->name('suppliers.store');
    Route::delete('/suppliers/{id}',
                  [
                      SuppliersController::class,
                      'destroy',
                  ])->name('suppliers.destroy');
    Route::put('/suppliers',
               [
                   SuppliersController::class,
                   'update',
               ])->name('suppliers.put');

    // ADDRESSES
    Route::get('/addresses/create',
               [
                   AddressController::class,
                   'create',
               ])->name('addresses.create');
    Route::post('/addresses/store',
                [
                    AddressController::class,
                    'store',
                ])->name('addresses.store');

    // PERSONS
    Route::get('/persons/create',
               [
                   PersonController::class,
                   'create',
               ])->name('persons.create');
    Route::post('/persons/store',
                [
                    PersonController::class,
                    'store',
                ])->name('persons.store');

    // USER PROFILE
    Route::get('/profile',
               [
                   ProfileController::class,
                   'edit',
               ])->name('profile.edit');
    Route::patch('/profile',
                 [
                     ProfileController::class,
                     'update',
                 ])->name('profile.update');
    Route::delete('/profile',
                  [
                      ProfileController::class,
                      'destroy',
                  ])->name('profile.destroy');
});

require __DIR__ . '/auth.php';