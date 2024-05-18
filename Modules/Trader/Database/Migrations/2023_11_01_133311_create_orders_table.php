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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_num')->default(0);
            $table->integer('trader_id')->default(0);
            $table->enum('status',['new','working','delivering','delivered'])->default('new');
            $table->enum('is_done',['Y','N','canceled'])->default('N');
            $table->string('order_total_price',20)->nullable();
            $table->text('barcode_num')->nullable();
            $table->string('delivering_cost',20)->nullable();
            $table->integer('coupon_id')->default(0);
            $table->double('coupon_discount')->default(0);
            $table->date('delivering_time')->nullable();
			$table->softDeletes();
            $table->timestamps();
            $table->string('user_ip',17)->nullable();
            $table->string('user_pc_info',500)->nullable();
            
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
};
