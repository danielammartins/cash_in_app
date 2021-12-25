<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Expenses;
use App\Models\Categories;


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

Route::get('/expenses', function(){
    return Expenses::all();
});

Route::post('expenses', function() {
    return Expenses::create([
        'name' => 'Expense One',
        'slug' => 'expense-one',
        'value' => '15',
        'date' => '1997-12-20',
        'receipt_path' => 'no_receipt'
    ]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
