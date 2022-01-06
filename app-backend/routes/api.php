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
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login']);

/*
    Protected Routes
*/

Route::group(['middleware' => ['auth:sanctum']], function () {
        // authenticated user. Use User::find() to get the user from db by id
        //return app()->request()->user();

    //Route::get('/user', [])
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::get('/expenses', [ExpenseController::class, 'index']);
    Route::get('/expenses/search/{name}', [ExpenseController::class, 'search']);
    Route::get('/expenses/{id}', [ExpenseController::class, 'show']);

    Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
        
    Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);

    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});
   

