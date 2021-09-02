<?php

use App\Http\Controllers\AdminPageController;
use App\Http\Controllers\SingerController;
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
    Route::get('/',[SingerController::class,'getAll'])->name('home');
    Route::get('/create',[AdminPageController::class,'createSinger'])->name('create');
    Route::get('/search',[SingerController::class,'search'])->name('search');
    Route::get('/{id}/delete',[SingerController::class,'delete'])->name('delete');
    Route::get('/{id}/edit',[SingerController::class,'edit'])->name('edit');
    Route::post('/{id}/update',[SingerController::class,'update'])->name('update');
});
