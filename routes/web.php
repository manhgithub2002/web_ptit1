<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\CheckLoginMiddleware;
use Illuminate\Support\Facades\Route;

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'processLogin'])->name('process_login');
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'registering'])->name('registering');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
//Route::group([
//    'middleware' => CheckLoginMiddleware::class,
//], function(){
//    Route::get('/', function(){
//        return view('layout.master');
//    })->name('welcome');
//    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
//});
