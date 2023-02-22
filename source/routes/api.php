<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use  App\Http\Controllers\AuthController;
use  App\Http\Controllers\LinebotController;
use  App\Http\Controllers\MessageController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/linebot-reply',[LinebotController::class,'reply']);

// 將需要帶 Token 才能使用的 API 放在下面的 Route::group
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    // 新增 message
    Route::post('/messages',[MessageController::class,'store']);
    // 修改 message
    Route::put('/messages/{messageId}',[MessageController::class,'update']);
    // 刪除 message
    Route::delete('/messages/{messageId}',[MessageController::class,'destroy']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
