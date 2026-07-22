<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


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
| Personal Profile
|--------------------------------------------------------------------------
*/

Route::get(
    '/profile',
    [UserController::class, 'profile']
)->name('profile.show');


Route::get(
    '/profile/edit',
    [UserController::class, 'editProfile']
)->name('profile.edit');


Route::put(
    '/profile',
    [UserController::class, 'updateProfile']
)->name('profile.update');


    /*
|--------------------------------------------------------------------------
| Users - Admin Only
|--------------------------------------------------------------------------
*/

Route::middleware('admin')->group(function () {
    Route::patch(
    '/users/{user}/toggle-status',
    [UserController::class, 'toggleStatus']
)->name('users.toggle-status');

    Route::resource('users', UserController::class)
        ->only([
            'index',
            'create',
            'store',
            'show',
            'edit',
            'update',
        ]);
});

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