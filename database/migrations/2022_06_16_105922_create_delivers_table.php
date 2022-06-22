<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeliversTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivers', function (Blueprint $table) {
            $table->id();
            $table->string('id_transactions');
            $table->string('product_name');
            $table->string('buyer_address');
            $table->string('product_weight');
            $table->string('delivery_fee');
            $table->timestamp('time')->default(now());
            $table->string('status')-> default(null);;
            $table->string('no_resi')-> default(null);;
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
        Schema::dropIfExists('delivers');
    }
}
