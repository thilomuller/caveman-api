<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;
use App\Http\Controllers\CaveController;
use App\Http\Controllers\CountryController;

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
    Route::post('/cave/find', [CaveController::class, 'find']);
    Route::post('/cave/create', [CaveController::class, 'store']);
    Route::post('/cave/update/{id}', [CaveController::class, 'update']);
    Route::post('/cave/get/{id}', [CaveController::class, 'show']);
    Route::post('/cave/delete/{id}', [CaveController::class, 'destroy']);

    //Countries
    Route::post('/country/create', [CountryController::class, 'store']);
    Route::post('/country/update/{id}', [CountryController::class, 'update']);
    Route::post('/country/get/{id}', [CountryController::class, 'show']);
    Route::post('/country/delete/{id}', [CountryController::class, 'destroy']);
    Route::post('/country/find', [CountryController::class, 'find']);

});
