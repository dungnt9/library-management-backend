<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailedBorrowOrder extends Model
{
    protected $primaryKey = 'detail_id';
    protected $fillable = ['order_id', 'book_id', 'return_date'];

    public function bookBorrowOrder()
    {
        return $this->belongsTo(BookBorrowOrder::class, 'order_id');
    }

    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }
}