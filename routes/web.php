<?php

use Illuminate\Support\Facades\Route;

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

Route::prefix('admin')->group(function (){
    Route::get('/',[\App\Http\Controllers\AdminPageController::class,'home'])->name('home');
});
Route::prefix('song')->group(function (){
    Route::get('list',[\App\Http\Controllers\SongController::class,'index'])->name('song.list');
    Route::get('add',[\App\Http\Controllers\SongController::class,'create'])->name('song.add');
    Route::post('store',[\App\Http\Controllers\SongController::class,'store'])->name('song.store');
    Route::get('{id}/delete',[\App\Http\Controllers\SongController::class,'destroy'])->name('song.delete');
    Route::get('{id}/edit',[\App\Http\Controllers\SongController::class,'edit'])->name('song.edit');
    Route::post('{id}/update',[\App\Http\Controllers\SongController::class,'update'])->name('song.update');
});
