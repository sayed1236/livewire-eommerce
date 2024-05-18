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
        Schema::create('traders_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trader_id')->default(0)->references('id')->on('traders')->onDelete('cascade');
            $table->string('type',15)->default(0);
            $table->string('order_num',25)->nullable();
            $table->enum('staus',['new','working','delivering','delivered','finished','canceled'])->default('new');
            $table->enum('is_done',['Y','N','canceled'])->default('N');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('traders_orders');
    }
};
