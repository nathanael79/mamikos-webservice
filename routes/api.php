<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\KostController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SearchController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function (){
    Route::post('/login',[LoginController::class, 'authenticate'])->name('login');
    Route::post('/register',[RegisterController::class, 'register'])->name('register');

    Route::group(['middleware' => ['jwt.verify']], function () {
        Route::group(['prefix' => 'kost'], function () {
            Route::get('/', [KostController::class, 'getKostsByUserID'])->name('kost_get_all_by_user_id');
            Route::get('/{id}', [KostController::class, 'getKost'])->name('kost_get_detail');
            Route::post('/', [KostController::class, 'create'])->name('kost_create');
            Route::put('/{id}', [KostController::class, 'update'])->name('kost_update');
            Route::delete('/{id}', [KostController::class, 'delete'])->name('kost_delete');
        });

        Route::group(['prefix' => 'chat'], function (){
            Route::post('/',[ChatController::class,'create'])->name('chat_create');
            Route::put('/{id}',[ChatController::class,'update'])->name('chat_update');
        });
    });

    Route::post('/search', [SearchController::class, 'searchKost'])->name('search_kost');
    Route::get('/kost-all', [KostController::class, 'getKosts'])->name('kosts_user_get');
    Route::get('/kost-detail/{id}', [KostController::class, 'getKost'])->name('kost_user_get_detail');
});
