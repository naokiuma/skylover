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
Route::post('/posts/{id}/delete', 'PostsController@destroy')->name('posts.delete');
Route::post('/posts/gallery', 'PostsController@search')->name('posts.search');//検索
Route::post('/posts/category', 'PostsController@category')->name('posts.category');

//ツイッター関連
// ログインURL
Route::get('auth/twitter', 'Auth\TwitterController@redirectToProvider')->name('auth.twitter');
// コールバックURL
Route::get('auth/twitter/callback', 'Auth\TwitterController@handleProviderCallback')->name('auth.twitter.callback');
// ログアウトURL
Route::get('auth/twitter/logout', 'Auth\TwitterController@logout')->name('auth.twitter.logout');

//お気に入り。ajaxではgetにする。
Route::post('/posts/{post}/favs','FavsController@store')->name('favs.store');
Route::post('/posts/{postId}/favs/{favId}', 'FavsController@destroy')->name('favs.destroy');

//
//クリプトでは
//Route::get('ajax/coin', 'AjaxController@coin')->name('ajax.coin');;
//coin_ajax="{{ url('ajax/coin') }}" これをvueにわたし
//このように表示
//    mounted(){
//        this.showHour();
//        let self = this;
//        let url = this.coin_ajax;
//        axios.get(url).then(function(response){
//          self.coins = response.data;
//          });
//      },
