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
            $table->timestamps();
            $table->unsignedBigInteger('delivering_address_id');
            $table->unsignedBigInteger('doctor_id')->nullable();
            $table->boolean('is_insured')->default('0');
            $table->unsignedInteger('status_id');
            $table->unsignedBigInteger('pharamcy_id')->nullable();
            $table->unsignedBigInteger('order_user_id');
            $table->string('creator_type');
            $table->unsignedBigInteger('total_price');
            $table->foreign('delivering_address_id')->references('id')->on('addresses');
            $table->foreign('order_user_id')->references('id')->on('users');
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
