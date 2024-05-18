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
        Schema::create('trader_history_logs', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable();
            $table->unsignedBigInteger('trader_id')->default(0)->references('id')->on('traders')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->default(0)->references('id')->on('products')->onDelete('cascade');
            $table->integer('num_views')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->string('user_ip',17)->nullable();
            $table->string('user_pc_info',230)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trader_history_logs');
    }
};
