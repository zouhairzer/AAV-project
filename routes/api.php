<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
Route::PUT('UpdateUser',[UserController::class,'UpdateUser']);
Route::DELETE('DeleteUser',[UserController::class,'DeleteUser']);
Route::get('GetUser',[UserController::class,'GetUser']);
