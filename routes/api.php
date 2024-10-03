<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\ReaderController;
use App\Http\Controllers\BookBorrowOrderController;

Route::apiResource('books', BookController::class);
Route::apiResource('readers', ReaderController::class);
Route::apiResource('borrow-orders', BookBorrowOrderController::class);
Route::put('borrow-orders/{detailedBorrowOrder}/return', [BookBorrowOrderController::class, 'returnBook']);