<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('detailed_borrow_orders', function (Blueprint $table) {
            $table->id('detail_id');
            $table->foreignId('order_id')->constrained('book_borrow_orders', 'order_id');
            $table->foreignId('book_id')->constrained('books', 'book_id');
            $table->date('return_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detailed_borrow_orders');
    }
};
