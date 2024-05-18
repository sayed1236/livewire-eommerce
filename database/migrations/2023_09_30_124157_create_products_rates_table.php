<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsRatesTable extends Migration {

	public function up()
	{
		Schema::create('products_rates', function(Blueprint $table) {
			$table->id();
			$table->integer('type')->default(0);
            $table->unsignedBigInteger('trader_id')->default(0)->references('id')->on('traders')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->default(0)->references('id')->on('products')->onDelete('cascade');
            // $table->bigInteger('rated_in_id')->default(0);
            $table->integer('rate')->default(0);
            $table->text('notes')->nullable();
            $table->enum('is_approved',['Y','N'])->default('N');
            $table->softDeletes('deleted_at', 0);
            $table->timestamps();
            $table->string('user_ip',17)->nullable();
            $table->string('user_pc_info',500)->nullable();
		});
	}

	public function down()
	{
		Schema::drop('products_rates');
	}
}
