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
        
        // Pages
        Route::get('/pages/draw', 'Admin\PagesController@draw')->name('admin.pages.draw');
        Route::get('/pages/{page}/publish', 'Admin\PagesController@on')->name('admin.pages.publish');
        Route::get('/pages/{page}/unpublish', 'Admin\PagesController@off')->name('admin.pages.unpublish');
        Route::resource('pages', 'Admin\PagesController')->except(['show'])->names([
            'index' => 'admin.pages.index',
            'create' => 'admin.pages.create',
            'store' => 'admin.pages.store',
            'edit' => 'admin.pages.edit',
            'update' => 'admin.pages.update',
            'destroy' => 'admin.pages.destroy'
        ]);
        
        // Page Sections
        Route::get('/pages/{page}/sections/draw', 'Admin\PageSectionsController@draw')->name('admin.pages.sections.draw');
        Route::get('/pages/sections/{pageSection}/publish', 'Admin\PageSectionsController@on')->name('admin.pages.sections.publish');
        Route::get('/pages/sections/{pageSection}/unpublish', 'Admin\PageSectionsController@off')->name('admin.pages.sections.unpublish');
        Route::post('/pages/sections/{pageSection}/save-order', 'Admin\PageSectionsController@saveOrder')->name('admin.pages.sections.saveOrder');
        
        Route::get('/pages/{page}/sections', 'Admin\PageSectionsController@index')->name('admin.pages.sections.index');
        Route::get('/pages/{page}/sections/create', 'Admin\PageSectionsController@create')->name('admin.pages.sections.create');
        Route::post('/pages/{page}/sections', 'Admin\PageSectionsController@store')->name('admin.pages.sections.store');
        Route::get('/pages/sections/{pageSection}/edit', 'Admin\PageSectionsController@edit')->name('admin.pages.sections.edit');
        Route::put('/pages/sections/{pageSection}', 'Admin\PageSectionsController@update')->name('admin.pages.sections.update');
        Route::delete('/pages/sections/{pageSection}', 'Admin\PageSectionsController@destroy')->name('admin.pages.sections.destroy');
        
        
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