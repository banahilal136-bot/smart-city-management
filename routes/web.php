<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Authentication Pages
|--------------------------------------------------------------------------
*/

// الرابط الرئيسي يفتح صفحة تسجيل الدخول
Route::get('/', function () {
    return redirect()->route('login');
});

// صفحة تسجيل الدخول
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

// صفحة إنشاء حساب جديد
Route::get('/register', function () {
    return view('auth.register');
})->name('register');


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