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
        Schema::create('orders_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id')->default(0)->references('id')->on('orders')->onDelete('cascade');
            $table->integer('product_id')->default(0);
            $table->integer('stock_id')->default(0);
            $table->integer('vendor_id')->default(0);
			$table->integer('quantity')->default(0);
            $table->string('product_total_price',20)->nullable();
            $table->double('discount')->default(0);
            $table->date('date_of_cancel')->nullable();
            $table->text('reason_if_cancel')->nullable();
            $table->enum('status',['delivering','delivered'])->default('delivering');


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
        Schema::dropIfExists('orders_products');
    }
};
