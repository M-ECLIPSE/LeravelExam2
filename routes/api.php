<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('photo/store' ,[\App\Http\Controllers\PhotoController::class,'store']);

Route::post('auth/check/user/exist' , [\App\Http\Controllers\UserController::class , 'ChkUser']);
Route::post('auth/check/user/otp' , [\App\Http\Controllers\UserController::class , 'ChkOtp']);
Route::post('auth/user/store' ,[\App\Http\Controllers\UserController::class,'store']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {

    return $request->user();
});
