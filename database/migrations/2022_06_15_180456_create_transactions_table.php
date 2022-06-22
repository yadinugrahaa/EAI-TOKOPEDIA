<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('seller_name');
            $table->string('buyer_name');
            $table->string('buyer_address');
            $table->string('product_name');
            $table->string('nominal_payment');
            $table->string('delivery_fee');
            $table->string('total_payment');
            $table->timestamp('time')->default(now());
            $table->enum('status_payment',['paid','unpaid']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
