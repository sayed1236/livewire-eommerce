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
        Schema::create('shipment_track', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_shipment_id')->default(0)->references('id')->on('order_shipment')->onDelete('cascade');
            $table->text('from')->nullable();
            $table->text('to')->nullable();
            $table->enum('status',['new','working','delivering','delivered'])->default('new');
            $table->integer('pilot_id')->default(0);

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
        Schema::dropIfExists('shipment_track');
    }
};
