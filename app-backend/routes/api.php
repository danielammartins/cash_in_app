<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Expenses;
use App\Models\Categories;
use App\Http\Controllers\ExpensesController;

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

/*
    Public Routes
*/

//Route::get('/expenses', [ExpensesController::class, 'index']);
//Route::post('/expenses', [ExpensesController::class, 'store']);

//FIX maneira preguiçosa se não ter de fazer cada rota individualmente
Route::resource('expenses', ExpensesController::class);

/*
    Protected Routes
*/
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/expenses/search/{name}', [ExpensesController::class, 'search']);
});

