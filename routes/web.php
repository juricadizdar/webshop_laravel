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

Route::get('/', ['uses'=>'ProductsController@index', 'as'=>'allproducts']);

Route::get('products', ['uses'=>'ProductsController@index', 'as'=>'allproducts']);

Route::get('products', ['uses'=>'ProductsController@indexAll', 'as'=>'allProducts']);
Route::get('products/{id}', ['uses'=>'ProductsController@show', 'as'=>'singleProduct']);

// about page
Route::get('about', ['uses'=>'ProductsController@about', 'as'=>'about']);

// contact page
Route::get('contact', ['uses'=>'ProductsController@contact', 'as'=>'contact']);

//search products
Route::get('search', ['uses'=>'ProductsController@search', 'as'=>'searchProducts']);

Route::get('product/addToCart/{id}', ['uses'=>'ProductsController@addToCart', 'as'=>'addToCart']);

// show cart item
Route::get('cart', ['uses'=>'ProductsController@showCart', 'as'=>'cartproducts']);

// show cart item
Route::get('product/deleteFromCart/{id}', ['uses'=>'ProductsController@deleteFromCart', 'as'=>'deleteFromCart']);


// increase product
Route::get('product/increaseProduct/{id}', ['uses'=>'ProductsController@increaseProduct', 'as'=>'increaseProduct']);

// decrease product
Route::get('product/decreaseProduct/{id}', ['uses'=>'ProductsController@decreaseProduct', 'as'=>'decreaseProduct']);


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Admin panel routes
Route::prefix('admin')->group(function (){
	
	Route::resource('products', 'Admin\ProductsController')->middleware('restricted');
	Route::resource('users', 'Admin\UsersController')->middleware('restricted');
	Route::resource('orders', 'Admin\OrdersController')->middleware('restricted');
	
});

// Orders
Route::prefix('order')->group(function (){

	Route::resource('orders', 'Order\OrdersController')->middleware('auth');
	Route::get('payment', 'Payment\PaymentsController@index')->middleware('auth');
	
});	

// Payments
Route::prefix('order')->group(function (){

	Route::resource('payments', 'Payment\PaymentsController')->middleware('auth');
	
});
	