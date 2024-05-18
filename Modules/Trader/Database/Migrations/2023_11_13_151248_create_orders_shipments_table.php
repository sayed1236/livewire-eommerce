<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders_shipments', function (Blueprint $table) {
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
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_shipments');
    }
};
