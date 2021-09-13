<?php


use App\Http\Controllers\api\LikeController;
use App\Http\Controllers\api\SingerApiController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PlaylistController;
use App\Http\Controllers\SingerController;
use App\Http\Controllers\SongController;
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


Route::prefix('song')->group(function () {
    Route::get('list', [SongController::class, 'index']);
    Route::get('new', [SongController::class, 'show5']);
});

Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
Route::post('forgot', [UserController::class, 'forgot']);
Route::post('reset', [UserController::class, 'reset']);
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('logout', [UserController::class, 'logout']);
    Route::prefix('users')->group(function () {
        Route::get('/{id}', [UserController::class, 'getUserProfileById']);
        Route::post('/{id}/update', [UserController::class, 'updateUser']);
        Route::post('/{id}/delete', [UserController::class, 'getUserProfileById']);
        Route::post('/change-password', [UserController::class, 'changepassword']);
    });
    Route::prefix('song')->group(function () {
        Route::post('create', [SongController::class, 'store']);
        Route::get('{id}/my-song', [SongController::class, 'mySong']);
        Route::post('{id}/update', [SongController::class, 'update']);
        Route::delete('{id}/delete', [SongController::class, 'destroy']);
        Route::get('{id}/find-song', [SongController::class, 'findSongById']);
    });
    Route::post('/store', [SingerApiController::class, 'store']);
    Route::prefix('playlist')->group(function (){
        Route::post('create',[PlaylistController::class,'create']);
        Route::get('{id}/show',[PlaylistController::class,'getPlaylistByUserId']);
        Route::delete('{id}/delete',[PlaylistController::class,'delete']);
        Route::get('{id}/edit',[PlaylistController::class,'edit']);
        Route::post('{id}/update',[PlaylistController::class,'update']);
        Route::get('{id}/song',[PlaylistController::class,'songOfPlaylist']);
        Route::delete('{id}/{song_id}/remove-song',[PlaylistController::class,'removeSong']);
        Route::post('{id}/{song_id}/add-song',[PlaylistController::class,'addSong']);
        Route::get('{id}/count',[PlaylistController::class,'countSongPlaylist']);
        Route::get('{id}/my-playlist',[PlaylistController::class,'countPlaylistUser']);
    });
    Route::prefix('comment')->group(function (){
        Route::post('create',[CommentController::class,'create']);
        Route::delete('{id}/delete',[CommentController::class,'delete']);
    });
    Route::prefix('like')->group(function (){
        Route::post('{id}/like',[LikeController::class,'like']);
    });


});

Route::prefix('category')->group(function () {
    Route::get('/', [CategoryController::class, 'gelAll']);
    Route::post('store', [CategoryController::class, 'store']);
    Route::post('{id}/update', [CategoryController::class, 'update']);
    Route::delete('{id}/delete', [CategoryController::class, 'destroy']);
});
Route::prefix('singer')->group(function () {
    Route::get('/', [SingerApiController::class, 'getAllSinger']);
    Route::post('/update/{id}', [SingerApiController::class, 'updateSinger']);
    Route::delete('/delete/{id}', [SingerApiController::class, 'deleteSinger']);
    Route::get('detail/{id}', [SingerApiController::class, 'singerDetail']);
    Route::get('songs/{id}', [SingerApiController::class, 'getListSongBySinger']);
    Route::get('/find/', [SingerApiController::class, 'findSinger']);
});
Route::get('/',[SingerApiController::class,'getAllSinger']);
Route::get('songs/{id}',[SingerApiController::class,'getListSongBySinger']);
Route::get('detail/{id}',[SingerApiController::class,'singerDetail']);
Route::get('/',[CategoryController::class,'gelAll']);
Route::prefix('comment')->group(function (){
    Route::get('{id}/get-comment',[CommentController::class,'findCommentByPlaylistId']);
});
Route::get('all-playlist',[PlaylistController::class,'getAll']);
