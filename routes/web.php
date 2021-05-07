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

Auth::routes();

//トップ画面(投稿画面)
Route::get('/','PostController@show')->name('post.show');
Route::post('post/store','PostController@store')->name('post.store');
Route::post('post/edit','PostController@edit')->name('post.edit');
Route::get('post/destroy/{id}','PostController@destroy')->name('post.destroy');

//「ひとりごと」
Route::get('note/show','NoteController@show')->name('note.show');
Route::post('note/store','NoteController@store')->name('note.store');
Route::post('note/edit','NoteController@edit')->name('note.edit');
Route::get('note/destroy/{id}','NoteController@destroy')->name('note.destroy');

//プロフィール（自分用）
Route::get('profile/show','UserController@show')->name('profile.show');
Route::post('profile/edit','UserController@edit') ->name('profile.edit');
Route::get('profile/destroy/{id}','UserController@destroy') ->name('profile.destroy');

//プロフィール（相手用）
Route::get('profile/other/{id}','UserController@other')->name('profile.other');

//ユーザー検索(ユーザーリスト)
Route::get('user/index','UserController@index')->name('user.index');
Route::post('user/search','UserController@search')->name('user.search');

//フォロー機能
Route::get('follow/following','FollowController@following')->name('follow.following');
Route::get('follow/followed','FollowController@followed')->name('follow.followed');
Route::post('users/{id}/follow', 'UserController@follow')->name('follow');
Route::delete('users/{id}/unfollow', 'UserController@unfollow')->name('unfollow');
