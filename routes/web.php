<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /**
     * register tenant
     */

    Route::
        get('/register-new-tenant', [\App\Http\Controllers\RegisteredTenantController::class, 'create'])
        ->name('register-new-tenant');

    Route::
        post('/register-tenant', [\App\Http\Controllers\RegisteredTenantController::class, 'store'])
        ->name('register-new-tenant-post');;
});

require __DIR__.'/auth.php';
