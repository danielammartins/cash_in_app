<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Expenses;
use App\Models\Categories;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\AuthController;

/*
    Public Routes
*/
Route::post('/register', [AuthController::class, 'register']);

/*
    Protected Routes
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/expenses', [ExpensesController::class, 'store']);
   
    Route::get('/expenses', [ExpensesController::class, 'index']);
    Route::get('/expenses/search/{name}', [ExpensesController::class, 'search']);
    Route::get('/expenses/{id}', [ExpensesController::class, 'show']);
    
    Route::put('/expenses/{id}', [ExpensesController::class, 'update']);
    
    Route::delete('/expenses/{id}', [ExpensesController::class, 'destroy']);
});