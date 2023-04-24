<?php

use App\Http\Controllers\Admin\ManagementAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function(){
        return view('layout.master');
})->name('index');

Route::group([
    'as' => 'users.',
    'prefix' => 'users/'
], function(){
    Route::get('/', [UserController::class,'index'])->name('index');
//    Route::get('/{user}', [UserController::class,'show'])->name('show');
    Route::get('/edit/{user}', [UserController::class,'edit'])->name('edit');
    Route::post('/edit/{user}', [UserController::class,'update'])->name('update');
    Route::delete('/{user}', [UserController::class,'destroy'])->name('destroy');
});

Route::group([
    'as' => 'posts.',
    'prefix' => 'posts/'
], function(){
    Route::get('/', [PostController::class,'index'])->name('index');
    Route::get('create', [PostController::class,'create'])->name('create');
    Route::post('create', [PostController::class,'store'])->name('store');
//    Route::get('/{user}', [UserController::class,'show'])->name('show');
//    Route::delete('/{user}', [UserController::class,'destroy'])->name('destroy');
});

Route::group([
    'as' => 'managements.',
    'prefix' => 'managements/'
], function(){
    Route::get('/', [ManagementAdminController::class,'index'])->name('index');
    Route::get('/create', [ManagementAdminController::class,'create'])->name('create');
    Route::post('/create', [ManagementAdminController::class,'store'])->name('store');
});
