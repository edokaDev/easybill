<?php

use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::group(['prefix' => 'users'], function () {
//     Route::get('', [UserController::class, 'index']);
//     Route::post('', [UserController::class, 'store']);
//     Route::get('/{user}', [UserController::class, 'show']);
//     Route::put('/{user}', [UserController::class, 'update']);
//     Route::delete('/{user}', [UserController::class, 'destroy']);
//     Route::get('/{user}/transactions', [UserController::class, 'getTransactions']);
// });

// Route::group(['prefix' => 'transactions'], function () {
//     Route::get('', [TransactionController::class, 'index']);
//     Route::post('', [TransactionController::class, 'store']);
//     Route::get('/{transaction}', [TransactionController::class, 'show']);
//     Route::put('/{transaction}', [TransactionController::class, 'update']);
//     Route::delete('/{transaction}', [TransactionController::class, 'destroy']);
// });
Route::apiResource('users', UserController::class);
Route::get('/users/{user}/transactions', [UserController::class, 'getTransactions']);
Route::apiResource('transactions', TransactionController::class);
