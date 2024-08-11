<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\CustomerController;

Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/add-user', [UserController::class, 'store']);
    Route::get('/all-customer', [CustomerController::class, 'index']);
    Route::post('/add-customer', [CustomerController::class, 'store']);
    Route::post('/update-customer', [CustomerController::class, 'update']);
    Route::post('/delete-customer', [CustomerController::class, 'delete']);


});
