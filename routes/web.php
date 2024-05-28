<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\ProfileController;

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
    return view('welcome');
});

Route::get('/layout', function () {
    return view('layouts.index');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', [ProfileController::class, 'index'])->name('profile.index');
        Route::post('/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
        Route::post('/upload', [ProfileController::class, 'upload'])->name('profile.upload');
        Route::delete('/revert', [ProfileController::class, 'revert'])->name('profile.revert');
    });

    Route::group(['prefix' => 'chat'], function () {
        Route::get('/', [ChatController::class, 'index'])->name('index.chat');
        Route::get('/kirim-pesan', [ChatController::class, 'kirimPesan'])->name('chat.kirim-pesan');
    });

    Route::group(['prefix' => 'room'], function () {
        Route::get('/cek', [RoomController::class, 'cekRoom'])->name('room.cek');
    });

});
