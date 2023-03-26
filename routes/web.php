<?php

use App\Http\Controllers\UploadsController;
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
    Route::controller(UploadsController::class)->group(function(){
        Route::get('/upload','all')->name('upload.all');
        Route::get('/upload/list','list')->name('upload.list');
        Route::get('/upload/new','new')->name('upload.new');
        Route::get('/upload/download/{id}','download')->name('upload.download');
        Route::post('/upload/create','create')->name('upload.create');
        Route::put('/upload/update/{id}','update')->name('upload.update');
        Route::put('/upload/updatestatus/{id}','updateStatus')->name('upload.updatestatus');
        Route::delete('/upload/delete/{id}','delete')->name('upload.delete');
    });
});
