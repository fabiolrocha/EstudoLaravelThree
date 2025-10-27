<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ClientApiController;
use App\Http\Controllers\Api\AuthController;

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('clients', ClientApiController::class)
          ->names('api.clients');
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
