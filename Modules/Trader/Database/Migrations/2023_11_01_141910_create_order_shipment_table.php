<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_shipment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->default(0)->references('id')->on('orders')->onDelete('cascade');
            $table->integer('order_product_id')->default(0);
            $table->string('shipment_num',20)->nullable();
            $table->string('shipment_file', 150)->nullable();
            $table->date('shipment_date')->nullable();

            $table->text('barcode_num')->nullable();

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
        Schema::dropIfExists('order_shipment');
    }
};
