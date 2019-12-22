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
Route::get('/', function () {
    return view('top');
});
*/



Auth::routes();
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/news', 'PostsController@news');
Route::get('/', 'PostsController@index');
Route::get('/posts/gallery','PostsController@gallery')->name('posts.gallery');
Route::get('/posts/category','PostsController@category')->name('posts.category');

Route::get('/posts/{id}','PostsController@show')->name('posts.show');
Route::get('/new', 'PostsController@new')->middleware('check')->name('new');

Route::get('/{id}/edit','PostsController@edit')->middleware('check');
Route::post('/posts', 'PostsController@create')->name('posts.create');
Route::post('/posts/gallery', 'PostsController@search')->name('posts.search');//検索
Route::post('/posts/category', 'PostsController@category')->name('posts.category');
