<?php

use App\Http\Controllers\CategoryController;
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
    Route::post('{category_id}/update',[CategoryController::class,'update']);
    Route::delete('{category_id}/delete',[CategoryController::class,'destroy']);
});
