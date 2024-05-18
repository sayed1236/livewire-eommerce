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
        Schema::create('trader_favorites', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trader_id')->default(0)->references('id')->on('traders')->onDelete('cascade');
            $table->integer('favo_id')->nullable();
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
        Schema::dropIfExists('traders_favorites');
    }
};
