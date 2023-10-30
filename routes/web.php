<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function() {
    // auth
    Route::get('login', function () {
        return view('vendor.base-templates.auth.login');
    })->name('auth.login');
    Route::get('register', function() {
        return view('vendor.base-templates.auth.register');
    })->name('auth.register');
    Route::get('dashboard', function() {
        return view("vendor.base-templates.dashboard.index");
    })->name('admin.dashboard');
});
