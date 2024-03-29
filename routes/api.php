<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\VoitureController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('CreateUser',[UserController::class,'CreateUser']);
Route::PUT('UpdateUser/{id}',[UserController::class,'UpdateUser']);
Route::DELETE('DeleteUser',[UserController::class,'DeleteUser']);
Route::get('GetUser',[UserController::class,'GetUser']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('getAllVoitures', [VoitureController::class, 'index']);
Route::post('EstimationPrixVoitures', [VoitureController::class, 'EstimationPrixVoitures']);
