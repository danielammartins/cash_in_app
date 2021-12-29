<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Expenses;
use App\Models\Categories;
use App\Http\Controllers\ExpensesController;

/*
    Public Routes
*/


//Route::get('/expenses', [ExpensesController::class, 'index']);
//Route::post('/expenses', [ExpensesController::class, 'store']);

//FIXME this is lazy
Route::resource('expenses', ExpensesController::class);

/*
    Protected Routes
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/expenses/search/{name}', [ExpensesController::class, 'search']);
});