<?php

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
Route::get('/expenses', [ExpensesController::class, 'index']);

/*
    Protected Routes
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/expenses', [ExpensesController::class, 'store']);
    //Route::get('/expenses', [ExpensesController::class, 'index']);
    Route::get('/expenses/search/{name}', [ExpensesController::class, 'search']);
    Route::get('/expenses/{id}', [ExpensesController::class, 'show']);
    
    Route::put('/expenses/{id}', [ExpensesController::class, 'update']);
    
    Route::delete('/expenses/{id}', [ExpensesController::class, 'destroy']);
});
