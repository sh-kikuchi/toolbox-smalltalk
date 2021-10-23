<?php

Auth::routes();

//ちゃんねる作成
Route::get('/','ChannelController@index')->name('channel.index');
Route::post('channel/store','ChannelController@store')->name('channel.store');
Route::post('channel/join','ChannelController@join')->name('channel.join');
Route::get('channel/destroy/{channel}','ChannelController@destroy')->name('channel.destroy'); //削除する
Route::get('channel/delete/{channel}','ChannelController@delete')->name('channel.delete');   //退会する

//グループトーク(CRUD)
Route::get('chat/show/{channel}','ChatController@show')->name('chat.show');
Route::post('chat/store','ChatController@store')->name('chat.store');
Route::post('chat/edit','ChatController@edit')->name('chat.edit');
Route::get('chat/destroy/{channel}/{chat}','ChatController@destroy')->name('chat.destroy');

//コメント(CRUD)
Route::get('comment/show/{chat}','CommentController@show')->name('comment.show');
Route::post('comment/store','CommentController@store')->name('comment.store');
Route::post('comment/edit','CommentController@edit')->name('comment.edit');
Route::get('comment/destroy/{chat}/{comment}','CommentController@destroy')->name('comment.destroy');

//「ひとりごと」
Route::get('note/show','NoteController@show')->name('note.show');
Route::post('note/store','NoteController@store')->name('note.store');
Route::post('note/edit','NoteController@edit')->name('note.edit');
Route::get('note/destroy/{note}','NoteController@destroy')->name('note.destroy');

//プロフィール
Route::get('profile/show','UserController@show')->name('profile.show');
Route::post('profile/edit','UserController@edit') ->name('profile.edit');

//ユーザーリスト（検索）
Route::get('user/index/{channel}','UserController@index')->name('user.index');
Route::post('user/search/{channel}','UserController@search')->name('user.search');
Route::post('user/admin/{channel}','UserController@admin')->name('user.admin');
