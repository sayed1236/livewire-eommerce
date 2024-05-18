<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('categories_galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->default(0)->references('id')->on('categories')->onDelete('CASCADE');
            $table->enum('type', array('img', 'video'))->default('img');
			$table->string('path',300)->nullable();
			$table->enum('is_active',['Y','N'])->default('Y');
            $table->timestamps();
			$table->softDeletes();
            $table->string('user_ip',45)->nullable();
            $table->string('user_pc_info',500)->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_galleries');
    }
};
