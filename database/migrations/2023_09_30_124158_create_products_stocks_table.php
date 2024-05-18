<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsStocksTable extends Migration {

	public function up()
	{
		Schema::create('products_stocks', function(Blueprint $table) {
			$table->id();
			$table->unsignedBigInteger('product_id')->default(0)->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('stock_id')->default(0)->references('id')->on('stocks')->onDelete('cascade');
			$table->integer('quantity');
			$table->integer('buying_price')->default(0);
			$table->integer('selling_price')->default(0);
			$table->date('date_of_enter')->nullable();
			$table->date('date_of_expire')->nullable();
            $table->timestamps();
			$table->softDeletes();
		});
	}

	public function down()
	{
		Schema::drop('products_stocks');
	}
}
