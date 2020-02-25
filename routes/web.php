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

Route::group(['as' =>'products','prefix' => 'products'],function(){
	
	route::get('/','ProductController@show')->name('all');
	route::get('/product-view/{slug}','ProductController@singleProduct')->name('single');
	route::get('/add-to-cart/{slug}','ProductController@addToCart')->name('addToCart');
	route::get('/show-add-cart','ProductController@showCart')->name('cart.show');
	route::get('/product-cart-reduce/{slug}','ProductController@reduce')->name('cart.reduce');
	route::get('/product/remove/{slug}','ProductController@remove')->name('cart.remove');
	route::post('/update-product/{slug}','ProductController@updateCart')->name('cart.update');
	route::get('/checkout-form','ProductController@getCheckout')->name('checkout.get');
	route::post('/checkout-post/','ProductController@postCheckout')->name('checkout.post');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['as' =>'admin.','prefix' => 'admin','middleware'=>['auth','admin']], function(){
	
	route::get('/dashboard','AdminController@dashboard')->name('dashboard');
	route::get('/recover-category/{id}','CategoryController@recover')->name('category.recover');
	route::get('/show-trash','CategoryController@trash')->name('trash.show');
	route::delete('/product-trash{id}','ProductController@trash')->name('product.trash');
	route::get('/product-recover{id}','ProductController@recover')->name('product.recover');
	route::get('/retrive-product','ProductController@getTrash')->name('trash.get');
	route::delete('/product/category/{category}','CategoryController@delete')->name('category.delete');
	route::resource('/product','ProductController');
	route::resource('/category','CategoryController');
});
