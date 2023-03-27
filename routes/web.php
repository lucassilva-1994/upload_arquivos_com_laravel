<?php

use App\Http\Controllers\FilesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;

Route::controller(UsersController::class)->group(function(){
    Route::get('/','signIn')->name('signin');
    Route::get('/signup','signup')->name('signup');
    Route::post('/auth','auth')->name('auth');
    Route::post('/create','create')->name('create');
});

Route::middleware('user')->group(function(){
    Route::get('/signout', [UsersController::class,'signOut'])->name('signout');
    Route::controller(FilesController::class)->group(function(){
        Route::get('/file','all')->name('file.all');
        Route::get('/file/list','list')->name('file.list');
        Route::get('/file/new','new')->name('file.new');
        Route::get('/file/download/{id}','download')->name('file.download');
        Route::post('/file/create','create')->name('file.create');
        Route::put('/file/updatestatus/{id}','updateStatus')->name('file.updatestatus');
        Route::delete('/file/delete/{id}','delete')->name('file.delete');
    });
});
