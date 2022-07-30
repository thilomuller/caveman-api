<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CaveController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

// Users: Public Route
Route::post('/user/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function() {
    
    //Users
    Route::post('/user/register', [UserController::class, 'register']);
    Route::post('/user/logout'  , [UserController::class, 'logout']);

    //Caves
    Route::get('/cave', [CaveController::class, 'index']);
    Route::get('/cave/{id}', [CaveController::class, 'show']);
    Route::put('/cave', [CaveController::class, 'store']);
    Route::delete('/cave/{id}', [CaveController::class, 'destroy']);
    Route::post('/cave/find', [CaveController::class, 'find']);
    Route::put('/cave/{id}', [CaveController::class, 'update']);
});
