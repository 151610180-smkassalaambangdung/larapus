<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/



Auth::routes();
Route::get('/', 'GuestController@index');
Route::get('/home', 'HomeController@index');
Route::resource('/lara', 'MiddlewareController@iya');
Route::group(['prefix'=>'admin', 'middleware'=>['auth']], function () {
	Route::resource('authors','AuthorsController') ;
	Route::resource('books', 'BooksController');
});

Route::get('books/{book}/borrow',[
		'middleware' => ['auth', 'role:member'],

		'as' => 'guest.books.borrow',
		'uses' => 'BooksController@borrow' 

]);

Route::put('books/{book}/return',[
		'middleware' => ['auth', 'role:member'],

		'as' => 'member.books.return',
		'uses' => 'BooksController@returnBack'
]);

ROute::get('Auth/verify/{token}','Auth\REgisterController@verify');