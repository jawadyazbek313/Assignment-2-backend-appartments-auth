<?php

use App\Http\Controllers\AppartmentsController;
use App\Http\Controllers\AuthController;
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


Route::post('/signup', [AuthController::class, 'sign_up']);
Route::post('/login', [AuthController::class, 'login']);


Route::get('/appartments', [AppartmentsController::class, 'HomePageList']);


Route::group(['middleware' => ['auth:sanctum']], function () {
    // private post routes
    Route::resource('appartment', AppartmentsController::class);
    Route::post('/logout', [AuthController::class, 'logout']);    
});