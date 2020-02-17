<?php

use App\Product;

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
    $products = Product::orderBy('created_at','desc')->paginate(6);
    return view('mine', compact('products'));
    
});

Route::get('mine', function(){
    return view('mine');
});


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('showProduct/{product)', "ProductController@show");
Route::resource('products','ProductController');


Route::resource('bids','BidController');



//redirecting to index when the link is not found
Route::get('{path}',"HomeController@index")->where('path','([A-Z\d-\/_.]+)?' );

