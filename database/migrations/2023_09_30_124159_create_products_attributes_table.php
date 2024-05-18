<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsAttributesTable extends Migration {

	public function up()
	{
		Schema::create('products_attributes', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('product_id')->default(0)->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('attribute_category_id')->default(0)->references('id')->on('attribute_categories')->onDelete('cascade');
            $table->timestamps();
			$table->softDeletes();

		});
	}

	public function down()
	{
		Schema::drop('products_attributes');
	}
}
