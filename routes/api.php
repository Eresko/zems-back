<?php
use App\Http\Controllers\Tasks\TaskController;
use App\Http\Controllers\Tasks\TaskTimestampController;
use App\Http\Controllers\Projects\ProjectController;
use App\Http\Controllers\Projects\ProjectAnalyticsController;
use App\Http\Controllers\Users\AuthController;
use App\Http\Controllers\Users\UserController;

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
Route::group([ 'prefix' => 'project-analytics'], function () {
    Route::get('', [ProjectAnalyticsController::class, 'get']);
});

Route::group([ 'prefix' => 'user'], function () {
    Route::post('/registration', [AuthController::class, 'registration']);
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth:sanctum')->group(function () {
    Route::group([ 'prefix' => 'project'], function () {
        Route::post('', [ProjectController::class, 'create']);
        Route::get('', [ProjectController::class, 'list']);
    });
    Route::group([ 'prefix' => 'user'], function () {
        Route::get('/check', [UserController::class, 'check']);
        Route::get('/', [UserController::class, 'getUsers']);
        Route::post('/change-password', [AuthController::class, 'changePassword']);
    });

    Route::group([ 'prefix' => 'task'], function () {
        Route::post('', [TaskController::class, 'create']);
        Route::get('/get/{id}', [TaskController::class, 'getTask']);
        Route::get('{id}', [TaskController::class, 'list']);
        Route::post('/timestamp', [TaskTimestampController::class, 'create']);
    });
});

