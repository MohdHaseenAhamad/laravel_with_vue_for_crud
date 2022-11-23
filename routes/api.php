<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeesController;

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
Route::get('/employees',[EmployeesController::class,'index']);
Route::post('/save',[EmployeesController::class,'store']);
Route::post('/show',[EmployeesController::class,'show']);
Route::post('/update/{id}',[EmployeesController::class,'update']);
Route::post('/delete/{id}',[EmployeesController::class,'destroy']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
