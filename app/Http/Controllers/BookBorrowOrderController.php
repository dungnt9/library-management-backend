<?php

namespace App\Http\Controllers;

use App\Models\BookBorrowOrder;
use App\Models\DetailedBorrowOrder;
use Illuminate\Http\Request;

class BookBorrowOrderController extends Controller
{
    public function index()
    {
        return BookBorrowOrder::with('reader', 'detailedBorrowOrders.book')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'reader_id' => 'required|exists:readers,reader_id',
            'order_date' => 'required|date',
            'books' => 'required|array',
            'books.*.book_id' => 'required|exists:books,book_id',
            'books.*.return_date' => 'required|date',
        ]);

        $order = BookBorrowOrder::create([
            'reader_id' => $request->reader_id,
            'order_date' => $request->order_date,
        ]);

        foreach ($request->books as $book) {
            DetailedBorrowOrder::create([
                'order_id' => $order->order_id,
                'book_id' => $book['book_id'],
                'return_date' => $book['return_date'],
            ]);
        }

        return $order->load('reader', 'detailedBorrowOrders.book');
    }

    public function show(BookBorrowOrder $order)
    {
        return $order->load('reader', 'detailedBorrowOrders.book');
    }

    public function update(Request $request, BookBorrowOrder $order)
    {
        // Implement update logic if needed
    }

    public function destroy(BookBorrowOrder $order)
    {
        $order->detailedBorrowOrders()->delete();
        $order->delete();
        return response()->json(null, 204);
    }

    public function returnBook(DetailedBorrowOrder $detailedBorrowOrder)
    {
        $detailedBorrowOrder->update(['return_date' => now()]);
        return response()->json(['message' => 'Book returned successfully']);
    }
}