<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EmailVerificationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\NewPasswordController;
use App\Http\Controllers\UserController;

/*
    Public Routes
*/
Route::post('/register', [App\Http\Controllers\API\AuthController::class, 'register']);
Route::post('/login', [App\Http\Controllers\API\AuthController::class, 'login'])->name('login');;

Route::post('/forgot-password', [NewPasswordController::class, 'forgotPassword']);
Route::post('/reset-password', [NewPasswordController::class, 'reset'])->name('password.reset');;

Route::post('/email/verification-notification', [EmailVerificationController::class, 'sendVerificationEmail'])->middleware('auth:sanctum');
Route::get('/verify-email{id}/{hash}', [EmailVerificationController::class, 'verify'])->name('verification.verify')->middleware('auth:sanctum');

/*
    Protected Routes
*/
Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::get('/user', [UserController::class, 'getUserID']);
    Route::post('/change-password', [UserController::class, 'changePassword']);

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
    Route::get('/export/expenses', [ExpenseController::class, 'export']);
    Route::get('/show-expenses/category', [ExpenseController::class, 'showByCategory']);
    Route::get('/show-expenses/date', [ExpenseController::class, 'showByDate']);


    Route::post('/expected-monthly/category', [ExpenseController::class, 'expectedMonthlyExpensesByCategory']);
    Route::post('/expected-monthly/total', [ExpenseController::class, 'expectedMonthlyExpenses']);
    Route::post('/usage-percentage', [ExpenseController::class, 'usagePercentage']);
    Route::post('/add-receipt', [ExpenseController::class, 'receipt']);

    Route::put('/expenses/{id}', [ExpenseController::class, 'update']);
        
    Route::delete('/expenses/{id}', [ExpenseController::class, 'destroy']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::delete('/delete-account', [UserController::class, 'deleteUser']);
    Route::post('/logout', [App\Http\Controllers\API\AuthController::class, 'logout']);
});
   

