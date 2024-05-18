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
        Schema::create('trader_contacts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('trader_id')->references('id')->on('traders')->onDelete('CASCADE');
            $table->string('user_id');
            $table->integer('parent_id')->default(0);
			$table->text('message')->nullable();
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
        Schema::dropIfExists('trader_contacts');
    }
};
