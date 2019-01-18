<?php

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

Route::prefix('admin')->group(function () {
    
    // Authentication Routes
    Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
    Route::post('login', 'Admin\Auth\LoginController@login');
    Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
    
    // Restricted access to admin control panel to logged in admins only
    Route::middleware(['auth:admin'])->group(function () {
        
        // Admin Dashboard
        Route::get('/', 'Admin\DashboardController@index')->name('admin.dashboard');
        
    });
});

Route::prefix('user')->group(function () {

    // Authentication Routes...
    Route::get('login', 'User\Auth\LoginController@showLoginForm')->name('login');
    Route::post('login', 'User\Auth\LoginController@login');
    Route::post('logout', 'User\Auth\LoginController@logout')->name('logout');

    // Registration Routes...
    Route::get('register', 'User\Auth\RegisterController@showRegistrationForm')->name('register');
    Route::post('register', 'User\Auth\RegisterController@register');

    Route::get('password/reset', 'User\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
    Route::post('password/email', 'User\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
    Route::get('password/reset/{token}', 'User\Auth\ResetPasswordController@showResetForm')->name('password.reset');
    Route::post('password/reset', 'User\Auth\ResetPasswordController@reset')->name('password.update');
    Route::get('email/verify', 'User\Auth\VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{id}', 'User\Auth\VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'User\Auth\VerificationController@resend')->name('verification.resend');

    Route::middleware(['auth', 'verified'])->group(function () {
        // Registered users
        
        Route::get('/', 'User\DashboardController@index')->name('user.dashboard');
        
    });
});

Route::get('/', function () {
    return view('layouts.main.app');
});