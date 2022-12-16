<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
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

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout']);
Route::get('data', [AuthController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('jobcreate', [JobController::class, 'create']);
    Route::get('job', [JobController::class, 'index']);
    Route::get('job/{id}', [JobController::class, 'show']);
    Route::put('job/{id}/update', [JobController::class, 'update']);
    Route::get('job/{id}/delete', [JobController::class, 'destroy']);

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});
