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
        Schema::create('traders', function (Blueprint $table) {
            $table->id();
			$table->string('name', 300)->nullable();
			$table->string('last_name', 300)->nullable();
			$table->string('email', 150)->unique()->nullable();
			$table->string('password', 150)->nullable();
			$table->string('mobile', 25)->nullable();
            $table->text('address')->nullable();
            $table->string('img', 150)->nullable();
			$table->rememberToken();
            $table->enum('is_active',['Y','N'])->default('Y');
			$table->softDeletes();
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
        Schema::dropIfExists('traders');
    }
};
