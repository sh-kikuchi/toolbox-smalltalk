<?php

Auth::routes();

//トップ画面(投稿画面)
Route::get('/','PostController@show')->name('post.show');
Route::post('post/store','PostController@store')->name('post.store');
Route::post('post/edit','PostController@edit')->name('post.edit');
Route::get('post/destroy/{post}','PostController@destroy')->name('post.destroy');

//「ひとりごと」
Route::get('note/show','NoteController@show')->name('note.show');
Route::post('note/store','NoteController@store')->name('note.store');
Route::post('note/edit','NoteController@edit')->name('note.edit');
Route::get('note/destroy/{note}','NoteController@destroy')->name('note.destroy');

//コメント
Route::get('comment/show/{post}','CommentController@show')->name('comment.show');
Route::post('comment/store','CommentController@store')->name('comment.store');
Route::post('comment/edit','CommentController@edit')->name('comment.edit');
Route::get('comment/destroy/{post}/{comment}','CommentController@destroy')->name('comment.destroy');

//プロフィール（自分用）
Route::get('profile/show','UserController@show')->name('profile.show');
Route::post('profile/edit','UserController@edit') ->name('profile.edit');

//プロフィール（相手用）
Route::get('profile/other/{user}','UserController@other')->name('profile.other');

//ユーザー検索(ユーザーリスト)
Route::get('user/index','UserController@index')->name('user.index');
Route::post('user/search','UserController@search')->name('user.search');

//フォロー機能
Route::get('follow/following','FollowController@following')->name('follow.following');
Route::get('follow/follower','FollowController@follower')->name('follow.follower');
Route::post('users/{user}/follow', 'UserController@follow')->name('follow');
Route::delete('users/{user}/unfollow', 'UserController@unfollow')->name('unfollow');
