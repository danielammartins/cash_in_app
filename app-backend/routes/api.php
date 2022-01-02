<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Expenses;
use App\Models\Categories;
use App\Http\Controllers\ExpenseController;
use App\Models\Expense;
use Facade\FlareClient\Api;

/*
    Public Routes
*/
//Route::post('/register', [AuthController::class, 'register']);
//Route::post('/login', [AuthController::class, 'login']);

/*
    Protected Routes
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::get('/expenses', [ExpenseController::class, 'index']);
    Route::get('/expenses/search/{name}', [ExpenseController::class, 'search']);
    Route::get('/expenses/{id}', [ExpenseController::class, 'show']);

    Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
        
    Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);
});
   

