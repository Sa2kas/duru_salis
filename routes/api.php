<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdditionalParamController;
use App\Http\Controllers\AdditionalParamTypeController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DecorationController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\DoorAdditionalParamController;
use App\Http\Controllers\DoorController;
use App\Http\Controllers\DoorParameterController;
use App\Http\Controllers\DoorTypeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PanelController;
use App\Http\Controllers\ParameterTypeController;
use App\Http\Controllers\ParameterController;
use App\Http\Controllers\PatternController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\UserController;

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

    Route::get('/users', [UserController::class, 'index']);
    Route::post('/users', [UserController::class, 'store']);
    Route::delete('/users/{id}', [UserController::class, 'destroy']);

    Route::get('/param-types', [ParameterTypeController::class, 'index']);
    Route::post('/param-types', [ParameterTypeController::class, 'store']);
    Route::delete('/param-types/{id}', [ParameterTypeController::class, 'destroy']);
    
    Route::get('/params', [ParameterController::class, 'index']);
    Route::post('/params', [ParameterController::class, 'store']);
    Route::delete('/params/{id}', [ParameterController::class, 'destroy']);
});
Route::get('/param-types', [ParameterTypeController::class, 'index']);
Route::get('/params', [ParameterController::class, 'index']);

    Route::get('/additional-params', [AdditionalParamController::class, 'index']);
    Route::post('/additional-params', [AdditionalParamController::class, 'store']);
    Route::delete('/additional-params/{id}', [AdditionalParamController::class, 'destroy']);

    Route::get('/additional-param-types', [AdditionalParamTypeController::class, 'index']);
    Route::post('/additional-param-types', [AdditionalParamTypeController::class, 'store']);
    Route::delete('/additional-param-types/{id}', [AdditionalParamTypeController::class, 'destroy']);

    Route::get('/colors', [ColorController::class, 'index']);
    Route::post('/colors', [ColorController::class, 'store']);
    Route::delete('/colors/{id}', [ColorController::class, 'destroy']);

    Route::get('/comments', [CommentController::class, 'index']);
    Route::post('/comments', [CommentController::class, 'store']);
    Route::delete('/comments/{id}', [CommentController::class, 'destroy']);

    Route::get('/decorations', [DecorationController::class, 'index']);
    Route::post('/decorations', [DecorationController::class, 'store']);
    Route::delete('/decorations/{id}', [DecorationController::class, 'destroy']);

    Route::get('/documents', [DocumentController::class, 'index']);
    Route::post('/documents', [DocumentController::class, 'store']);
    Route::delete('/documents/{id}', [DocumentController::class, 'destroy']);

    Route::get('/door-additional-params', [DoorAdditionalParamController::class, 'index']);
    Route::post('/door-additional-params', [DoorAdditionalParamController::class, 'store']);
    Route::delete('/door-additional-params/{id}', [DoorAdditionalParamController::class, 'destroy']);

    Route::get('/doors', [DoorController::class, 'index']);
    Route::post('/doors', [DoorController::class, 'store']);
    Route::delete('/doors/{id}', [DoorController::class, 'destroy']);

    Route::get('/door-params', [DoorParameterController::class, 'index']);
    Route::post('/door-params', [DoorParameterController::class, 'store']);
    Route::delete('/door-params/{id}', [DoorParameterController::class, 'destroy']);

    Route::get('/door-types', [DoorTypeController::class, 'index']);
    Route::post('/door-types', [DoorTypeController::class, 'store']);
    Route::delete('/door-types/{id}', [DoorTypeController::class, 'destroy']);

    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);

    Route::get('/panels', [PanelController::class, 'index']);
    Route::post('/panels', [PanelController::class, 'store']);
    Route::delete('/panels/{id}', [PanelController::class, 'destroy']);

    Route::get('/patterns', [PatternController::class, 'index']);
    Route::post('/patterns', [PatternController::class, 'store']);
    Route::delete('/patterns/{id}', [PatternController::class, 'destroy']);

    Route::get('/photos', [PhotoController::class, 'index']);
    Route::post('/photos', [PhotoController::class, 'store']);
    Route::delete('/photos/{id}', [PhotoController::class, 'destroy']);

    Route::get('/roles', [RoleController::class, 'index']);
    Route::post('/roles', [RoleController::class, 'store']);
    Route::delete('/roles/{id}', [RoleController::class, 'destroy']);

    Route::get('/statuses', [StatusController::class, 'index']);
    Route::post('/statuses', [StatusController::class, 'store']);
    Route::delete('/statuses/{id}', [StatusController::class, 'destroy']);

Route::post('/login', [LoginController::class, 'authenticate']);
