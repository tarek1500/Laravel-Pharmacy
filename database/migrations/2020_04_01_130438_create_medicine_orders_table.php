<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine_orders', function (Blueprint $table) {
            $table->integer('medicine_id')->unsigned();
            $table->integer('order_id')->unsigned();
            $table->timestamps();
            $table->unsignedBigInteger('price');
            $table->unsignedBigInteger('quantity');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medicine_orders');
    }
}
