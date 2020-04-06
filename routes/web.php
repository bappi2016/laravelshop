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

// Dashboard
Route::get('/', 'DashboardController@index');

// Product
Route::resource('admin/products', 'ProductController');

//Order

Route::resource('admin/orders','OrderController');

// Order confirm and Pending action
Route::get('/confirm/{id}','OrderController@confirm')->name('orders.confirm');

Route::get('/pending/{id}','OrderController@pending')->name('orders.pending');

// Users
Route::resource('admin/users','UserController');
