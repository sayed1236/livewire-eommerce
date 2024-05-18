<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateProductsTable extends Migration {

	public function up()
	{
		Schema::create('products', function(Blueprint $table) {
			$table->id();
            $table->string('name')->nullable();
            $table->integer('ord')->default(0);
            $table->string('type',15)->default(0);
            $table->unsignedBigInteger('category_id')->default(0)->references('id')->on('categories')->onDelete('cascade');
            $table->unsignedBigInteger('stock_id')->default(0)->references('id')->on('stocks')->onDelete('cascade');
            $table->string('img',300)->nullable();
            $table->text('product_code')->unique();
            $table->text('barcode')->nullable();
            $table->double('price')->default(0);
            $table->double('discount')->default(0);
            $table->text('description')->nullable();
            $table->integer('num_views')->default(0);
            $table->enum('is_active',['Y','N'])->default('Y');
            $table->enum('in_stock',['Y','N'])->default('Y');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
		});
	}

	public function down()
	{
		Schema::drop('products');
	}
}
