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
Route::prefix('singers')->group(function (){
    Route::get('/',[SingerController::class,'index']);
    Route::post('/add',[SingerController::class,'add']);
});
