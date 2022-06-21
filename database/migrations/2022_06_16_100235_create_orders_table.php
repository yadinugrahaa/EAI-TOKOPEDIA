<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('id_product');
            $table->string('id_seller');
            $table->string('id_delivery');
            $table->string('id_transactions');
            $table->string('buyer_name');
            $table->string('buyer_address');
            $table->string('contact');
            $table->string('city');
            $table->string('postalcode');
            $table->timestamp('time')->default(now());
            $table->enum('status_payment',['paid','unpaid']);
            $table->enum('status_delivery',['delivered','onprocess']);
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
        Schema::dropIfExists('orders');
    }
}
