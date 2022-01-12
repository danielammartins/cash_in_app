<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Expenses;
use App\Models\Categories;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\UserController;
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

    Route::get('/user', [UserController::class, 'getUserID']);

    // Categories Endpoints
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categories/search/{name}', [CategoryController::class, 'search']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    
    Route::put('/categories/{id}', [CategoryController::class, 'update']);
    
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);

    // Expenses Endpoints
    Route::post('/expenses', [ExpenseController::class, 'store']);
    Route::get('/expenses', [ExpenseController::class, 'index']);
    Route::get('/expenses/search/{name}', [ExpenseController::class, 'search']);
    Route::get('/expenses/{id}', [ExpenseController::class, 'show']);

    Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
        
    Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);

    // User Endpoints
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});
   

