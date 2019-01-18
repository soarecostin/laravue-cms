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
        
        
        // Menus (navbars)
        Route::get('/menus/draw', 'Admin\MenusController@draw')->name('admin.menus.draw');
        Route::resource('menus', 'Admin\MenusController')->except(['show'])->names([
            'index' => 'admin.menus.index',
            'create' => 'admin.menus.create',
            'store' => 'admin.menus.store',
            'edit' => 'admin.menus.edit',
            'update' => 'admin.menus.update',
            'destroy' => 'admin.menus.destroy'
        ]);
        
        // Menu Items (navbars)
        Route::get('/menus/{menu}/items/draw', 'Admin\MenuItemsController@draw')->name('admin.menus.items.draw');
        Route::get('/menus/items/{menuItem}/publish', 'Admin\MenuItemsController@on')->name('admin.menus.items.publish');
        Route::get('/menus/items/{menuItem}/unpublish', 'Admin\MenuItemsController@off')->name('admin.menus.items.unpublish');
        
        Route::get('/menus/{menu}/items', 'Admin\MenuItemsController@index')->name('admin.menus.items.index');
        Route::get('/menus/{menu}/items/create', 'Admin\MenuItemsController@create')->name('admin.menus.items.create');
        Route::post('menus/{menu}/items', 'Admin\MenuItemsController@store')->name('admin.menus.items.store');
        Route::get('/menus/items/{menuItem}/edit', 'Admin\MenuItemsController@edit')->name('admin.menus.items.edit');
        Route::put('/menus/items/{menuItem}', 'Admin\MenuItemsController@update')->name('admin.menus.items.update');
        Route::delete('/menus/items/{menuItem}', 'Admin\MenuItemsController@destroy')->name('admin.menus.items.destroy');
        

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