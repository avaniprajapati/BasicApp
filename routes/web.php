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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function() {
    Route::delete('categories/mass_destroy', 'CategoriesController@massDestroy')->name('categories.mass_destroy');
    Route::resource('categories', 'CategoriesController');
    Route::delete('products/mass_destroy', 'ProductsController@massDestroy')->name('products.mass_destroy');
    Route::resource('products', 'ProductsController');
});