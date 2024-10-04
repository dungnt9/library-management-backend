<?php

// app/Models/BookBorrowOrder.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookBorrowOrder extends Model
{
    protected $primaryKey = 'order_id';
    protected $fillable = ['reader_id', 'order_date'];

    public function reader()
    {
        return $this->belongsTo(Reader::class, 'reader_id');
    }

    public function detailedBorrowOrders()
    {
        return $this->hasMany(DetailedBorrowOrder::class, 'order_id');
    }

    use SoftDeletes;
}