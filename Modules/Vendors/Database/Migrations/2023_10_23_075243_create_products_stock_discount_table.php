<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsStockDiscountTable extends Migration {

	public function up()
	{
		Schema::create('products_stock_discount', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('product_id')->unsigned();
			$table->integer('stock_id')->unsigned();
			$table->integer('quantity_from');
			$table->softDeletes();
			$table->integer('quantity_to');
			$table->decimal('discount_percent')->default(0);
			$table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('products_stock_discount');
	}
}
