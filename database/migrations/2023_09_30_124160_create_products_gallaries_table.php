<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsGallariesTable extends Migration {

	public function up()
	{
		Schema::create('products_gallaries', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('product_id')->default(0)->references('id')->on('products')->onDelete('cascade');
            $table->enum('type', array('img', 'video'))->default('img');
			$table->string('path',300)->nullable();
            $table->enum('is_active',['Y','N'])->default('Y');
			$table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('products_gallaries');
	}
}
