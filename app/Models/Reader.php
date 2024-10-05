<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reader extends Model
{
    protected $primaryKey = 'reader_id';
    protected $fillable = ['name', 'email', 'phone_number', 'address'];

    public function bookBorrowOrders()
    {
        return $this->hasMany(BookBorrowOrder::class, 'reader_id');
    }

    use SoftDeletes;
}