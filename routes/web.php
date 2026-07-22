<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return auth()->check()
        ? redirect()->route('dashboard')
        : redirect()->route('login');
});


/*
|--------------------------------------------------------------------------
| Guest Authentication Routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');


    // Register
    Route::get('/register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('/register', [RegisteredUserController::class, 'store'])
        ->name('register.store');
});


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');


    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return view('dashboard.index');
    })->name('dashboard');


    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */

    Route::get('/reports', function () {
        return view('reports.index');
    })->name('reports.index');

    Route::get('/reports/create', function () {
        return view('reports.create');
    })->name('reports.create');

    Route::get('/reports/{id}/edit', function ($id) {
        return view('reports.edit');
    })->name('reports.edit');

    Route::get('/reports/{id}', function ($id) {
        return view('reports.show');
    })->name('reports.show');


    /*
    |--------------------------------------------------------------------------
    | Map
    |--------------------------------------------------------------------------
    */

    Route::get('/map', function () {
        return view('map.index');
    })->name('map.index');


    /*
    |--------------------------------------------------------------------------
    | Users
    |--------------------------------------------------------------------------
    */

    Route::get('/users', function () {
        return view('users.index');
    })->name('users.index');

    Route::get('/users/create', function () {
        return view('users.create');
    })->name('users.create');

    Route::get('/users/{id}/edit', function ($id) {
        return view('users.edit');
    })->name('users.edit');

    Route::get('/users/{id}', function ($id) {
        return view('users.show');
    })->name('users.show');


    /*
    |--------------------------------------------------------------------------
    | Report Types
    |--------------------------------------------------------------------------
    */

    Route::get('/report-types', function () {
        return view('report_types.index');
    })->name('report-types.index');

    Route::get('/report-types/create', function () {
        return view('report_types.create');
    })->name('report-types.create');

    Route::get('/report-types/{id}/edit', function ($id) {
        return view('report_types.edit');
    })->name('report-types.edit');
});