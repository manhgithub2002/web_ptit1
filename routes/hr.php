<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
    return view('layout.master');
})->name('welcome');

Route::group([], function(){
    Route::get('/', [UserController::class,'index']);
});
Route::group([
    'as' => 'users.',
], function(){
    Route::get('/', [UserController::class,'index'])->name('index');
});
