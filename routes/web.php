<?php

use App\Auth;
use App\Route;
use Controllers\FilterMessages;
use Controllers\UserStatus;

Route::middleware('auth')->get('/', function () {
    UserStatus::online();
    return view('welcome');
});

Route::get('/logout', function () {
    UserStatus::offline();
    FilterMessages::filterRemovedMessages();
    Auth::logout();
    return redirect('/login');
});

Route::get('/closeBrowser', function () {
    UserStatus::offline();
    FilterMessages::filterRemovedMessages();
});

Route::get('/login', 'Controllers\LoginController@index');
Route::post('/login', 'Controllers\LoginController@login');

Route::get('/register', 'Controllers\RegisterController@index');
Route::post('/create-user', 'Controllers\RegisterController@create');

Route::middleware('auth')->get('/my-profile', 'Controllers\ProfileController@myProfile');

Route::middleware('auth')->post('/change-only-me', 'Controllers\ChangeInfoController@onlyMe');

Route::middleware('auth')->post('/change-pio', 'Controllers\ChangeInfoController@pio');

Route::middleware('auth')->post('/change-name', 'Controllers\ChangeInfoController@name');

Route::middleware('auth')->post('/change-email', 'Controllers\ChangeInfoController@email');

Route::middleware('auth')->post('/change-phone', 'Controllers\ChangeInfoController@phone');

Route::middleware('auth')->post('/change-pass', 'Controllers\ChangeInfoController@pass');

Route::middleware('auth')->post('/change-image', 'Controllers\ChangeInfoController@changeImage');

Route::middleware('auth')->post('/remove-image', 'Controllers\ChangeInfoController@removeImage');

Route::post('/search', 'Controllers\SearchController@search');

Route::middleware('auth')->post('/allChat', 'Controllers\AllChatController@AllChat');

Route::middleware('auth')->post('/loadChat', 'Controllers\LoadChatController@loadChat');

Route::middleware('auth')->post('/send_msg', 'Controllers\SendMsgController@msg');
Route::middleware('auth')->post('/send_file', 'Controllers\SendMsgController@file');

Route::middleware('auth')->post('/delete_chat', 'Controllers\DeleteController@deleteChat');
Route::middleware('auth')->post('/delete_msg_for_me', 'Controllers\DeleteController@deleteForMe');
Route::middleware('auth')->post('/delete_msg_for_everyone', 'Controllers\DeleteController@deleteForEveryone');

Route::middleware('auth')->get('/block/{id}', 'Controllers\BlockController@block');

Route::middleware('auth')->get('/profile/{id}', 'Controllers\ProfileController@index');

Route::middleware('auth')->post('/type-status/{chat_id}', 'Controllers\TypeStatusController@focus');
Route::middleware('auth')->post('/type-status', 'Controllers\TypeStatusController@focusout');

Route::get('/download/{filename}/{downloadname}/{ext}', function ($filename, $downloadname, $ext) {
    header('Content-Disposition: attachment; filename="' . $downloadname . '.' . $ext . '"');
    readfile('assets/chatUploads/' . $filename . '.' . $ext);
});

Route::post('/display', 'Controllers\DisplayController@display');
