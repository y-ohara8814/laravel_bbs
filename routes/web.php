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

// Route::get('/', function () {
//    return view('welcome');
// });

Route::get('/','PostsController@index')->name('top');

//新規投稿画面の表示および投稿実行(使用するのは作成、DBへのインサート、詳細表示、投稿編集、投稿更新)
Route::resource('posts','PostsController',['only' => ['create','store','show','edit','update','destroy']]);

Route::resource('comments','CommentsController',['only' => ['store']]);

Route::get('/sample', function () {
    return view('sample');
});
