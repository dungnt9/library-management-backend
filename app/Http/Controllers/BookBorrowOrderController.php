<?php

namespace App\Http\Controllers;

use App\Models\BookBorrowOrder;
use App\Models\DetailedBorrowOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Thêm dòng này

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
            'books.*.book_id' => 'required|exists:books,book_id',    //xác thực cho từng phần tử trong mảng
            'books.*.return_date' => 'nullable|date',
        ]);

        $order = BookBorrowOrder::create([
            'reader_id' => $request->reader_id,
            'order_date' => $request->order_date,
        ]);

        foreach ($request->books as $book) {
            DetailedBorrowOrder::create([
                'order_id' => $order->order_id,  //được tự động sinh
                'book_id' => $book['book_id'],   //sách cụ thể lấy từ mảng books trong request
                'return_date' => $book['return_date'] ?? null,
            ]);
        }

        return $order->load('reader', 'detailedBorrowOrders.book'); //lấy dữ liệu liên quan và gán vào các thuộc tính của đối tượng $order.
    }

    public function show(BookBorrowOrder $order)
    {
        return $order->load('reader', 'detailedBorrowOrders.book');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'reader_id' => 'required|exists:readers,reader_id',
            'order_date' => 'required|date',
            'books' => 'required|array',
            'books.*.book_id' => 'required|exists:books,book_id',
            'books.*.return_date' => 'nullable|date',
        ]);

        try {
            DB::beginTransaction();
            
            $order = BookBorrowOrder::findOrFail($id);
            
            $order->update([
                'reader_id' => $request->reader_id,
                'order_date' => $request->order_date,
            ]);

            DetailedBorrowOrder::where('order_id', $id)->delete();

            foreach ($request->books as $book) {
                DetailedBorrowOrder::create([
                    'order_id' => $id,
                    'book_id' => $book['book_id'],
                    'return_date' => $book['return_date'] ?? null,
                ]);
            }

            DB::commit();

            return BookBorrowOrder::with('reader', 'detailedBorrowOrders.book')
                ->findOrFail($id);

        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function destroy($id)
    {
        $order = BookBorrowOrder::findOrFail($id);
        $order->delete();
        return response()->json(['message' => 'BookBorrowOrder soft deleted successfully']);
    }

    public function returnBook(DetailedBorrowOrder $detailedBorrowOrder)
    {
        $detailedBorrowOrder->update(['return_date' => now()]);
        return response()->json(['message' => 'Book returned successfully']);
    }
}