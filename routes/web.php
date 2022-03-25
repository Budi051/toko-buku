<?php

use Illuminate\Support\Facades\Route;

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
    //return view('layout.conquer');
    return view('auth.login');
});

Route::middleware(['auth'])->group(function(){
    Route::get('/catalog', 'FrontEndController@index');
    Route::get('cart', 'FrontEndController@cart');
    Route::get('add-to-cart/{id}', 'FrontEndController@addToCart');

    Route::get('/checkout','OrderController@form_submit_front');
    Route::get('/submit_checkout','OrderController@submit_front')->name('submitcheckout');

    Route::resource('admin/orders','OrderController');
    Route::resource('admin/users','UserController');
    Route::resource('admin/books','BookController');
    Route::resource('admin/book_category','CategoryController');

    Route::post('book/getDataFirst', 'BookController@getDataFirst')->name('book.getDataFirst');
    Route::post('category_book/getDataFirst', 'CategoryController@getDataFirst')->name('category.getDataFirst');

    Route::post('book/changeFoto', 'BookController@changeFoto')->name('book.changeFoto');
});





//Route::resource('books','BookController')->name('books.index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

