<?php

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

Auth::routes();

Route::middleware('auth')->group(function () {
    // Frontend routes
    Route::prefix('front')->as('front.')->group(function () {
        // Nothing here yet
    });

    // Backend routes
    Route::prefix('back')->as('back.')->group(function () {
        // General routines
        Route::controller(App\Http\Controllers\Back\GeneralController::class)->group(function () {
            Route::post('/general/setValueDB', 'setValueDB')->name('general.setValueDB');
            Route::post('/general/setValueSession', 'setValueSession')->name('general.setValueSession');
            Route::get('/general/getDatatablesHelp', 'getDatatablesHelp')->name('general.getDatatablesHelp');
        });
        /* ---------------------------------------- */
        // Developer
        Route::controller(App\Http\Controllers\Back\DeveloperController::class)->group(function () {
            Route::get('/developer/hashGenerator', 'hashGenerator')->name('developer.hashGenerator');
            Route::get('/developer/impressum', 'impressum')->name('developer.impressum');
            Route::get('/developer/session', 'session')->name('developer.session');
        });
        /* ---------------------------------------- */
        // Backups
        Route::controller(App\Http\Controllers\Back\BackupController::class)->group(function () {
            Route::get('/backups', 'index')->name('backups.index');
            Route::get('/backups/create', 'create')->name('backups.create');
            Route::get('/backups/download/{file_name}', 'download')->name('backups.download');
            Route::get('/backups/delete/{file_name}', 'delete')->name('backups.delete');
        });
        /* ------------------------------------------------------------------------ */
        // Users
        Route::controller(App\Http\Controllers\Back\UserController::class)->group(function () {
            Route::get('/users/getUserlogs', 'getUserlogs')->name('users.getUserlogs');
            Route::delete('/users/massDestroy', 'massDestroy')->name('users.massDestroy');

            Route::resource('/users', App\Http\Controllers\Back\UserController::class)->except(['show', 'destroy']);
        });

        // Users log
        Route::controller(App\Http\Controllers\Back\UserlogController::class)->group(function () {
            Route::get('/userslog/index', 'index')->name('userslog.index');
            Route::get('/userslog/statsCountry', 'statsCountry')->name('userslog.statsCountry');
            Route::get('/userslog/statsPeriode', 'statsPeriode')->name('userslog.statsPeriode');
        });
        /* ---------------------------------------- */
        // Customers
        Route::controller(App\Http\Controllers\Back\CustomerController::class)->group(function () {
            Route::delete('/customers/massDestroy', 'massDestroy')->name('customers.massDestroy');
            Route::get('/customers/getAlikes', 'getAlikes')->name('customers.getAlikes');

            Route::resource('/customers', App\Http\Controllers\Back\CustomerController::class)->except(['destroy']);
        });
    });
});
