<?php

<<<<<<< HEAD
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\BookBorrowOrderController;

Route::apiResource('books', BookController::class);
Route::apiResource('readers', ReaderController::class);
Route::apiResource('borrow-orders', BookBorrowOrderController::class);
Route::put('borrow-orders/{detailedBorrowOrder}/return', [BookBorrowOrderController::class, 'returnBook']);
=======
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
>>>>>>> origin/master
