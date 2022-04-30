<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParameterTypeController;

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

Route::middleware('auth:sanctum')->group(function() {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::get('/param-types', [ParameterTypeController::class, 'index']);
    Route::post('/param-types', [ParameterTypeController::class, 'store']);
    Route::delete('/param-types/{id}', [ParameterTypeController::class, 'destroy']);
    
});


Route::post('/login', [LoginController::class, 'authenticate']);
