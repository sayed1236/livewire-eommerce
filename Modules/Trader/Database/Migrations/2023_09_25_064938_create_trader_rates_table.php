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
        Schema::create('trader_rates', function (Blueprint $table) {
            $table->id();
			$table->unsignedBigInteger('trader_id')->default(0)->references('id')->on('traders')->onDelete('CASCADE');
            $table->integer('rate')->default(0);
			$table->text('rate_comment')->nullable();
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
        Schema::dropIfExists('trader_rates');
    }
};
