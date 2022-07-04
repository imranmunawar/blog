<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login', [LoginController::class, 'login']);
Route::get('/front/cat/all', [CategoryController::class, 'indexAll']);
Route::get('/front/post/all', [PostController::class, 'indexAll']);
Route::get('/front/post/{slug}', [PostController::class, 'indexOne']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::post('/logout', [LoginController::class, 'logout']);
    Route::get('/cat/all', [CategoryController::class, 'index']);
    Route::post('/cat/add', [CategoryController::class, 'store']);
    Route::get('/cat/edit/{id}', [CategoryController::class, 'edit']);
    Route::post('/cat/edit/{id}', [CategoryController::class, 'update']);
    Route::post('/cat/delete/{id}', [CategoryController::class, 'delete']);
    //
    Route::get('/post/all', [PostController::class, 'index']);
    Route::post('/post/add', [PostController::class, 'store']);
    Route::post('/post/delete/{id}', [PostController::class, 'delete']);
});
