<?php

namespace App\Http\Controllers;

use App\Models\DetailedBorrowOrder;
use Illuminate\Http\Request;

class DetailedBorrowOrderController extends Controller
{
    public function returnBook(DetailedBorrowOrder $detailedBorrowOrder)
    {
        $detailedBorrowOrder->update(['return_date' => now()]);
        return response()->json(['message' => 'Book returned successfully']);
    }
}