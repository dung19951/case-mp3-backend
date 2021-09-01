<?php


use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SingerController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('category')->group(function (){
    Route::get('/',[CategoryController::class,'gelAll']);
    Route::post('store',[CategoryController::class,'store']);
    Route::post('{id}/update',[CategoryController::class,'update']);
    Route::delete('{id}/delete',[CategoryController::class,'destroy']);
});
Route::prefix('singer')->group(function (){
    Route::get('/',[SingerController::class,'getAll']);
    Route::post('/store',[SingerController::class,'add']);
    Route::post('{id}/update',[SingerController::class,'update']);
    Route::delete('{id}/delete',[SingerController::class,'destroy']);
});
Route::prefix('song')->group(function (){
    Route::get('list',[\App\Http\Controllers\SongController::class,'index']);
    Route::post('create',[\App\Http\Controllers\SongController::class,'store']);
    Route::post('{id}/update',[\App\Http\Controllers\SongController::class,'update']);
    Route::delete('{id}/{delete}',[\App\Http\Controllers\SongController::class,'destroy']);
});
