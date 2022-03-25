<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableBookOrder extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_order', function (Blueprint $table) {
            $table->unsignedBigInteger('book_id');
            $table->unsignedBigInteger('order_id');
            $table->integer('quantity');
            $table->double('harga_satuan', 10, 2);
            $table->double('subtotal', 10, 2);
            $table->foreign('book_id')->references('id')->on('books');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->primary(['book_id', 'order_id']);

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('table_book_order');
    }
}
