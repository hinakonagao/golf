<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoomController;

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

//Google認証
Route::get('login/google', 'Auth\LoginController@redirectToGoogle');
Route::get('login/google/callback', 'Auth\LoginController@handleGoogleCallback');

Route::get('/golf', function () {
    return view('top');
})->name("room.top");

Route::get('/golf/new', function () {
    return view('new');
})->name("room.new");

Route::post('/golf/new', 'RoomController@create')->name("room.create");

Route::get('/golf/join', function () {
    return view('join');
})->name("room.join");

Route::post('/golf/join', 'RoomController@join')->name("room.check");

Route::get('/golf/room/{id}', 'RoomController@into')->name("room.into");

Route::post('/golf/room/update', 'RoomPlayerController@update')->name("room.update");
    //Ajaxで実行するメソッドのルーティング

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
