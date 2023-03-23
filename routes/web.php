<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::controller(UsersController::class)->group(function(){
    Route::get('/','signIn')->name('signin');
    Route::get('/signup','signup')->name('signup');
    Route::post('/auth','auth')->name('auth');
    Route::post('/create','create')->name('create');
});
