<?php

// app/Models/Book.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $primaryKey = 'book_id';
    protected $fillable = ['title', 'author', 'publisher', 'price', 'publication_year', 'quantity', 'is_available'];

    public function detailedBorrowOrders()
    {
        return $this->hasMany(DetailedBorrowOrder::class, 'book_id');
    }
}
