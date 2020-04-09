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
    Route::get('/','Front\HomeController@index');

    // User registration
Route::get('/user/registration','Front\RegistrationController@index');
Route::post('/user/registration','Front\RegistrationController@store');

// User Login
Route::get('/user/login','Front\SessionController@index');
Route::post('/user/login','Front\SessionController@store');

// User Logout
Route::get('/user/logout','Front\SessionController@logout');

Route::get('/user/profile','Front\UserProfileController@index');
Route::get('user/order/{id}','Front\UserProfileController@show');


// Cart
Route::get('/cart','Front\CartController@index');
Route::post('/cart','Front\CartController@store')->name('cart');

// Destroy Cart
Route::get('/cart/empty',function (){
    Cart::instance('default')->destroy();
});



Route::delete('/cart/remove/{product}','Front\CartController@destroy')->name('cart.destroy');

Route::post('/cart/saveLater/{product}','Front\CartController@saveLater')->name('cart.saveLater');


// Save for later
Route::delete('/saveLater/destroy/{product}','Front\SaveLaterController@destroy')->name('saveLater.destroy');
Route::post('/cart/moveToCart/{product}','Front\SaveLaterController@moveToCart')->name('moveToCart');
