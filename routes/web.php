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

// Admin Dashboard Route

Route::prefix('admin')->group(function (){

    Route::middleware('auth:admin')->group(function (){
        Route::get('/', 'DashboardController@index');

        // Product
        Route::resource('/products', 'ProductController');

        //Order

        Route::resource('/orders','OrderController');

        // Order confirm and Pending action
        Route::get('/confirm/{id}','OrderController@confirm')->name('orders.confirm');

        Route::get('/pending/{id}','OrderController@pending')->name('orders.pending');

        // Users
        Route::resource('/users','UserController');

        // Logout

        Route::get('/logout','AdminUserController@logout');
    });

    // Admin login

    Route::get('/login', 'AdminUserController@index')->name('login');
    Route::post('/login', 'AdminUserController@store');
});


/* Front End Route  */
