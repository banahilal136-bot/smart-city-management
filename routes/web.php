<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ReportTypeController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ReportController;

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

    Route::get('/login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'store'])
        ->name('login.store');


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

    Route::post(
        '/logout',
        [AuthenticatedSessionController::class, 'destroy']
    )->name('logout');


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

   /*
|--------------------------------------------------------------------------
| Reports
|--------------------------------------------------------------------------
*/

Route::patch(
    '/reports/{report}/status',
    [ReportController::class, 'updateStatus']
)->name('reports.update-status');

Route::resource('reports', ReportController::class);


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
    | Admin Only Routes
    |--------------------------------------------------------------------------
    */

    Route::middleware('admin')->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Users
        |--------------------------------------------------------------------------
        */

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


        /*
        |--------------------------------------------------------------------------
        | Report Types
        |--------------------------------------------------------------------------
        */

        Route::patch(
            '/report-types/{report_type}/toggle-status',
            [ReportTypeController::class, 'toggleStatus']
        )->name('report-types.toggle-status');

        Route::resource(
            'report-types',
            ReportTypeController::class
        );
    });
});