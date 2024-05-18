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
        Schema::create('traders_orders_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trader_id')->default(0)->references('id')->on('traders')->onDelete('cascade');
            $table->string('type',15)->default(0);
            $table->unsignedBigInteger('order_id')->default(0)->references('id')->on('traders_orders')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->default(0)->references('id')->on('products')->onDelete('cascade');
            $table->integer('quantity')->default(1);
            $table->string('total_price',20)->nullable();
            $table->double('discount')->default(0);
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('traders_orders_details');
    }
};
