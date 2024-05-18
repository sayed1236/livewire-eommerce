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
        Schema::create('trader_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trader_id')->default(0)->references('id')->on('traders')->onDelete('CASCADE');
            $table->string('commercial_lines', 50)->nullable();
			$table->string('commercial_lines_file', 150)->nullable();
			$table->string('taxes_licenses', 50)->nullable();
			$table->string('taxes_icenses_file', 150)->nullable();
			$table->date('started_date')->nullable();
			$table->text('brief')->nullable();
			$table->string('file_of_profile',150)->nullable();
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
        Schema::dropIfExists('trader_details');
    }
};
